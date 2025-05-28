<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\University;
use App\Models\CollegeMajor;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UniversityController extends Controller
{
    protected $cloudinaryService;

    public function __construct(CloudinaryService $cloudinaryService)
    {
        $this->cloudinaryService = $cloudinaryService;
    }

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

        return view('pages.admin.university.index', [
            'universities' => $universities,
            'statusOptions' => $statusOptions
        ]);
    }


    /**
     * Menampilkan form untuk membuat resource baru.
     */
    public function create()
    {
        // Tambahkan debug untuk memastikan data ada
        $collegeMajors = CollegeMajor::where('is_active', true)->orderBy('major_name')->get();

        // Jika tidak ada data, log warning untuk troubleshooting
        if ($collegeMajors->isEmpty())
        {
            Log::warning('Tidak ada jurusan kuliah aktif yang ditemukan');
        }

        $status = defined(University::class . '::STATUS') ? University::STATUS : ['negeri', 'swasta'];

        return view('pages.admin.university.create', [
            'status' => $status,
            'collegeMajors' => $collegeMajors
        ]);
    }

    /**
     * Menyimpan resource yang baru dibuat ke storage.
     */
    public function store(Request $request)
    {
        $universityData = $request->validate([
            'name' => ['required', 'string', 'max:150', Rule::unique('universities', 'name')],
            'status' => ['required', Rule::in(University::STATUS ?? ['negeri', 'swasta'])],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => ['required', 'numeric', 'between:0,5'],
            'is_active' => ['nullable', 'boolean'],
            'college_majors' => ['nullable', 'array'],
            'college_majors.*' => ['exists:college_majors,id']
        ]);

        $majorIds = $request->input('college_majors', []);

        try
        {
            DB::beginTransaction();

            // * Handle profile picture upload
            if ($request->hasFile('logo'))
            {
                $uploadedImage = $this->cloudinaryService->upload(
                    $request->file('logo'),
                    'logos',
                    ['transformation' => ['width' => 400, 'height' => 400, 'crop' => 'fill']]
                );

                // * Tambahkan URL dan ID gambar ke data yang akan diupdate
                $universityData['logo'] = $uploadedImage['url'];
                $universityData['logo_id'] = $uploadedImage['id'];
            }
            else
            {
                $universityData['logo'] = "https://i.pinimg.com/236x/c6/27/83/c62783232ffa8098770395a72e03655e.jpg";
            }

            $university = University::create($universityData);

            $university->collegeMajors()->sync($majorIds);

            DB::commit();

            return redirect()->route('admin.universities.index')
                ->with('success', 'Universitas berhasil dibuat beserta relasi jurusannya.');
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            Log::error("University creation failed: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menyimpan universitas. Silahkan coba lagi.')
                ->withInput();
        }
    }

    public function show(University $university)
    {
        $university->load('collegeMajors');
        return view("pages.admin.university.show", compact('university'));
    }


    /**
     * Menampilkan form untuk mengedit resource spesifik.
     */
    public function edit(University $university)
    {
        $collegeMajors = CollegeMajor::where('is_active', true)->orderBy('major_name')->get();

        // Jika tidak ada data, log warning untuk troubleshooting
        if ($collegeMajors->isEmpty())
        {
            Log::warning('Tidak ada jurusan kuliah aktif yang ditemukan saat edit university: ' . $university->id);
        }

        $universityMajorIds = $university->collegeMajors()->pluck('college_majors.id')->toArray();

        $status = defined(University::class . '::STATUS') ? University::STATUS : ['negeri', 'swasta'];

        return view('pages.admin.university.edit', [
            'university' => $university,
            'status' => $status,
            'collegeMajors' => $collegeMajors,
            'universityMajorIds' => $universityMajorIds
        ]);
    }

    /**
     * Memperbarui resource spesifik di storage.
     */
    public function update(Request $request, University $university)
    {
        $universityData = $request->validate([
            'name' => ['required', 'string', 'max:150', Rule::unique('universities', 'name')->ignore($university->id)],
            'status' => ['required', Rule::in(University::STATUS ?? ['negeri', 'swasta'])],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => ['required', 'numeric', 'between:0,5'],
            'is_active' => ['nullable'],
            'college_majors' => ['nullable', 'array'],
            'college_majors.*' => ['exists:college_majors,id']
        ]);

        $universityData['is_active'] = $request->has('is_active') && $request->input('is_active') == '1';

        $majorIds = $request->input('college_majors', []);

        try
        {
            DB::beginTransaction();

            // * Handle logo upload seperti di method store
            if ($request->hasFile('logo'))
            {
                // * Hapus logo lama jika ada
                if ($university->logo_id)
                {
                    $this->cloudinaryService->delete($university->logo_id);
                }

                $uploadedImage = $this->cloudinaryService->upload(
                    $request->file('logo'),
                    'logos',
                    ['transformation' => ['width' => 400, 'height' => 400, 'crop' => 'fill']]
                );

                // * Tambahkan URL dan ID gambar ke data yang akan diupdate
                $universityData['logo'] = $uploadedImage['url'];
                $universityData['logo_id'] = $uploadedImage['id'];
            }

            $university->update($universityData);

            $university->collegeMajors()->sync($majorIds);

            DB::commit();

            return redirect()->route('admin.universities.show', $university)
                ->with('success', 'Universitas berhasil diperbarui beserta relasi jurusannya.');
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            Log::error('University update failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data. Silahkan coba lagi.')
                ->withInput();
        }
    }

    public function destroy(University $university)
    {
        try
        {
            DB::beginTransaction();

            // * Hapus logo dari Cloudinary jika ada
            if ($university->logo_id)
            {
                $this->cloudinaryService->delete($university->logo_id);
            }

            $university->delete();

            DB::commit();

            return redirect()->route('admin.universities.index')
                ->with('success', 'Universitas behasil dihapus (soft delete)');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            DB::rollBack();
            Log::error('Gagal menghapus universitas (QueryException): ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus universitas: Pastikan tidak ada data terkait lainnya.');
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            Log::error('Gagal menghapus universitas: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus universitas. Terjadi kesalahan.');
        }
    }
}
