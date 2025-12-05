<?php

namespace Database\Factories;

use App\Models\Organizer;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'type' => $this->faker->randomElement(['семинар', 'работилница', 'предавање']),
            'date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'organizer_id' => Organizer::factory(), // ако нема organizer се креира автоматски
        ];
    }
}
