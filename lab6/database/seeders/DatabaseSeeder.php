<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\Organizer::factory()->count(10)->create()->each(function($organizer){
            \App\Models\Event::factory()->count(rand(1,5))->create(['organizer_id' => $organizer->id]);
        });
    }

}
