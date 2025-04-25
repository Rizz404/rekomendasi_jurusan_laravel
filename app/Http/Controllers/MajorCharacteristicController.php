<?php

namespace App\Http\Controllers;

use App\Models\CollegeMajor;
use App\Models\Criteria;
use App\Models\Student;
use App\Models\MajorCharacteristic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MajorCharacteristicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MajorCharacteristic::with('criteria')
            ->with('collegeMajor')
            ->orderByDesc('updated_at');

        // * Search
        if ($request->has('search'))
        {
            $search = $request->search;
            $query->where(function ($q) use ($search)
            {
                $q->whereHas('collegeMajor', function ($sq) use ($search)
                {
                    $sq->where('major_name', 'ilike', "%{$search}%")
                        ->orWhere('faculty', 'ilike', "%{$search}%");
                })
                    ->orWhereHas('criteria', function ($sq) use ($search)
                    {
                        $sq->where('name', 'ilike', "%{$search}%");
                    });
            });
        }

        $majorCharacteristics = $query->paginate(10)->withQueryString();

        return view('admin.major-characteristic.index', compact('majorCharacteristics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CollegeMajor $collegeMajor)
    {
        $criterias = Criteria::where('is_active', true)
            ->orderByDesc("created_at")
            ->get();
        $collegeMajors = CollegeMajor::where('is_active', true)
            ->orderByDesc("created_at")
            ->get();


        return view("admin.major-characteristic.create", [
            "criterias" => $criterias,
            "collegeMajor" => $collegeMajor,
            "collegeMajors" => $collegeMajors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            "college_major_id" => [
                "required",
                "exists:college_majors,id",
            ],
            "criteria_id" => [
                "required",
                "exists:criterias,id",
            ],
            // ! tengok database lah kontol samain validasinya
            "compatibility_weight" => "required|numeric|between:0,1",
            "minimum_score" => "numeric|between:0,100",
        ]);

        try
        {
            MajorCharacteristic::create($validated);

            return redirect()->route("admin.college-majors.show", $request->college_major_id)
                ->with("success", "Karakteristik jurusan berhasil dibuat");
        }
        catch (\Exception $e)
        {
            Log::error("Student score creation failed: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menyimpan karakteristik jurusan. Silahkan coba lagi.")
                ->with("raw", $e)
                ->withInput();
        }
    }

    /**
     * Show form for creating multiple student scores.
     */
    // public function createMany(CollegeMajor $collegeMajor)
    // {
    //     $criterias = Criteria::where('is_active', true)
    //         ->orderByDesc("created_at")
    //         ->get();

    //     return view("admin.major-characteristic.create-many", [
    //         "collegeMajor" => $collegeMajor,
    //         "criterias" => $criterias,
    //     ]);
    // }

    // /**
    //  * Store multiple student scores.
    //  */
    // public function storeMany(Request $request)
    // {
    //     $request->validate([
    //         "major_characteristics" => "required|array|min:1",
    //         // ? college major kan udah ditambahin tenang aja
    //         "major_characteristics.*.criteria_id" => [
    //             "required",
    //             "exists:criterias,id",
    //         ],
    //         "major_characteristics.*.compatibility_weight" => "required|decimal:2|between:0.01,999.99",
    //         "minimum_score.*.compatibility_weight" => "required|decimal:2|between:0.01,999.99",
    //     ]);

    //     $majorCharacteristics = $request->major_characteristics;
    //     $created = 0;

    //     try
    //     {
    //         foreach ($majorCharacteristics as $majorCharacteristicData)
    //         {
    //             $majorCharacteristicData['college_major_id'] = $request->college_major_id;

    //             // Todo: tambahin pengecekan kriteria yang sama
    //             MajorCharacteristic::create($majorCharacteristicData);
    //             $created++;
    //         }

    //         return redirect()->route("admin.major-characteristics.index")
    //             ->with("success", "Karakteristik jurusan berhasil dibuat sebanyak {$created}");
    //     }
    //     catch (\Exception $e)
    //     {
    //         Log::error("Student score creation failed: " . $e->getMessage());
    //         return redirect()->back()
    //             ->with("error", "Gagal menyimpan karakteristik jurusan. Silahkan coba lagi.")
    //             ->withInput();
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show(MajorCharacteristic $majorCharacteristic)
    {
        $majorCharacteristic->load(['criteria']);
        return view("admin.major-characteristic.show", compact("majorCharacteristic"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // ! gak boleh ubah-ubah foreign id nya
    public function edit(MajorCharacteristic $majorCharacteristic)
    {
        $majorCharacteristic->load(['criteria', 'collegeMajor']);

        return view("admin.major-characteristic.edit", [
            "majorCharacteristic" => $majorCharacteristic,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MajorCharacteristic $majorCharacteristic)
    {
        $validated = $request->validate([
            "compatibility_weight" => "required|decimal:2|between:0.01,999.99",
            "minimum_score" => "decimal:2|between:0.01,999.99",
        ]);

        try
        {
            $majorCharacteristic->update($validated);
            return redirect()->route("admin.major-characteristics.show", $majorCharacteristic)
                ->with("success", "Karakteristik jurusan berhasil diperbarui");
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
    public function destroy(MajorCharacteristic $majorCharacteristic)
    {
        try
        {
            $majorCharacteristic->delete();
            return redirect()->route("admin.major-characteristics.index")
                ->with("success", "Karakteristik jurusan berhasil dihapus");
        }
        catch (\Exception $e)
        {
            Log::error("Gagal menghapus karakteristik jurusan: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menghapus karakteristik jurusan: Data mungkin masih terkait dengan entitas lain");
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
                "major_characteristic_ids" => "required|array|min:1",
                "major_characteristic_ids.*" => "exists:major_characteristics,id",
            ]);

            // Ensure the student can only delete their own scores
            $deleted = MajorCharacteristic::whereIn('id', $request->major_characteristic_ids)
                ->delete();

            return redirect()->route("admin.major-characteristics.index")
                ->with("success", "Berhasil menghapus {$deleted} karakteristik jurusan");
        }
        catch (\Exception $e)
        {
            Log::error("Gagal menghapus banyak karakteristik jurusan: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menghapus banyak karakteristik jurusan: Data mungkin masih terkait dengan entitas lain");
        }
    }
}
