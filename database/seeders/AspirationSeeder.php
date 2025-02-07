<?php

namespace Database\Seeders;

use App\Models\Aspiration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AspirationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aspiration::create([
            'id' => 'LA0001',
            'title' => 'My first aspiration',
            'institution' => 'Institution 1',
            'aspiration' => 'Aspiration 1',
            'date_occurred' => '2023-01-01',
            'location' => 'Location 1',
            'attachment' => null,
            'user_id' => 1
        ]);
    }
}
