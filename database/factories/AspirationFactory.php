<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aspiration>
 */
class AspirationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => 'LA' . $this->faker->unique()->numberBetween(1000, 9999),
            'title' => $this->faker->sentence(3),
            'slug' => Str::slug($this->faker->sentence(3)),
            'institution' => $this->faker->randomElement([
                'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi',
                'Kementerian Kesehatan',
                'Kementerian Lingkungan Hidup dan Kehutanan',
                'Kementerian Perhubungan',
                'Kementerian Sosial',
            ]),
            'aspiration' => $this->faker->paragraph(3),
            'date_occurred' => $this->faker->date(),
            'location' => $this->faker->city(),
            'status' => $this->faker->randomElement(['pending', 'proses', 'selesai']),
            'attachment' => null,
            'user_id' => $this->faker->numberBetween(2, 3)
        ];
    }
}
