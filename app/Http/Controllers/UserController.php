<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = User::with('student')->orderByDesc('updated_at');

        // * Search
        if ($request->has('search'))
        {
            $search = $request->search;
            $query->where(function ($q) use ($search)
            {
                $q->where('username', 'ilike', "%{$search}%")
                    ->orWhere('email', 'ilike', "%{$search}%")
                    ->orWhereHas('student', function ($sq) use ($search)
                    {
                        $sq->where('name', 'ilike', "%{$search}%")
                            ->orWhere('NIS', 'ilike', "%{$search}%");
                    });
            });
        }

        // * Filter by role
        if ($request->has('role') && in_array($request->role, ['admin', 'user']))
        {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(10)->withQueryString();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // * Validasi data user
        $userData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20|unique:users',
            'password' => 'required|string|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        // * Validasi data student
        $studentData = $request->validate([
            'name' => 'required|string|max:100',
            'NIS' => 'nullable|string|max:20|unique:students',
            'gender' => 'required|in:man,woman',
            'school_origin' => 'required|string|max:100',
            'school_type' => 'required|in:high_school,vocational_school',
            'school_major' => 'required|string|max:100',
            'graduation_year' => 'required|integer',
        ]);

        try
        {
            $userData['password'] = Hash::make($userData['password']);
            $userData['profile_picture'] = "https://i.pinimg.com/736x/c6/ee/a1/c6eea122496fbe5aadc69231fddd5e2e.jpg";

            $user = User::create($userData);

            $studentData['user_id'] = $user->id;
            Student::create($studentData);

            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil dibuat!');
        }
        catch (\Exception $e)
        {
            Log::error("Student score creation failed: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menyimpan user. Silahkan coba lagi.")
                ->with("raw", $e)
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // * Eager load untuk relasi
        $user->load('student');

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('student');

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // * Validasi data user
        $userData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,user',
        ]);

        // * Validasi data student
        $studentData = $request->validate([
            'name' => 'required|string|max:100',
            'NIS' => ['nullable', 'string', 'max:20', Rule::unique('students')->ignore($user->student->id ?? 0)],
            'gender' => 'required|in:man,woman',
            'school_origin' => 'required|string|max:100',
            'school_type' => 'required|in:high_school,vocational_school',
            'school_major' => 'required|string|max:100',
            'graduation_year' => 'required|integer',
        ]);

        try
        {
            // * Update password kalo ada
            if ($request->filled('password'))
            {
                $request->validate([
                    'password' => 'required|string|confirmed',
                ]);
                $userData['password'] = Hash::make($request->password);
            }

            // * Update user
            $user->update($userData);

            // * Update or create student record
            if ($user->student)
            {
                $user->student->update($studentData);
            }
            else
            {
                $studentData['user_id'] = $user->id;
                Student::create($studentData);
            }

            return redirect()->route('admin.users.show', $user)
                ->with('success', 'Data user berhasil diperbarui!');
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
    public function destroy(User $user)
    {
        try
        {
            $user->delete();
            return redirect()->route("admin.users.index")
                ->with("success", "User berhasil dihapus");
        }
        catch (\Exception $e)
        {
            Log::error("Gagal menghapus user: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menghapus user: Data mungkin masih terkait dengan entitas lain");
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
                "user_ids" => "required|array|min:1",
                "user_ids.*" => "exists:users,id",
            ]);

            return redirect()->route("admin.users.index")
                ->with("success", "Berhasil menghapus banyak user");
        }
        catch (\Exception $e)
        {
            Log::error("Gagal menghapus banyak user: " . $e->getMessage());
            return redirect()->back()
                ->with("error", "Gagal menghapus banyak user: Data mungkin masih terkait dengan entitas lain");
        }
    }
}
