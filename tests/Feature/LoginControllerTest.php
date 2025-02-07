<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    public function testLoginSuccessForAdmin()
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        $formData = [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('login.login'), $formData);

        $response->assertRedirect(route('dashboard'));
    }

    public function testLoginSuccessForUser()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        $formData = [
            'email' => 'user@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('login.login'), $formData);

        $response->assertRedirect(route('home'));
    }

    public function testLoginFailed()
    {
        $formData = [
            'email' => 'nonexistent@example.com',
            'password' => 'wrong-password',
        ];

        $response = $this->post(route('login.login'), $formData);

        $response->assertRedirect()
            ->assertSessionHas('error', 'Email atau password salah');
    }
}
