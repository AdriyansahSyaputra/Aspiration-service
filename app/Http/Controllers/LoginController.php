<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Cek apakah checkbox remember me dicentang
        $remember = $request->has('remember') ? true : false;

        // Cek role & remember me
        if (Auth::attempt($credentials, $remember)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard');
            } elseif (Auth::user()->role == 'user') {
                return redirect()->route('home');
            }
        }

        return redirect()->back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
