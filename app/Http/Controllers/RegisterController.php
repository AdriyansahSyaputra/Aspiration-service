<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;
use App\Notifications\SendOtpNotification;
use Illuminate\Support\Facades\Notification;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Cek apakah OTP cocok
        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan, silakan kirim OTP terlebih dahulu.'])->withInput();
        }

        if ($user->otp !== $validated['verification']) {
            return back()->withErrors(['verification' => 'Kode OTP tidak valid.']);
        }

        if (Carbon::now()->gt($user->otp_expired_at)) {
            return back()->withErrors(['verification' => 'Kode OTP sudah kadaluarsa.']);
        }

        $user = User::create([
            'name' => $validated['fullName'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'user',
            'email_verified_at' => now(),
            'otp' => null,
            'otp_expired_at' => null
        ]);

        // Redirect ke halaman login
        return redirect()->route('login');
    }

    public function sendOtp(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            // Generate OTP
            $otp = rand(100000, 999999);

            // Simpan OTP ke table terpisah
            DB::table('otp_verifications')->updateOrInsert(
                ['email' => $request->email],
                [
                    'otp' => $otp,
                    'expired_at' => Carbon::now()->addMinutes(5),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            // Kirim notifikasi
            Notification::route('mail', $request->email)
                ->notify(new SendOtpNotification($otp));

            return response()->json(['message' => 'OTP berhasil dikirim'], 200);
        } catch (\Exception $e) {
            Log::error('Send OTP Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengirim OTP'], 500);
        }
    }
}
