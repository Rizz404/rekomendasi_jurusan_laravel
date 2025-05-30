<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Criteria;
use App\Models\Student;
use App\Models\StudentScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MyGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = $this->getAuthenticatedStudent();

        $studentScores = StudentScore::with(['criteria'])
            ->where('student_id', $student->id)
            ->orderByDesc("created_at")
            ->get();

        return view("pages.user.my-grade.index", compact("studentScores"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = $this->getAuthenticatedStudent(true);

        // * Biar gak error kalo return redirect (penting)
        if (!$student instanceof Student)
        {
            return $student;
        }

        $schoolType = $student->school_type === 'high_school' ? 'SMA' : 'SMK';

        $criterias = Criteria::where('is_active', true)
            ->where(function ($query) use ($schoolType)
            {
                $query->where('school_type', $schoolType)
                    ->orWhere('school_type', 'All');
            })
            ->orderByDesc("created_at")
            ->get();

        $existingCriteriaIds = StudentScore::where('student_id', $student->id)
            ->pluck('criteria_id')
            ->toArray();

        $availableCriterias = $criterias->filter(function ($criteria) use ($existingCriteriaIds)
        {
            return !in_array($criteria->id, $existingCriteriaIds);
        });

        return view("pages.user.my-grade.create", [
            "criterias" => $availableCriterias,
            "student" => $student
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = $this->getAuthenticatedStudent();

        $validated = $request->validate([
            "criteria_id" => [
                "required",
                "exists:criterias,id",
                Rule::unique('student_scores', 'criteria_id')
                    ->where('student_id', $student->id)
            ],
            "score" => "required|numeric|between:0.01,999.99",
        ]);

        $validated['student_id'] = $student->id;

        try
        {
            StudentScore::create($validated);

            return redirect()->route("my-grades.index")
                ->with("success", "Nilai siswa berhasil dibuat");
        }
        catch (\Exception $e)
        {
            Log::error("Student score creation failed: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menyimpan nilai siswa. Silahkan coba lagi.")
                ->withInput();
        }
    }

    /**
     * Show form for creating multiple student scores.
     */
    public function createMany()
    {
        $student = $this->getAuthenticatedStudent(true);

        // * Biar gak error kalo return redirect (penting)
        if (!$student instanceof Student)
        {
            return $student;
        }

        $schoolType = $student->school_type === 'high_school' ? 'SMA' : 'SMK';

        $criterias = Criteria::where('is_active', true)
            ->where(function ($query) use ($schoolType)
            {
                $query->where('school_type', $schoolType)
                    ->orWhere('school_type', 'All');
            })
            ->orderByDesc("created_at")
            ->get();

        $existingCriteriaIds = StudentScore::where('student_id', $student->id)
            ->pluck('criteria_id')
            ->toArray();

        $availableCriterias = $criterias->filter(function ($criteria) use ($existingCriteriaIds)
        {
            return !in_array($criteria->id, $existingCriteriaIds);
        });

        return view("pages.user.my-grade.create-many", [
            "criterias" => $availableCriterias,
            "student" => $student
        ]);
    }

    /**
     * Store multiple student scores.
     */
    public function storeMany(Request $request)
    {
        $student = $this->getAuthenticatedStudent();

        $request->validate([
            "student_scores" => "required|array|min:1",
            "student_scores.*.criteria_id" => [
                "required",
                "exists:criterias,id",
            ],
            "student_scores.*.score" => "required|numeric|between:0.01,999.99",
        ]);

        $studentScores = $request->student_scores;
        $created = 0;

        try
        {
            foreach ($studentScores as $studentScoreData)
            {
                $studentScoreData['student_id'] = $student->id;

                $existingScore = StudentScore::where('student_id', $student->id)
                    ->where('criteria_id', $studentScoreData['criteria_id'])
                    ->first();

                if (!$existingScore)
                {
                    StudentScore::create($studentScoreData);
                    $created++;
                }
            }

            return redirect()->route("my-grades.index")
                ->with("success", "Nilai siswa berhasil dibuat sebanyak {$created}");
        }
        catch (\Exception $e)
        {
            Log::error("Student score creation failed: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menyimpan nilai siswa. Silahkan coba lagi.")
                ->with("raw", $e)
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentScore $studentScore)
    {
        // if (!$this->verifyScoreOwnership($studentScore))
        // {
        //     return redirect()->route("my-grades.index")
        //         ->with("error", "Anda tidak memiliki akses ke nilai ini.");
        // }

        $studentScore->load(['criteria']);
        return view("pages.user.my-grade.show", compact("studentScore"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentScore $studentScore)
    {
        // if (!$this->verifyScoreOwnership($studentScore))
        // {
        //     return redirect()->route("my-grades.index")
        //         ->with("error", "Anda tidak memiliki akses untuk mengedit nilai ini.");
        // }

        $student = $this->getAuthenticatedStudent(true);

        // * Biar gak error kalo return redirect (penting)
        if (!$student instanceof Student)
        {
            return $student;
        }

        $schoolType = $student->school_type === 'high_school' ? 'SMA' : 'SMK';

        $criterias = Criteria::where('is_active', true)
            ->where(function ($query) use ($schoolType)
            {
                $query->where('school_type', $schoolType)
                    ->orWhere('school_type', 'All');
            })
            ->orderByDesc("created_at")
            ->get();

        $existingCriteriaIds = StudentScore::where('student_id', $student->id)
            ->pluck('criteria_id')
            ->toArray();

        $availableCriterias = $criterias->filter(function ($criteria) use ($existingCriteriaIds)
        {
            return !in_array($criteria->id, $existingCriteriaIds);
        });

        $studentScore->load(['criteria']);

        return view("pages.user.my-grade.edit", [
            "studentScore" => $studentScore,
            "student" => $student,
            "criterias" => $availableCriterias,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentScore $studentScore)
    {
        // if (!$this->verifyScoreOwnership($studentScore))
        // {
        //     return redirect()->route("my-grades.index")
        //         ->with("error", "Anda tidak memiliki akses untuk memperbarui nilai ini.");
        // }

        $validated = $request->validate([
            "score" => "required|numeric|between:0.01,999.99",
        ]);

        try
        {
            $studentScore->update($validated);
            return redirect()->route("my-grades.index", $studentScore)
                ->with("success", "Nilai siswa berhasil diperbarui");
        }
        catch (\Exception $e)
        {
            Log::error("Student score update failed: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal memperbarui data. Silahkan coba lagi.")
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentScore $studentScore)
    {
        // if (!$this->verifyScoreOwnership($studentScore))
        // {
        //     return redirect()->route("my-grades.index")
        //         ->with("error", "Anda tidak memiliki akses untuk menghapus nilai ini.");
        // }

        try
        {
            $studentScore->forceDelete();
            return redirect()->route("my-grades.index")
                ->with("success", "Nilai siswa berhasil dihapus");
        }
        catch (\Exception $e)
        {
            Log::error("Gagal menghapus nilai siswa: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menghapus nilai siswa: Data mungkin masih terkait dengan entitas lain");
        }
    }

    /**
     * Remove multiple student scores.
     */
    public function destroyMany(Request $request)
    {
        $student = $this->getAuthenticatedStudent();

        try
        {
            $request->validate([
                "student_score_ids" => "required|array|min:1",
                "student_score_ids.*" => "exists:student_scores,id",
            ]);

            $deleted = StudentScore::whereIn('id', $request->student_score_ids)
                ->where('student_id', $student->id)
                ->delete();

            return redirect()->route("my-grades.index")
                ->with("success", "Berhasil menghapus {$deleted} nilai siswa");
        }
        catch (\Exception $e)
        {
            Log::error("Gagal menghapus banyak nilai siswa: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menghapus banyak nilai siswa: Data mungkin masih terkait dengan entitas lain");
        }
    }

    private function getAuthenticatedStudent(bool $checkProfileComplete = false)
    {
        $user = Auth::user();
        if (!$user)
        {
            // Ini seharusnya ditangani oleh middleware auth, tapi sebagai fallback
            return redirect()->route('login')->with("error", "Silakan login terlebih dahulu.");
        }

        $student = Student::where('user_id', $user->id)->first();

        if (!$student)
        {
            Log::warning("Student record not found for user ID: {$user->id}. Redirecting to profile.");
            return redirect()->route('profile.index') // Asumsi ada route 'profile.index'
                ->with("error", "Data siswa tidak ditemukan. Mohon lengkapi profil Anda.");
        }


        if ($checkProfileComplete)
        {
            $missingFields = $this->getMissingProfileFields($student);
            if (!empty($missingFields))
            {
                $fieldNames = [
                    'NIS' => 'NIS',
                    'name' => 'Nama Lengkap',
                    'gender' => 'Jenis Kelamin',
                    'school_origin' => 'Asal Sekolah',
                    'school_type' => 'Jenis Sekolah (SMA/SMK)',
                    'school_major' => 'Jurusan Sekolah',
                    'graduation_year' => 'Tahun Lulus',
                ];
                $missingFieldNames = array_map(function ($field) use ($fieldNames)
                {
                    return $fieldNames[$field] ?? $field;
                }, $missingFields);

                $errorMessage = "Mohon lengkapi profil Anda terlebih dahulu. Bidang yang belum terisi: " . implode(', ', $missingFieldNames) . ".";
                return redirect()->route('profile.index')
                    ->with("warning", $errorMessage);
            }
        }

        return $student;
    }

    // Todo: Nanti benerin soalnya kaga work
    private function verifyScoreOwnership(StudentScore $studentScore)
    {
        $student = $this->getAuthenticatedStudent();

        if ($studentScore->student_id !== $student->id)
        {
            return false;
        }

        return true;
    }

    private function isProfileComplete(Student $student)
    {
        $requiredFields = [
            'NIS',
            'name',
            'gender',
            'school_origin',
            'school_type',
            'school_major',
            'graduation_year',
        ];

        foreach ($requiredFields as $field)
        {
            if (empty($student->$field))
            {
                return false;
            }
        }

        return true;
    }

    private function getMissingProfileFields(Student $student): array
    {
        $requiredFields = [
            'NIS',
            'name',
            'gender',
            'school_origin',
            'school_type',
            'school_major',
            'graduation_year',
        ];

        $missingFields = [];
        foreach ($requiredFields as $field)
        {
            if (empty($student->$field))
            {
                $missingFields[] = $field;
            }
        }
        return $missingFields;
    }
}
