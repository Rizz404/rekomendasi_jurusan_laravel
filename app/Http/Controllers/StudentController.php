<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\TryCatch;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderByDesc('created_at')->get();

        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create')
            ->with('gender', Student::GENDERS)
            ->with('schoolTypes', Student::SCHOOL_TYPES);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NIS' => 'nullable|string|max:100|unique:students',
            'name' => 'nullable|string|max:100',
            'gender' => ['nullable', Rule::in(['man', 'woman'])],
            'school_origin' => 'nullable|string|max:100',
            'school_type' => ['nullable', Rule::in(['high_school', 'vocational_school'])],
            'school_major' => 'nullable|string|max:100',
            'graduation_year' => 'nullable|integer',
        ]);

        try
        {
            Student::create($validated);

            return redirect()->route('students.index')
                ->with('success', 'Siswa berhasil dibuat');
        }
        catch (\Exception $e)
        {
            Log::error("Collage major creation failed: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menyimpan siswa. Silahkan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view("student.show", compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view("student.edit", compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'NIS' => 'nullable|string|max:100|unique:students',
            'name' => 'nullable|string|max:100',
            'gender' => ['nullable', Rule::in(['man', 'woman'])],
            'school_origin' => 'nullable|string|max:100',
            'school_type' => ['nullable', Rule::in(['high_school', 'vocational_school'])],
            'school_major' => 'nullable|string|max:100',
            'graduation_year' => 'nullable|integer',
        ]);

        try
        {
            $student->update($validated);
            return redirect()->route('students.show', $student)
                ->with('success', 'Siswa berhasil diperbarui');
        }
        catch (\Exception $e)
        {
            Log::error('College Major update failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data. Silahkan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try
        {
            $student->delete();
            return redirect()->route('students.index')
                ->with('success', 'Siswa behasil dihapus');
        }
        catch (\Exception $e)
        {
            Log::error('Gagal menghapus siswa: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus siswa: Data mungkin masih terkait dengan entitas lain');
        }
    }
}
