<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // tampilkan halaman login
    public function login()
    {
        return view('auth.login');
    }

    // proses login
    public function loginProses(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8'
    ]);

    // 🔥 CEK IDENTITAS KERJA
    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user && $user->identitas_kerja == 'kementerian') {
        return back()->with('error', 'Akses ditolak untuk akun kementerian!');
    }

    // login normal
    if (Auth::attempt($request->only('email', 'password'))) {

        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Login berhasil!');
    }

    return back()
        ->with('error', 'Email atau password salah!')
        ->withInput();
}
    // logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Berhasil logout!');
    }
}