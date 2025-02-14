<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\OtpVerification;
use App\Notifications\SendOtpNotification;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testSendOtpSuccess()
    {
        Notification::fake();

        $response = $this->postJson('/send-otp', [
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'OTP berhasil dikirim']);

        Notification::assertSentTo(
            new AnonymousNotifiable,
            SendOtpNotification::class
        );

        $this->assertDatabaseHas('otp_verifications', [
            'email' => 'test@example.com',
        ]);
    }

    public function testRegisterWithValidOtp()
    {
        $otp = rand(100000, 999999);

        OtpVerification::create([
            'email' => 'test@example.com',
            'otp' => (string) $otp, // Pastikan tersimpan sebagai string
            'expired_at' => now()->addMinutes(5),
        ]);


        $response = $this->post('/register', [
            'fullName' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'verification' => (string) $otp,
        ]);

        $response->assertRedirect(route('login'));

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'John Doe',
        ]);

        $this->assertDatabaseMissing('otp_verifications', [
            'email' => 'test@example.com',
        ]);
    }

    public function testRegisterWithInvalidOtp()
    {
        OtpVerification::create([
            'email' => 'test@example.com',
            'otp' => '123456',
            'expired_at' => Carbon::now()->addMinutes(5),
        ]);

        $response = $this->post(route('register.index'), [
            'fullName' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'verification' => '999999',
        ]);

        $response->assertSessionHasErrors(['verification']);
        $this->assertDatabaseHas('otp_verifications', ['email' => 'test@example.com']);
    }

    public function testRegisterWithExpiredOtp()
    {
        OtpVerification::create([
            'email' => 'test@example.com',
            'otp' => '123456',
            'expired_at' => Carbon::now()->subMinutes(5),
        ]);

        $response = $this->post(route('register.index'), [
            'fullName' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'verification' => '123456',
        ]);

        $response->assertSessionHasErrors(['verification']);
        $this->assertDatabaseHas('otp_verifications', ['email' => 'test@example.com']);
    }

    public function testRegisterWithoutSendingOtpFirst()
    {
        $response = $this->post(route('register.index'), [
            'fullName' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'verification' => '123456',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users', ['email' => 'test@example.com']);
    }
}
