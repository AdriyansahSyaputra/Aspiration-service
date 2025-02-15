<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Jobs\SendOtpJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OtpVerification;
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
        $otpData = OtpVerification::where('email', $validated['email'])->first();

        if (!$otpData) {
            return back()->withErrors(['email' => 'Email tidak ditemukan, silakan kirim OTP terlebih dahulu.'])->withInput();
        }

        if ((string) $otpData->otp !== $validated['verification']) {
            return back()->withErrors(['verification' => 'Kode OTP tidak valid.']);
        }

        if (Carbon::now()->gt($otpData->expired_at)) {
            return back()->withErrors(['verification' => 'Kode OTP sudah kadaluarsa.']);
        }

        User::create([
            'name' => $validated['fullName'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Hapus OTP setelah digunakan
        $otpData->delete();

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
            OtpVerification::updateOrInsert(
                ['email' => $request->email],
                [
                    'otp' => $otp,
                    'expired_at' => Carbon::now()->addMinutes(5),
                    'updated_at' => now(),
                ]
            );

            // Kirim notifikasi
            dispatch(new SendOtpJob($request->email, $otp));

            return response()->json(['message' => 'OTP berhasil dikirim'], 200);
        } catch (\Exception $e) {
            Log::error('Send OTP Error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengirim OTP'], 500);
        }
    }
}
