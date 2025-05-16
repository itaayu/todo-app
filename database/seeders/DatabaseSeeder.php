<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Todo;
use App\Models\Note;
use App\Models\Agenda;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 10 kategori dulu
        Category::factory()->count(15)->create();

        // Buat 20 todo
        Todo::factory()->count(50)->create();

        // Buat 15 catatan
        Note::factory()->count(50)->create();

        // Buat 10 agenda
        Agenda::factory()->count(50)->create();
    }
}
