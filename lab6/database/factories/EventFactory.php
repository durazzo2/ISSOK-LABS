<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $types = ['seminar','workshop','lecture','panel'];
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraphs(3, true), // обично >20 chars
            'type' => $this->faker->randomElement($types),
            'organizer_id' => Organizer::factory(),
            'date' => $this->faker->dateTimeBetween('+1 days', '+1 year')->format('Y-m-d'),
        ];
    }

}
