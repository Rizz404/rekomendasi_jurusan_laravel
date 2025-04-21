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
    public function index()
    {

        // Get only scores for the logged in student
        $majorChars = MajorCharacteristic::with(['criteria', 'college_major'])
            ->orderByDesc("created_at")
            ->get();

        return view("admin.major-characteristic.index", compact("majorChars"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CollegeMajor $collegeMajor)
    {
        $criterias = Criteria::where('is_active', true)
            ->orderByDesc("created_at")
            ->get();


        return view("admin.major-characteristic.create", [
            "collegeMajor" => $collegeMajor,
            "criterias" => $criterias,
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

            return redirect()->route("college-majors.show", $request->college_major_id)
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
    public function createMany(CollegeMajor $collegeMajor)
    {
        $criterias = Criteria::where('is_active', true)
            ->orderByDesc("created_at")
            ->get();

        return view("admin.major-characteristic.create-many", [
            "collegeMajor" => $collegeMajor,
            "criterias" => $criterias,
        ]);
    }

    /**
     * Store multiple student scores.
     */
    public function storeMany(Request $request)
    {
        $request->validate([
            "major_characteristics" => "required|array|min:1",
            // ? college major kan udah ditambahin tenang aja
            "major_characteristics.*.criteria_id" => [
                "required",
                "exists:criterias,id",
            ],
            "major_characteristics.*.compatibility_weight" => "required|decimal:2|between:0.01,999.99",
            "minimum_score.*.compatibility_weight" => "required|decimal:2|between:0.01,999.99",
        ]);

        $majorChars = $request->major_characteristics;
        $created = 0;

        try
        {
            foreach ($majorChars as $majorCharData)
            {
                $majorCharData['college_major_id'] = $request->college_major_id;

                // Todo: tambahin pengecekan kriteria yang sama
                MajorCharacteristic::create($majorCharData);
                $created++;
            }

            return redirect()->route("major-characteristics.index")
                ->with("success", "Karakteristik jurusan berhasil dibuat sebanyak {$created}");
        }
        catch (\Exception $e)
        {
            Log::error("Student score creation failed: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menyimpan karakteristik jurusan. Silahkan coba lagi.")
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MajorCharacteristic $majorChar)
    {
        $majorChar->load(['criteria']);
        return view("admin.major-characteristic.show", compact("majorChar"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MajorCharacteristic $majorChar)
    {

        $majorChar->load(['criteria']);

        return view("admin.major-characteristic.edit", [
            "majorChar" => $majorChar,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MajorCharacteristic $majorChar)
    {
        $validated = $request->validate([
            "compatibility_weight" => "required|decimal:2|between:0.01,999.99",
            "minimum_score" => "decimal:2|between:0.01,999.99",
        ]);

        try
        {
            $majorChar->update($validated);
            return redirect()->route("major-characteristics.show", $majorChar)
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
    public function destroy(MajorCharacteristic $majorChar)
    {
        try
        {
            $majorChar->delete();
            return redirect()->route("major-characteristics.index")
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

            return redirect()->route("major-characteristics.index")
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
