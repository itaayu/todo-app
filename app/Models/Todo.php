<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Category;

class Todo extends Model
{
    // * Model ini merepresentasikan tugas (todo) dengan deadline, prioritas, dan status.

    use HasFactory;
   protected $fillable = ['title', 'description', 'status', 'deadline', 'priority', 'is_draft', 'category_id'];

    // Menambahkan konstanta untuk prioritas
    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';

    // Fungsi untuk mendapatkan label prioritas
    public static function getPriorities()
    {
        return [
            self::PRIORITY_LOW => 'Low',
            self::PRIORITY_MEDIUM => 'Medium',
            self::PRIORITY_HIGH => 'High',
        ];
    }


    // Konstanta untuk status tugas
    const STATUS_PENDING = 'belum';
    const STATUS_DONE = 'selesai';
    const STATUS_LATE = 'terlambat';

    // Menghitung jumlah tugas yang belum selesai
    public static function countPending()
    {
        return self::where('status', self::STATUS_PENDING)->count();
    }

    // Menghitung jumlah tugas yang sudah selesai
    public static function countCompleted()
    {
        return self::where('status', self::STATUS_DONE)->count();
    }

    // Menghitung jumlah tugas yang terlambat
    public static function countLate()
    {
        return self::where('status', self::STATUS_PENDING)
            ->where('deadline', '<', Carbon::now())
            ->count();
    }

    // Mengambil tugas yang terlambat
    public static function getLateTasks()
    {
        return self::where('status', self::STATUS_PENDING)
            ->where('deadline', '<', Carbon::now())
            ->get();
    }

    // Mendapatkan semua tugas yang belum selesai dan lewat deadline
    public static function getOverdueTasks()
    {
        return self::where('status', self::STATUS_PENDING)
            ->where('deadline', '<', Carbon::now())
            ->get();
    }

    // Accessor: Cek apakah tugas terlambat
    public function getIsLateAttribute()
    {
        return $this->status === 'belum' && Carbon::parse($this->deadline)->isPast();
    }

    // Ambil tugas yang belum diselesaikan dan masih dalam draft
    public static function getDrafts()
    {
        return self::where('is_draft', true)->get();
    }

    // Ambil tugas yang sudah selesai atau tidak dalam draft
    public static function getNotDrafts()
    {
        return self::where('is_draft', false)->get();
    }

    // Relasi tugas dengan kategori (Todo belongs to Category).
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
