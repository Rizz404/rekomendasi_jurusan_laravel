<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Student;
use App\Models\StudentScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class StudentScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StudentScore::with('criteria')
            ->with('student')
            ->orderByDesc('updated_at');

        // * Search
        if ($request->has('search'))
        {
            $search = $request->search;
            $query->where(function ($q) use ($search)
            {
                $q->whereHas('student', function ($sq) use ($search)
                {
                    $sq->where('name', 'ilike', "%{$search}%")
                        ->orWhere('NIS', 'ilike', "%{$search}%");
                })
                    ->orWhereHas('criteria', function ($sq) use ($search)
                    {
                        $sq->where('name', 'ilike', "%{$search}%");
                    });
            });
        }

        $studentScores = $query->paginate(10)->withQueryString();

        return view('admin.student-score.index', compact('studentScores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $criterias = Criteria::where('is_active', true)
            ->orderByDesc("created_at")
            ->get();
        $students = Student::orderByDesc("created_at")
            ->get();

        return view("admin.student-score.create", [
            "criterias" => $criterias,
            "students" => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "criteria_id" => [
                "required",
                "exists:criterias,id",
            ],
            "student_id" => [
                "required",
                "exists:students,id",
            ],
            "score" => "required|decimal:2|between:0.01,999.99",
        ]);

        try
        {
            StudentScore::create($validated);

            return redirect()->route("admin.student-scores.index")
                ->with("success", "Nilai siswa berhasil dibuat");
        }
        catch (\Exception $e)
        {
            Log::error("Student score creation failed: " . $e->getMessage());
            return redirect()->back()
                ->with("raw", $e->getMessage())
                ->with("error", "Gagal menyimpan nilai siswa. Silahkan coba lagi.")
                ->withInput();
        }
    }

    /**
     * Show form for creating multiple student scores.
     */
    // public function createMany()
    // {
    //     // Get the currently logged in user
    //     $user = Auth::user();

    //     // Get the student associated with the logged in user
    //     $student = Student::where('user_id', $user->id)->first();

    //     if (!$student)
    //     {
    //         return redirect()->back()
    //             ->with("error", "Data siswa tidak ditemukan untuk user ini.");
    //     }

    //     // Get school type from student data to filter criterias
    //     $schoolType = $student->school_type === 'high_school' ? 'SMA' : 'SMK';

    //     // Get criterias based on student's school type or the "All" type
    //     $criterias = Criteria::where('is_active', true)
    //         ->where(function ($query) use ($schoolType)
    //         {
    //             $query->where('school_type', $schoolType)
    //                 ->orWhere('school_type', 'All');
    //         })
    //         ->orderByDesc("created_at")
    //         ->get();

    //     // Get criteria IDs that the student already has scores for
    //     $existingCriteriaIds = StudentScore::where('student_id', $student->id)
    //         ->pluck('criteria_id')
    //         ->toArray();

    //     // Filter out criteria that the student already has scores for
    //     $availableCriterias = $criterias->filter(function ($criteria) use ($existingCriteriaIds)
    //     {
    //         return !in_array($criteria->id, $existingCriteriaIds);
    //     });

    //     return view("admin.student-score.create-many", [
    //         "criterias" => $availableCriterias,
    //         "student" => $student
    //     ]);
    // }

    // /**
    //  * Store multiple student scores.
    //  */
    // public function storeMany(Request $request)
    // {
    //     // Get the currently logged in user
    //     $user = Auth::user();

    //     // Get the student associated with the logged in user
    //     $student = Student::where('user_id', $user->id)->first();

    //     if (!$student)
    //     {
    //         return redirect()->back()
    //             ->with("error", "Data siswa tidak ditemukan untuk user ini.");
    //     }

    //     $request->validate([
    //         "student_scores" => "required|array|min:1",
    //         "student_scores.*.criteria_id" => [
    //             "required",
    //             "exists:criterias,id",
    //         ],
    //         "student_scores.*.score" => "required|decimal:2|between:0.01,999.99",
    //     ]);

    //     $studentScores = $request->student_scores;
    //     $created = 0;

    //     try
    //     {
    //         foreach ($studentScores as $studentScoreData)
    //         {
    //             // Add the student_id to each score data
    //             $studentScoreData['student_id'] = $student->id;

    //             // Check for duplicate student_id and criteria_id combination
    //             $existingScore = StudentScore::where('student_id', $student->id)
    //                 ->where('criteria_id', $studentScoreData['criteria_id'])
    //                 ->first();

    //             if (!$existingScore)
    //             {
    //                 StudentScore::create($studentScoreData);
    //                 $created++;
    //             }
    //         }

    //         return redirect()->route("admin.student-scores.index")
    //             ->with("success", "Nilai siswa berhasil dibuat sebanyak {$created}");
    //     }
    //     catch (\Exception $e)
    //     {
    //         Log::error("Student score creation failed: " . $e->getMessage());
    //         return redirect()->back()
    //             ->with("error", "Gagal menyimpan nilai siswa. Silahkan coba lagi.")
    //             ->with("raw", $e)
    //             ->withInput();
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show(StudentScore $studentScore)
    {
        $studentScore->load(['criteria', 'student']);
        return view("admin.student-score.show", compact("studentScore"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentScore $studentScore)
    {
        $criterias = Criteria::where('is_active', true)
            ->orderByDesc("created_at")
            ->get();
        $students = Student::orderByDesc("created_at")
            ->get();

        $studentScore->load(['criteria', 'student']);

        return view("admin.student-score.edit", [
            "studentScore" => $studentScore,
            "students" => $students,
            "criterias" => $criterias,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentScore $studentScore)
    {

        $validated = $request->validate([
            "criteria_id" => [
                "required",
                "exists:criterias,id",
            ],
            "student_id" => [
                "required",
                "exists:students,id",
            ],
            "score" => "required|decimal:2|between:0.01,999.99",
        ]);

        try
        {
            $studentScore->update($validated);
            return redirect()->route("admin.student-scores.show", $studentScore)
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
        try
        {
            $studentScore->delete();
            return redirect()->route("admin.student-scores.index")
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
        try
        {
            $request->validate([
                "student_score_ids" => "required|array|min:1",
                "student_score_ids.*" => "exists:student_scores,id",
            ]);

            // Ensure the student can only delete their own scores
            $deleted = StudentScore::whereIn('id', $request->student_score_ids)
                ->delete();

            return redirect()->route("admin.student-scores.index")
                ->with("success", "Berhasil menghapus {$deleted} nilai siswa");
        }
        catch (\Exception $e)
        {
            Log::error("Gagal menghapus banyak nilai siswa: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menghapus banyak nilai siswa: Data mungkin masih terkait dengan entitas lain");
        }
    }
}
