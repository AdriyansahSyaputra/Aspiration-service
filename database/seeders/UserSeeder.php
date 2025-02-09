<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Joseph Guardiola',
            'slug' => 'joseph-guardiola',
            'email' => 'joseph@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
            'email_verified_at' => now()
        ]);

        User::create([
            'id' => 2,
            'name' => 'John Doe',
            'slug' => 'john-doe',
            'email' => 'john@gmail.com',
            'role' => 'user',
            'password' => Hash::make('password'),
            'email_verified_at' => now()
        ]);
    }
}
