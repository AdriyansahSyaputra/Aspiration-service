<?php

namespace Database\Seeders;

use App\Models\Aspiration;
use App\Models\User;
use Database\Factories\AspirationFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AspirationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);
        Aspiration::factory(10)->create();

    }
}
