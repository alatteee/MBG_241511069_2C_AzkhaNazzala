<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    //Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Cek role user
            if (auth()->user()->role === 'gudang') {
                return redirect()->route('dashboard.gudang');
            } elseif (auth()->user()->role === 'dapur') {
                return redirect()->route('dashboard.dapur');
            }

            return redirect()->route('dashboard');
        }

        // Kalau gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    //Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    //Dashboard Gudang
    public function gudangDashboard()
    {
        return view('dashboard.gudang', ['user' => auth()->user()]);
    }

    //Dashboard Dapur
    public function dapurDashboard()
    {
        return view('dashboard.dapur', ['user' => auth()->user()]);
    }
}
