<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Portal;

class PortalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 unique circulars
        for ($i = 0; $i < 30; $i++) {
            Portal::create([
                'UniversityName' => fake()->unique()->company(),
                'ProgramName' => fake()->jobTitle(),
                'Description' => fake()->text(),
                'Link' => fake()->unique()->url(),
                'ApplicationDeadline' => fake()->dateTimeBetween('now', '+1 year'),
                'Status' => fake()->randomElement(['Active', 'Inactive']),
            ]);
        }
    }
}
