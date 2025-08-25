<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
      public function run(): void
    {
        // Use a loop to create 50 users
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
            ]);
        }
    }
}
