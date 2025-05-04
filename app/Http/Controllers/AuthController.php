<?php

namespace App\Http\Controllers;

use App\Models\SawResult;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('shared.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users',
                'alpha_dash'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(5)
            ]
        ]);

        try
        {
            $user = User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'profile_picture' => "https://i.pinimg.com/736x/c6/ee/a1/c6eea122496fbe5aadc69231fddd5e2e.jpg"
            ]);

            Student::create([
                'user_id' => $user->id,
            ]);

            return redirect()->route('login')->with('success', 'Registrasi berhasil!');
        }
        catch (\Exception $e)
        {
            return back()
                ->withInput()
                ->withErrors([
                    'registration_error' => 'Gagal membuat akun. Silakan coba lagi atau hubungi admin: ' . $e->getMessage()
                ]);
        }
    }

    public function showLoginForm()
    {
        return view('shared.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
                'max:255'
            ],
            'password' => [
                'required'
            ]
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember')))
        {
            $request->session()->regenerate();

            $redirectPath = match (Auth::user()->role)
            {
                'admin'    => route('admin.dashboard.index'),
                'user'  => route('home'),
                default    => '/home' // Fallback untuk role tidak dikenal
            };

            return redirect()->intended($redirectPath)
                ->with('success', 'Login berhasil!');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password tidak valid',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout');
    }
}
