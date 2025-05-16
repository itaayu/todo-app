<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake('id_ID')->sentence(3),
            'description' => fake('id_ID')->paragraph(2),
            'event_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
        ];
    }
}
