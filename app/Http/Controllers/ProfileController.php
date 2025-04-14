<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with('student')->find(Auth::id());
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Convert empty string to null for NIS
        $request->merge([
            'NIS' => $request->input('NIS') !== '' ? $request->input('NIS') : null,
        ]);

        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
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

        // Update User
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Update atau Create Student
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

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
