<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Form Login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        // Hanya admin yang boleh login
        if (Auth::user()->role !== 'admin') {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Akun ini tidak memiliki akses admin.',
            ]);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
