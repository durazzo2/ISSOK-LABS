<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Organizer; // <--- IMPORTANT

class EventFactory extends Factory
{
    public function definition(): array
    {
        $types = ['seminar', 'workshop', 'lecture'];

        return [
            'name'         => $this->faker->sentence(3),
            'description'  => $this->faker->paragraph(3),
            'type'         => $this->faker->randomElement($types),
            'date'         => $this->faker->dateTimeBetween('+1 day', '+1 year')->format('Y-m-d'),

            // FIXED: correctly link organizer
            'organizer_id' => Organizer::factory(),
        ];
    }
}
