<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\CollegeMajor; // Tambahkan model CollegeMajor
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Storage;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $query = University::orderByDesc('updated_at');

        // * Search
        if ($request->has('search') && $request->search != '')
        {
            $search = $request->search;
            $query->where(function ($q) use ($search)
            {
                $q->where('name', 'ilike', "%{$search}%")
                    ->orWhere('city', 'ilike', "%{$search}%")
                    ->orWhere('province', 'ilike', "%{$search}%");
            });
        }

        // * Filter Status
        if ($request->has('status') && $request->status != '')
        {
            $query->where('status', $request->status);
        }

        // * Filter Aktif/Non-aktif
        if ($request->has('is_active') && $request->is_active != '')
        {
            $query->where('is_active', $request->is_active === '1');
        }

        $universities = $query->paginate(10)->withQueryString();

        $statusOptions = defined(University::class . '::STATUS') ? University::STATUS : ['negeri', 'swasta'];

        return view('admin.university.index', [
            'universities' => $universities,
            'statusOptions' => $statusOptions
        ]);
    }


    /**
     * Menampilkan form untuk membuat resource baru.
     */
    public function create()
    {
        // Ambil semua jurusan yang aktif untuk ditampilkan di form
        $collegeMajors = CollegeMajor::where('is_active', true)->orderBy('major_name')->get();

        // Ambil opsi status dari model jika konstanta ada
        $status = defined(University::class . '::STATUS') ? University::STATUS : ['negeri', 'swasta'];

        return view('admin.university.create', [
            'status' => $status,
            'collegeMajors' => $collegeMajors // Kirim data jurusan ke view
        ]);
    }

    /**
     * Menyimpan resource yang baru dibuat ke storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150', Rule::unique('universities', 'name')],
            'status' => ['required', Rule::in(University::STATUS ?? ['negeri', 'swasta'])],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'url', 'max:255'], // Sesuaikan jika file upload
            'rating' => ['required', 'numeric', 'between:0,5'],
            'is_active' => ['nullable'],
            // Validasi untuk input jurusan (array ID)
            'college_majors' => ['nullable', 'array'], // Harus berupa array jika dikirim
            'college_majors.*' => ['exists:college_majors,id'] // Setiap ID harus ada di tabel college_majors
        ]);

        // Menangani nilai boolean untuk is_active
        $validated['is_active'] = $request->has('is_active') && $request->input('is_active') == '1';

        // Ambil ID jurusan yang dipilih dari request
        $majorIds = $request->input('college_majors', []);

        try
        {
            // Buat universitas terlebih dahulu (tanpa data jurusan)
            $university = University::create($validated);

            // Sinkronkan (attach) jurusan yang dipilih ke universitas yang baru dibuat
            // sync() akan menangani penambahan relasi di tabel pivot
            $university->collegeMajors()->sync($majorIds);

            return redirect()->route('admin.universities.index')
                ->with('success', 'Universitas berhasil dibuat beserta relasi jurusannya.');
        }
        catch (\Exception $e)
        {
            Log::error("University creation failed: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menyimpan universitas. Silahkan coba lagi.')
                ->withInput();
        }
    }

    // ... (Method show tetap sama) ...
    public function show(University $university)
    {
        // Eager load relasi jurusan untuk ditampilkan di detail
        $university->load('collegeMajors');
        return view("admin.university.show", compact('university'));
    }


    /**
     * Menampilkan form untuk mengedit resource spesifik.
     */
    public function edit(University $university)
    {
        // Ambil semua jurusan yang aktif
        $collegeMajors = CollegeMajor::where('is_active', true)->orderBy('major_name')->get();

        // Ambil ID jurusan yang saat ini terhubung dengan universitas ini
        // pluck('college_majors.id') untuk memastikan mengambil ID dari tabel majors, bukan pivot
        $universityMajorIds = $university->collegeMajors()->pluck('college_majors.id')->toArray();

        // Ambil opsi status dari model jika konstanta ada
        $status = defined(University::class . '::STATUS') ? University::STATUS : ['negeri', 'swasta'];

        return view('admin.university.edit', [
            'university' => $university,
            'status' => $status,
            'collegeMajors' => $collegeMajors, // Semua jurusan aktif
            'universityMajorIds' => $universityMajorIds // ID jurusan yang terpilih saat ini
        ]);
    }

    /**
     * Memperbarui resource spesifik di storage.
     */
    public function update(Request $request, University $university)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150', Rule::unique('universities', 'name')->ignore($university->id)],
            'status' => ['required', Rule::in(University::STATUS ?? ['negeri', 'swasta'])],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'url', 'max:255'], // Sesuaikan jika file upload
            'rating' => ['required', 'numeric', 'between:0,5'],
            'is_active' => ['nullable'],
            // Validasi untuk input jurusan (array ID)
            'college_majors' => ['nullable', 'array'],
            'college_majors.*' => ['exists:college_majors,id']
        ]);

        // Menangani nilai boolean untuk is_active
        $validated['is_active'] = $request->has('is_active') && $request->input('is_active') == '1';

        // Ambil ID jurusan yang dipilih dari request
        $majorIds = $request->input('college_majors', []);


        try
        {
            // Update data universitas terlebih dahulu
            $university->update($validated);

            // Sinkronkan relasi jurusan
            // sync() akan menghapus relasi lama yang tidak ada di $majorIds
            // dan menambahkan relasi baru yang ada di $majorIds
            $university->collegeMajors()->sync($majorIds);

            return redirect()->route('admin.universities.show', $university)
                ->with('success', 'Universitas berhasil diperbarui beserta relasi jurusannya.');
        }
        catch (\Exception $e)
        {
            Log::error('University update failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data. Silahkan coba lagi.')
                ->withInput();
        }
    }

    // ... (Method destroy tetap sama) ...
    public function destroy(University $university)
    {
        try
        {
            // Penting: detach semua relasi sebelum menghapus (jika tidak pakai cascade on delete)
            // Jika sudah pakai cascade on delete di migration pivot, ini tidak wajib
            // $university->collegeMajors()->detach();

            // Opsional: Hapus logo terkait jika disimpan secara lokal
            // if ($university->logo && strpos($university->logo, '/storage/') !== false) { ... }

            $university->delete(); // Menggunakan soft delete jika model menggunakannya
            return redirect()->route('admin.universities.index')
                ->with('success', 'Universitas behasil dihapus (soft delete)');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            // Tangkap error jika ada foreign key constraint (meskipun detach/cascade seharusnya mencegah ini)
            Log::error('Gagal menghapus universitas (QueryException): ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus universitas: Pastikan tidak ada data terkait lainnya.');
        }
        catch (\Exception $e)
        {
            Log::error('Gagal menghapus universitas: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus universitas. Terjadi kesalahan.');
        }
    }
}
