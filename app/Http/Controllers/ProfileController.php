<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    protected $cloudinaryService;

    public function __construct(CloudinaryService $cloudinaryService)
    {
        $this->cloudinaryService = $cloudinaryService;
    }

    /**
     * Menampilkan profil pengguna
     */
    public function index()
    {
        $isLoggedIn = Auth::user();

        if (!$isLoggedIn)
        {
            return redirect()->route('login');
        }

        $user = User::with('student')->find(Auth::id());

        return view('user.profile.index', compact('user'));
    }

    /**
     * Update atau membuat profil pengguna dan data siswa
     */
    public function upsert(Request $request)
    {
        $user = Auth::user();

        if (!$user)
        {
            return redirect()->route('login');
        }

        // * Mengubah NIS kosong menjadi null
        $request->merge([
            'NIS' => $request->input('NIS') !== '' ? $request->input('NIS') : null,
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:20|unique:users,phone,' . $user->id,
            'NIS' => [
                'nullable',
                'numeric',
                Rule::unique('students')->ignore($user->student?->id),
            ],
            'gender' => 'nullable|in:man,woman',
            'school_origin' => 'nullable|string|max:100',
            'school_type' => 'nullable|in:high_school,vocational_school',
            'school_major' => 'nullable|string|max:100',
            'graduation_year' => 'nullable|integer|digits:4',
        ]);

        // * Data yang akan diupdate untuk user
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // * Handle profile picture upload
        if ($request->hasFile('profile_picture'))
        {
            // * Hapus gambar lama jika ada
            if ($user->profile_picture_id)
            {
                $this->cloudinaryService->delete($user->profile_picture_id);
            }

            $uploadedImage = $this->cloudinaryService->upload(
                $request->file('profile_picture'),
                'profile-pictures',
                ['transformation' => ['width' => 400, 'height' => 400, 'crop' => 'fill']]
            );

            // * Tambahkan URL dan ID gambar ke data yang akan diupdate
            $userData['profile_picture'] = $uploadedImage['url'];
            $userData['profile_picture_id'] = $uploadedImage['id'];
        }

        // * Update data user
        $user->update($userData);

        // * Update atau buat data student
        $user->student()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'NIS' => $request->NIS,
                'name' => $request->name,
                'gender' => $request->gender,
                'school_origin' => $request->school_origin,
                'school_type' => $request->school_type,
                'school_major' => $request->school_major,
                'graduation_year' => $request->graduation_year,
            ]
        );

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }
}
