<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AspirationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreAspirationSuccessfully()
    {
        $this->seed();

        // Setup user dengan role tertentu dan autentikasi
        $user = User::factory()->create();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('test.jpg');

        $formData = [
            'title' => 'Aspiration Test Title',
            'institution' => 'Some Institution',
            'aspiration' => 'Lorem ipsum dolor sit amet.',
            'date_occurred' => '2023-01-01',
            'location' => 'Some Location',
            'attachment' => $file,
        ];

        $response = $this->actingAs($user)
            ->post(route('aspiration.store'), $formData);

        // Assert redirect and success message
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Aspirasi berhasil dikirim.');

        // Assert database has the record
        $this->assertDatabaseHas('aspirations', [
            'title' => 'Aspiration Test Title',
            'institution' => 'Some Institution',
            'aspiration' => 'Lorem ipsum dolor sit amet.',
            'status' => 'pending',
            'user_id' => $user->id,
        ]);

        // Assert the file was stored
        Storage::disk('public')->exists('attachments');
    }


    public function testStoreAspirationWithInvalidFileExtension()
    {
        $this->seed();

        $user = User::factory()->create();

        Storage::fake('public');
        $invalidFile = UploadedFile::fake()->create('test.exe', 100);

        $formData = [
            'title' => 'Aspiration Test Title',
            'institution' => 'Some Institution',
            'aspiration' => 'Lorem ipsum dolor sit amet.',
            'date_occurred' => '2023-01-01',
            'location' => 'Some Location',
            'attachment' => $invalidFile,
        ];

        $response = $this->actingAs($user)
            ->post(route('aspiration.store'), $formData);

        $response->assertStatus(302);
        $response->assertSessionHas('error', 'File tidak valid. Hanya jpg, jpeg, png, dan pdf yang diizinkan.');
    }

    public function testStoreAspirationWithLargeFileSize()
    {
        $this->seed();

        $user = User::factory()->create();

        Storage::fake('public');
        $largeFile = UploadedFile::fake()->create('large.pdf', 6000); // 6 MB file

        $formData = [
            'title' => 'Aspiration Test Title',
            'institution' => 'Some Institution',
            'aspiration' => 'Lorem ipsum dolor sit amet.',
            'date_occurred' => '2023-01-01',
            'location' => 'Some Location',
            'attachment' => $largeFile,
        ];

        $response = $this->actingAs($user)
            ->post(route('aspiration.store'), $formData);

        $response->assertStatus(302);
        $response->assertSessionHas('error', 'Ukuran file maksimal 5 MB.');
    }
}
