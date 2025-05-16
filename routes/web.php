<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan route web untuk aplikasi Anda.
| Semua route akan dimuat oleh RouteServiceProvider dan
| diberi middleware grup "web" secara otomatis.
|
*/

// Route untuk halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Resource route untuk fitur Todo
// Menyediakan route standar CRUD: index, create, store, show, edit, update, destroy
Route::resource('todos', TodoController::class);

// Route khusus untuk menampilkan daftar tugas draft
Route::get('/todos/drafts', [TodoController::class, 'drafts'])->name('todos.drafts');


// Resource route untuk fitur Note (catatan)
// Termasuk CRUD standar, dengan tambahan route show yang eksplisit
Route::resource('notes', NoteController::class);
Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');


// Resource route untuk fitur Agenda (kalender & jadwal)
// Termasuk route JSON untuk keperluan API atau AJAX
Route::resource('agendas', AgendaController::class);
Route::get('/agendas-json', [AgendaController::class, 'json'])->name('agendas.json');


// Resource route untuk fitur Category (kategori/label)
// CRUD standar dengan route show eksplisit
Route::resource('categories', CategoryController::class);
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
