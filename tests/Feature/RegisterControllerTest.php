<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRegisterSuccess()
    {
        // Mock data input
        $formData = [
            'fullName' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Hit endpoint register
        $response = $this->post(route('register.store'), $formData);

        // Pastikan user terdaftar di database
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);

        // Redirect ke halaman login
        $response->assertRedirect(route('login'));
    }

    public function testRegisterFailed()
    {
        // Invalid data (password tidak sesuai)
        $formData = [
            'fullName' => '',
            'email' => 'not-an-email',
            'password' => 'pass',
            'password_confirmation' => 'mismatch',
        ];

        $response = $this->post(route('register.store'), $formData);

        // Pastikan tidak ada user yang terdaftar
        $this->assertDatabaseCount('users', 0);

        // Pastikan validasi gagal dan kembali ke halaman sebelumnya
        $response->assertSessionHasErrors(['fullName', 'email', 'password']);
    }
}
