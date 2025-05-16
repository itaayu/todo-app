<?php

// app/Models/Note.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Note extends Model
{
    //  * Model ini merepresentasikan catatan yang dapat dikategorikan.

    use HasFactory;

    protected $fillable = ['title', 'content','category_id',];

    //  * Relasi dengan kategori (Note belongs to Category).
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
