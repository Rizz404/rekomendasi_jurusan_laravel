<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\CollegeMajor;
use App\Models\Criteria;
use App\Models\MajorCharacteristic;
use App\Models\SawResult;
use App\Models\Student;
use App\Models\StudentScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MyRecomendationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student()->firstOrFail();

        if (!$this->isGradeExist($student))
        {
            return redirect()->route('my-grades.index')
                ->with("warning", "Mohon lengkapi data nilai Anda terlebih dahulu untuk melihat rekomendasi.");
        }

        $SAWResults = SawResult::with('collegeMajor')
            ->where('student_id', $student->id)
            ->orderBy('rank')
            ->get();

        // * Cek apakah rekomendasi ada ATAU apakah ada perubahan nilai sejak kalkulasi terakhir (opsional)
        // * Jika ingin selalu kalkulasi ulang jika belum ada:
        if ($SAWResults->isEmpty())
        {
            Log::info("No recommendations found for student {$student->id}. Calculating...");
            $calculationResult = $this->calculate($student);
            if ($calculationResult !== true)
            {
                // * Jika kalkulasi gagal (misal karena tidak ada skor), redirect dengan pesan error
                return $calculationResult; // * calculate() akan return RedirectResponse on error
            }

            // * Ambil ulang data setelah kalkulasi
            $SAWResults = SawResult::with('collegeMajor')
                ->where('student_id', $student->id)
                ->orderBy('rank')
                ->get();

            if ($SAWResults->isEmpty())
            {
                Log::warning("Calculation completed but still no recommendations for student {$student->id}.");
                // * Mungkin tidak ada jurusan aktif atau karakteristik jurusan?
                // * Tampilkan pesan bahwa tidak ada rekomendasi yang bisa dihasilkan saat ini
                return view('pages.user.my-recommendation.index', compact('SAWResults'))
                    ->with("student", $student)
                    ->with('info', 'Tidak ada rekomendasi jurusan yang dapat dihasilkan saat ini. Pastikan data nilai dan jurusan sudah lengkap.');
            }
        }

        return view('pages.user.my-recommendation.index', compact('SAWResults'))
            ->with("student", $student);
    }


    public function calculate(Student $student)
    {
        // * Gunakan transaction untuk memastikan konsistensi data
        return DB::transaction(function () use ($student)
        {
            // * 1. Hapus hasil SAW sebelumnya untuk siswa ini
            // * forceDelete() oke jika tidak butuh history, jika butuh pakai delete() dan handle statusnya
            SawResult::where('student_id', $student->id)->forceDelete();
            Log::info("Deleted previous SAW results for student {$student->id}.");

            // * 2. Ambil data skor siswa
            $studentScores = StudentScore::where('student_id', $student->id)
                ->with('criteria') // * Eager load criteria
                ->get()
                // * Ubah ke collection dengan key criteria_id untuk akses mudah
                ->keyBy('criteria_id');

            // * Jika siswa belum input nilai sama sekali
            if ($studentScores->isEmpty())
            {
                Log::warning("Student {$student->id} has no scores. Calculation aborted.");
                // * Tidak perlu rollback manual di sini karena transaction akan otomatis rollback jika exception/return selain true
                // * Kembalikan redirect response agar bisa ditangkap di index() atau recalculate()
                return redirect()->route('my-grades.index')
                    ->with('warning', 'Anda belum memiliki nilai. Mohon isi nilai terlebih dahulu.');
            }
            Log::info("Fetched {$studentScores->count()} scores for student {$student->id}.");

            // * 3. Ambil kriteria yang aktif dan sesuai dengan tipe sekolah siswa
            $criteria = Criteria::where('is_active', true)
                ->where(function ($query) use ($student)
                {
                    // * Filter berdasarkan tipe sekolah siswa, juga ambil yang 'All'
                    $schoolTypeDb = ($student->school_type === 'high_school') ? 'SMA' : (($student->school_type === 'vocational_school') ? 'SMK' : null);
                    if ($schoolTypeDb)
                    {
                        $query->where('school_type', $schoolTypeDb)
                            ->orWhere('school_type', 'All');
                    }
                    else
                    {
                        // * Jika tipe sekolah tidak SMA/SMK, mungkin hanya ambil yg 'All'?
                        $query->where('school_type', 'All');
                        Log::warning("Student {$student->id} has an unrecognized school type: {$student->school_type}. Using 'All' criteria only.");
                    }
                })
                ->get();

            if ($criteria->isEmpty())
            {
                Log::error("No active criteria found for student {$student->id} with school type {$student->school_type}.");
                return redirect()->back()->with('error', 'Tidak ada kriteria penilaian yang aktif untuk tipe sekolah Anda.');
            }
            Log::info("Fetched {$criteria->count()} active criteria for student {$student->id} (School Type: {$student->school_type}).");


            // * 4. Ambil semua jurusan kuliah yang aktif
            $collegeMajors = CollegeMajor::where('is_active', true)->get();
            if ($collegeMajors->isEmpty())
            {
                Log::error("No active college majors found in the system.");
                return redirect()->back()->with('error', 'Tidak ada data jurusan kuliah yang aktif saat ini.');
            }
            Log::info("Fetched {$collegeMajors->count()} active college majors.");


            // * 5. Normalisasi Matriks Keputusan (Hanya untuk siswa saat ini)
            $normalizedMatrix = [];
            $maxScores = []; // * Cache max scores per criteria
            $minScores = []; // * Cache min scores per criteria

            foreach ($criteria as $criterion)
            {
                // * Ambil skor siswa untuk kriteria ini
                $studentScoreValue = $studentScores->get($criterion->id)?->score;

                // * Jika siswa tidak punya skor untuk kriteria *ini*, lewati normalisasi untuk kriteria ini
                // * Atau beri nilai default (misal 0), tapi lebih baik diskip jika datanya memang tidak ada.
                if ($studentScoreValue === null)
                {
                    Log::warning("Student {$student->id} missing score for criteria {$criterion->id} ('{$criterion->name}'). Skipping normalization for this criteria.");
                    // * Pastikan nilai ternormalisasi tidak ada agar tidak dipakai di perhitungan akhir
                    $normalizedMatrix[$criterion->id] = null;
                    continue;
                }

                // * Normalisasi berdasarkan tipe kriteria (Benefit / Cost)
                if ($criterion->type === 'benefit')
                {
                    // * Cari nilai MAX untuk kriteria ini dari SEMUA skor siswa (jika normalisasi global)
                    // * Atau hanya dari skor siswa ini vs target/ideal (jika normalisasi per siswa)
                    // * Kode Anda menggunakan normalisasi global:
                    if (!isset($maxScores[$criterion->id]))
                    {
                        // * Hindari query berulang jika bisa
                        $maxScores[$criterion->id] = StudentScore::where('criteria_id', $criterion->id)->max('score') ?? 0;
                    }
                    $max = (float) $maxScores[$criterion->id];
                    $normalizedMatrix[$criterion->id] = $max > 0 ? ((float) $studentScoreValue / $max) : 0;
                }
                else // * type === 'cost'
                {
                    // * Cari nilai MIN untuk kriteria ini
                    if (!isset($minScores[$criterion->id]))
                    {
                        $minScores[$criterion->id] = StudentScore::where('criteria_id', $criterion->id)->min('score') ?? 0;
                    }
                    $min = (float) $minScores[$criterion->id];
                    $score = (float) $studentScoreValue;
                    $normalizedMatrix[$criterion->id] = $score > 0 ? ($min / $score) : 0;
                }
                // * Log::debug("Normalization - Criteria: {$criterion->id}, Type: {$criterion->type}, Score: {$studentScoreValue}, Norm Score: {$normalizedMatrix[$criterion->id]}");
            }

            // * 6. Kalkulasi Skor Akhir SAW dan Pengecekan Syarat Minimum
            $sawScores = [];
            foreach ($collegeMajors as $major)
            {
                // * Ambil karakteristik (bobot & syarat min) jurusan ini
                $characteristics = MajorCharacteristic::where('college_major_id', $major->id)
                    // * Pastikan hanya mengambil karakteristik yang kriterianya relevan (aktif & sesuai tipe sekolah)
                    ->whereIn('criteria_id', $criteria->pluck('id'))
                    ->with('criteria:id,name') // * Eager load ID dan Nama Kriteria saja
                    ->get();

                // * Jika jurusan tidak punya karakteristik yang relevan, skip
                if ($characteristics->isEmpty())
                {
                    Log::warning("Major {$major->id} ('{$major->major_name}') has no relevant characteristics defined. Skipping.");
                    continue;
                }

                // * Cek apakah siswa memenuhi syarat skor minimum
                $meetsMinimumRequirements = true;
                $failedCriteriaNames = [];
                foreach ($characteristics as $characteristic)
                {
                    if ($characteristic->minimum_score !== null)
                    {
                        // * Ambil skor siswa untuk kriteria syarat ini
                        $studentScoreForReq = $studentScores->get($characteristic->criteria_id)?->score;

                        // * Jika siswa tidak punya skor ATAU skornya di bawah minimum
                        if ($studentScoreForReq === null || (float) $studentScoreForReq < (float) $characteristic->minimum_score)
                        {
                            $meetsMinimumRequirements = false;
                            $failedCriteriaNames[] = $characteristic->criteria->name ?? "Kriteria ID {$characteristic->criteria_id}"; // * Ambil nama kriteria
                            Log::info("Student {$student->id} failed minimum score requirement for Major {$major->id} on Criteria {$characteristic->criteria_id}. Req: {$characteristic->minimum_score}, Score: {$studentScoreForReq}");
                            // * break; // * Bisa break jika satu saja gagal sudah cukup
                        }
                    }
                }

                // * Kalkulasi skor akhir jika memenuhi syarat
                $finalScore = 0;
                $reasonParts = [];
                $contributors = []; // * Untuk menyimpan kontribusi skor per kriteria

                if ($meetsMinimumRequirements)
                {
                    // * *** DEBUGGING ALASAN ***
                    Log::debug("Major [{$major->id}] '{$major->major_name}': Contributors before sort: " . json_encode($contributors));

                    foreach ($characteristics as $characteristic)
                    {
                        $criteriaId = $characteristic->criteria_id;
                        // * Pastikan skor ternormalisasi ada dan valid untuk kriteria ini
                        if (isset($normalizedMatrix[$criteriaId]) && is_numeric($normalizedMatrix[$criteriaId]))
                        {
                            // * *** PERBAIKAN SKOR RENDAH: Gunakan HANYA compatibility_weight ***
                            $weight = (float) $characteristic->compatibility_weight; // * w_kj
                            $normalizedScore = (float) $normalizedMatrix[$criteriaId]; // * r_ij

                            $criteriaWeightedScore = $normalizedScore * $weight;
                            $finalScore += $criteriaWeightedScore;

                            // * Simpan kontribusi untuk alasan (hanya jika berkontribusi positif)
                            if ($criteriaWeightedScore > 0)
                            {
                                $contributors[$characteristic->criteria->name ?? "Kriteria ID {$criteriaId}"] = $criteriaWeightedScore;
                            }
                            // * Log::debug("Calculating score for Major {$major->id}, Criteria {$criteriaId}: NormScore={$normalizedScore}, Weight={$weight}, WeightedScore={$criteriaWeightedScore}, CurrentTotal={$finalScore}");
                        }
                        else
                        {
                            // * Log::warning("Normalized score for criteria {$criteriaId} not found or invalid for student {$student->id} when calculating major {$major->id}.");
                        }
                    }

                    // * *** PERBAIKAN ALASAN KOSONG ***
                    if (!empty($contributors))
                    {
                        // * Urutkan kriteria berdasarkan kontribusi skor (descending)
                        arsort($contributors);
                        Log::debug("Major [{$major->id}] '{$major->major_name}': Contributors after sort: " . json_encode($contributors));

                        $topContributorsKeys = array_keys($contributors);
                        Log::debug("Major [{$major->id}] '{$major->major_name}': Top contributor keys: " . json_encode($topContributorsKeys));

                        $topN = 3; // * Ambil top 3
                        $topContributorsSlice = array_slice($topContributorsKeys, 0, $topN);
                        Log::debug("Major [{$major->id}] '{$major->major_name}': Top {$topN} contributors slice: " . json_encode($topContributorsSlice));

                        if (!empty($topContributorsSlice))
                        { // * Pastikan hasil slice tidak kosong
                            $reasonParts[] = "Cocok berdasarkan kriteria: " . implode(', ', $topContributorsSlice) . ".";
                            Log::debug("Major [{$major->id}] '{$major->major_name}': Reason part added: " . end($reasonParts));
                        }
                        else
                        {
                            $reasonParts[] = "Skor dihitung berdasarkan kriteria yang relevan.";
                            Log::warning("Major [{$major->id}] '{$major->major_name}': topContributorsSlice was empty even though contributors were not.");
                        }
                    }
                    else if ($finalScore > 0)
                    {
                        // * Jika skor > 0 tapi tidak ada kontributor (jarang terjadi), beri alasan generik
                        $reasonParts[] = "Skor dihitung berdasarkan kriteria yang relevan.";
                        Log::warning("Major [{$major->id}] '{$major->major_name}': finalScore > 0 but contributors array was empty.");
                    }
                    else
                    {
                        // * Jika skor akhir 0 meskipun memenuhi syarat (misal semua bobot/skor 0)
                        $reasonParts[] = "Tidak ada kecocokan signifikan berdasarkan kriteria yang ada.";
                        Log::info("Major [{$major->id}] '{$major->major_name}': finalScore is 0 despite meeting requirements.");
                    }
                }
                else // * Jika tidak memenuhi syarat minimum
                {
                    $finalScore = 0; // * Skor dibuat 0 agar tidak direkomendasikan
                    $reasonParts[] = "Tidak memenuhi syarat minimum untuk kriteria: " . implode(', ', $failedCriteriaNames) . ".";
                }

                // * Simpan hasil perhitungan untuk jurusan ini
                $reasonString = implode(' ', $reasonParts); // * Gabungkan alasan
                Log::debug("Major [{$major->id}] '{$major->major_name}': Final reason string before save: '{$reasonString}'");

                $sawScores[$major->id] = [
                    'major_id' => $major->id,
                    'final_score' => $finalScore,
                    'reason' => $reasonString // * Simpan string yang sudah digabung
                ];

                Log::info("Calculated score for Major {$major->id} ('{$major->major_name}') for student {$student->id}: Score = {$finalScore}, MeetsReq = {$meetsMinimumRequirements}");
            } // * End foreach major

            // * 7. Urutkan hasil berdasarkan skor akhir (tertinggi ke terendah)
            uasort($sawScores, function ($a, $b)
            {
                // * Urutkan berdasarkan final_score descending
                return $b['final_score'] <=> $a['final_score'];
            });

            // * 8. Simpan hasil ke database dengan peringkat
            $rank = 1;
            foreach ($sawScores as $scoreData)
            {
                SawResult::create( // * Gunakan create karena sudah forceDelete di awal
                    [
                        'student_id' => $student->id,
                        'college_major_id' => $scoreData['major_id'],
                        'final_score' => $scoreData['final_score'],
                        'rank' => $rank,
                        'recommendation_reason' => $scoreData['reason'] ?: 'Tidak ada catatan khusus.', // * Fallback jika reason kosong
                        'calculation_date' => now() // * Set tanggal kalkulasi
                    ]
                );
                Log::info("Saved Rank {$rank} for Major {$scoreData['major_id']} for student {$student->id} with score {$scoreData['final_score']}");
                $rank++;
            }

            Log::info("SAW calculation completed successfully for student {$student->id}.");
            return true; // * Sukses

        }); // * End transaction
    }

    /**
     * Handle recalculation request from the form
     */
    public function recalculate(Student $student)
    {
        Log::info("Recalculation requested for student {$student->id}.");
        $result = $this->calculate($student);

        if ($result === true)
        {
            return redirect()->route('my-recommendations.index')
                ->with('success', 'Rekomendasi jurusan berhasil dihitung ulang.');
        }
        // * Jika calculate() mengembalikan RedirectResponse (karena error spt tidak ada nilai),
        // * kembalikan response tersebut langsung.
        else if ($result instanceof \Illuminate\Http\RedirectResponse)
        {
            return $result;
        }
        // * Handle kemungkinan error lain
        else
        {
            Log::error("Recalculation failed unexpectedly for student {$student->id}.");
            return redirect()->route('my-recommendations.index')
                ->with('error', 'Gagal menghitung ulang rekomendasi jurusan. Terjadi kesalahan.');
        }
    }

    private function isGradeExist(Student $student)
    {
        // * Cek apakah ada minimal satu skor untuk siswa ini
        return StudentScore::where('student_id', $student->id)->exists();
    }
}
