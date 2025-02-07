<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['fullName'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'user',
            'email_verified_at' => now()
        ]);

        // Redirect ke halaman login
        return redirect()->route('login');
    }
}
