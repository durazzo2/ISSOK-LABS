<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organizer;

class OrganizerSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 organizers
        Organizer::factory()->count(10)->create();
    }
}
