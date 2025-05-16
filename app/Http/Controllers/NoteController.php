<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\Category;

class NoteController extends Controller
{
    // Mengelola operasi CRUD untuk entitas Catatan (Note).

    // Menampilkan daftar catatan dengan kategori terkait.
    public function index()
    {
        $notes = Note::with('category')->paginate(6);
        return view('notes.index', compact('notes'));
    }

    // Menampilkan form untuk membuat catatan baru.
    public function create()
    {
        $categories = Category::all();
        return view('notes.create', compact('categories'));
    }

    // Menyimpan catatan baru ke dalam database.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Note::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);


        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dibuat.');
    }

    // Menampilkan detail catatan berdasarkan ID.
    public function show($id)
    {
        $note = Note::with('category')->findOrFail($id);
        return view('notes.show', compact('note'));
    }

    // Menampilkan form untuk mengedit catatan.
    public function edit(Note $note)
    {
        $categories = Category::all();
        return view('notes.edit', compact('note', 'categories'));
    }

    // Memperbarui data catatan di database.
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil diperbarui.');
    }

    // Menghapus catatan dari database.
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dihapus.');
    }
}