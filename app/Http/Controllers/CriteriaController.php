<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Criteria::orderByDesc('updated_at');

        // * Search
        if ($request->has('search'))
        {
            $search = $request->search;
            $query->where(function ($q) use ($search)
            {
                $q->where('name', 'ilike', "%{$search}%");
            });
        }

        // * Filter by type
        if ($request->has('type') && in_array($request->type, ['benefit', 'cost']))
        {
            $query->where('type', $request->type);
        }

        // * Filter by school type
        if ($request->has('school_type') && in_array($request->school_type, ['SMA', 'SMK', 'All']))
        {
            $query->where('school_type', $request->school_type);
        }

        $criterias = $query->paginate(10)->withQueryString();

        return view('admin.criteria.index', compact('criterias'))
            ->with("types", Criteria::TYPES)
            ->with("schoolTypes", Criteria::SCHOOL_TYPES);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.criteria.create', [
            'schoolTypes' => Criteria::SCHOOL_TYPES,
            'types' => Criteria::TYPES
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:criterias',
            'type' => ['required', Rule::in(['benefit', 'cost'])],
            'weight' => 'required|decimal:2|between:0.01,999.99',
            'description' => 'nullable|string',
            'school_type' => ['required', Rule::in(['SMA', 'SMK', 'All'])],
            'is_active' => 'nullable|boolean'
        ]);

        try
        {
            Criteria::create($validated);

            return redirect()->route('admin.criterias.index')
                ->with('success', 'Kriteria berhasil dibuat');
        }
        catch (\Exception $e)
        {
            Log::error("Collage major creation failed: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menyimpan kriteria. Silahkan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Criteria $criteria)
    {
        return view("admin.criteria.show", compact('criteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criteria)
    {
        return view('admin.criteria.edit', [
            'criteria' => $criteria,
            'schoolTypes' => Criteria::SCHOOL_TYPES,
            'types' => Criteria::TYPES
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criteria)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('criterias')->ignore($criteria->id)
            ],
            'type' => ['required', Rule::in(['benefit', 'cost'])],
            'weight' => 'required|decimal:2|between:0.01,999.99',
            'description' => 'nullable|string',
            'school_type' => ['required', Rule::in(['SMA', 'SMK', 'All'])],
            'is_active' => 'required|boolean'
        ]);

        try
        {
            $criteria->update($validated);
            return redirect()->route('admin.criterias.show', $criteria)
                ->with('success', 'Kriteria berhasil diperbarui');
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
    public function destroy(Criteria $criteria)
    {
        try
        {
            $criteria->delete();
            return redirect()->route('admin.criterias.index')
                ->with('success', 'Kriteria behasil dihapus');
        }
        catch (\Exception $e)
        {
            Log::error('Gagal menghapus kriteria: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus kriteria: Data mungkin masih terkait dengan entitas lain');
        }
    }
}
