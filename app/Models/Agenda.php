<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    // * Model ini merepresentasikan data agenda yang berisi informasi
    // * tentang kegiatan/event seperti judul, tanggal, dan deskripsi.
    use HasFactory;

    protected $fillable = ['title', 'event_date', 'description'];

}
