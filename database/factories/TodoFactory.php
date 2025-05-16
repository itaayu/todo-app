<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class TodoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake('id_ID')->sentence(3),
            'status' => fake()->randomElement(['belum', 'selesai']),
            'deadline' => fake()->dateTimeBetween('now', '+2 months'),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'is_draft' => fake()->boolean(30), // 30% draft
            'category_id' => Category::inRandomOrder()->first()?->id,
            'description' => fake('id_ID')->sentence(6)
        ];
    }
}
