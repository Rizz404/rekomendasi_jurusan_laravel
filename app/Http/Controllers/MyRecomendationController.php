<?php

namespace App\Http\Controllers;

use App\Models\CollegeMajor;
use App\Models\Criteria;
use App\Models\MajorCharacteristic;
use App\Models\SawResult;
use App\Models\Student;
use App\Models\StudentScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyRecomendationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->firstOrFail();

        $recommendations = SawResult::with('collegeMajor')
            ->where('student_id', $student->id)
            ->orderBy('rank')
            ->get();

        if ($recommendations->isEmpty())
        {
            // * Kalkulasi kalo belum
            $this->calculate($student);

            $recommendations = SawResult::with('collegeMajor')
                ->where('student_id', $student->id)
                ->orderBy('rank')
                ->get();
        }

        return view('user.my-recomendation.index', compact('recommendations', 'student'));
    }

    public function calculate(Student $student)
    {

        SawResult::where('student_id', $student->id)->delete();

        $studentScores = StudentScore::where('student_id', $student->id)
            ->with('criteria')
            ->get();

        // * Kalo belum input nilai bakal back
        if ($studentScores->isEmpty())
        {
            return redirect()->back()->with('error', 'Student has no scores to calculate recommendations');
        }

        $criteria = Criteria::where('is_active', true)
            ->when($student->school_type === 'high_school', function ($query)
            {
                return $query->where(function ($q)
                {
                    $q->where('school_type', 'SMA')
                        ->orWhere('school_type', 'All');
                });
            })
            ->when($student->school_type === 'vocational_school', function ($query)
            {
                return $query->where(function ($q)
                {
                    $q->where('school_type', 'SMK')
                        ->orWhere('school_type', 'All');
                });
            })
            ->get();

        $collegeMajors = CollegeMajor::where('is_active', true)->get();

        // * Array untuk store normalisasi matrix
        $normalizedMatrix = [];

        foreach ($criteria as $criterion)
        {
            // * Ambil semua score untuk criteria ini
            $allScores = StudentScore::where('criteria_id', $criterion->id)->pluck('score')->toArray();

            if (empty($allScores)) continue;

            $studentScore = $studentScores->where('criteria_id', $criterion->id)->first();

            if (!$studentScore) continue;

            // * Kalkulasi berdasarkan tipe kriteria
            if ($criterion->type === 'benefit')
            {
                $max = max($allScores);
                $normalizedMatrix[$criterion->id] = $max > 0 ? ($studentScore->score / $max) : 0;
            }
            else
            {
                // * cost
                $min = min($allScores);
                $normalizedMatrix[$criterion->id] = $studentScore->score > 0 ? ($min / $studentScore->score) : 0;
            }
        }

        // * Kalkulasi final SAW untuk jurusan
        $sawScores = [];

        foreach ($collegeMajors as $major)
        {
            $characteristics = MajorCharacteristic::where('college_major_id', $major->id)
                ->with('criteria')
                ->get();

            // * Di skip kalo lupa nambahin karakteristik jurusan
            if ($characteristics->isEmpty()) continue;

            // * Cek minimal requirement
            $meetsMinimumRequirements = true;
            $failedCriteria = [];

            foreach ($characteristics as $characteristic)
            {
                if ($characteristic->minimum_score !== null)
                {
                    $studentScore = $studentScores->where('criteria_id', $characteristic->criteria_id)->first();

                    if (!$studentScore || $studentScore->score < $characteristic->minimum_score)
                    {
                        $meetsMinimumRequirements = false;
                        $failedCriteria[] = $characteristic->criteria->name;
                    }
                }
            }

            // * Kalkulasi berat score
            $finalScore = 0;
            $reasonParts = [];

            if ($meetsMinimumRequirements)
            {
                foreach ($characteristics as $characteristic)
                {
                    if (isset($normalizedMatrix[$characteristic->criteria_id]))
                    {
                        $criteriaWeightedScore = $normalizedMatrix[$characteristic->criteria_id] *
                            $characteristic->criteria->weight *
                            $characteristic->compatibility_weight;
                        $finalScore += $criteriaWeightedScore;

                        // * Simpan alasan untuk yang high compatibility
                        if ($characteristic->compatibility_weight > 0.7)
                        {
                            $reasonParts[] = "Strong match for {$characteristic->criteria->name}";
                        }
                    }
                }
            }
            else
            {
                // * set score rendah untuk jurusan yang tidak memenuhi kriteria
                $finalScore = 0;
                $reasonParts[] = "Doesn't meet minimum requirements for: " . implode(', ', $failedCriteria);
            }

            $sawScores[$major->id] = [
                'major_id' => $major->id,
                'final_score' => $finalScore,
                'reason' => $reasonParts
            ];
        }

        // * Sort berdasarkan score (descending)
        uasort($sawScores, function ($a, $b)
        {
            return $b['final_score'] <=> $a['final_score'];
        });

        // * Buat ranking dan save ke database
        $rank = 1;
        foreach ($sawScores as $majorId => $scoreData)
        {
            $recommendation = new SawResult();
            $recommendation->student_id = $student->id;
            $recommendation->college_major_id = $scoreData['major_id'];
            $recommendation->final_score = $scoreData['final_score'];
            $recommendation->rank = $rank;
            $recommendation->recommendation_reason = implode('. ', $scoreData['reason']);
            $recommendation->save();

            $rank++;
        }

        return true;
    }
}
