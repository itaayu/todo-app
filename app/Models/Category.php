<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    // * Model ini merepresentasikan kategori yang digunakan untuk mengelompokkan
    //  * data Todo dan Note. Setiap kategori memiliki nama dan warna.

    use HasFactory;
    protected $fillable = ['name', 'color'];

    // * Relasi satu ke banyak dengan model Todo.
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    // * Relasi satu ke banyak dengan model Note.
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
