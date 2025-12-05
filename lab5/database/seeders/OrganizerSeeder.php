<?php

namespace Database\Seeders;

use App\Models\Organizer;
use Illuminate\Database\Seeder;

class OrganizerSeeder extends Seeder
{
    public function run(): void
    {
        Organizer::factory()->count(5)->create();

        // Или рачно ако сакаш фиксни вредности:
        /*
        Organizer::create([
            'name' => 'Teodor Duracoski',
            'email' => 'teodor@example.com',
            'phone' => '070123456'
        ]);
        */
    }
}
