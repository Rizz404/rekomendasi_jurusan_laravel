<?php

namespace App\Http\Controllers;

use App\Models\CollegeMajor;
use App\Models\MajorCharacteristic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class CollegeMajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collegeMajors = CollegeMajor::orderByDesc('created_at')->get();

        return view('admin.college-major.index', compact('collegeMajors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.college-major.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'major_name' => 'required|string|max:100|unique:college_majors',
            'faculty' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'field_of_study' => 'nullable|string|max:100',
            'career_prospects' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        try
        {
            CollegeMajor::create($validated);

            return redirect()->route('admin.college-majors.index')
                ->with('success', 'Jurusan kuliah berhasil dibuat');
        }
        catch (\Exception $e)
        {
            Log::error("Collage major creation failed: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menyimpan jurusan kuliah. Silahkan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CollegeMajor $collegeMajor)
    {
        // muat juga relasi 'criteria'-nya.
        $collegeMajor->load('majorCharacteristics.criteria');

        // Sekarang $collegeMajor->majorCharacteristics sudah berisi collection
        // dari MajorCharacteristic yang terkait, dan setiap item di dalamnya
        // sudah memiliki data $item->criteria yang ter-load.

        // Kirim $collegeMajor (yang sudah lengkap datanya) ke view
        return view("admin.college-major.show", compact('collegeMajor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CollegeMajor $collegeMajor)
    {
        return view("admin.college-major.edit", compact('collegeMajor'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Todo: Partial update mungkin soalnya unique validation bakalan ke triger
    public function update(Request $request, CollegeMajor $collegeMajor)
    {
        $validated = $request->validate([
            'major_name' => 'required|string|max:100',
            'faculty' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'field_of_study' => 'nullable|string|max:100',
            'career_prospects' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        try
        {
            $collegeMajor->update($validated);
            return redirect()->route('admin.college-majors.show', $collegeMajor)
                ->with('success', 'Jurusan kuliah berhasil diperbarui');
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
    public function destroy(CollegeMajor $collegeMajor)
    {
        try
        {
            $collegeMajor->delete();
            return redirect()->route('admin.college-majors.index')
                ->with('success', 'Jurusan kuliah behasil dihapus');
        }
        catch (\Exception $e)
        {
            Log::error('Gagal menghapus jurusan kuliah: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus jurusan kuliah: Data mungkin masih terkait dengan entitas lain');
        }
    }
}
