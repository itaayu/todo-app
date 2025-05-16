<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class NoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake('id_ID')->sentence(4),
            'content' => fake('id_ID')->paragraph(3),
            'category_id' => Category::inRandomOrder()->first()?->id,
        ];
    }
}
