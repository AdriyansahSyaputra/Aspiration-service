<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Aspiration;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResponseSentEmailTest extends TestCase
{
    use RefreshDatabase;

    public function testResponseSentEmail()
    {
        $this->seed();

        $user = User::where('email', 'joseph@gmail.com')
            ->where('role', 'admin')
            ->first();

        $response = $this->actingAs($user)->post(route('reports.store', ['report' => Aspiration::first()->slug]), [
            'subject' => 'Test Subject',
            'response' => 'Test Response',
            'aspiration_id' => Aspiration::first()->id,
            'user_id' => $user->id,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('reports.show', Aspiration::first()->slug));
    }
}
