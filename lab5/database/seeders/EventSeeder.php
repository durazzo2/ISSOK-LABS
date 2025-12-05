<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $organizers = Organizer::all();

        foreach ($organizers as $org) {
            Event::factory()->count(3)->create([
                'organizer_id' => $org->id
            ]);
        }
    }
}
