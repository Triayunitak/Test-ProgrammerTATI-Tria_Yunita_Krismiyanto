<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. otomatis mencocokkan 'email_user' (dari database) dengan input 'email'
        // dan 'user_password' (dari model getAuthPassword) dengan input 'password'
        $credentials = [
            'email_user' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // 3. Jika Gagal
        return back()->withErrors([
            'email' => 'Kredensial tidak cocok dengan data kami.',
        ])->withInput();
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}