<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Mengelola fitur CRUD untuk data kategori yang digunakan oleh Todo dan Catatan

    // Menampilkan semua kategori 
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Menampilkan detail kategori beserta todos dan notes terkait 
    public function show(Category $category)
    {
        $todos = $category->todos()->latest()->get();
        $notes = $category->notes()->latest()->get();

        return view('categories.show', compact('category', 'todos', 'notes'));
    }

    // Menampilkan halaman form tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    // Menyimpan data kategori baru ke database
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255', 'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',]);
        Category::create([
            'name' => $request->name,
            'color' => $request->color ?? '#9CA3AF', // default warna abu-abu
        ]);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan halaman edit kategori
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Memperbarui data kategori yang dipilih
    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255', 'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',]);
        $category->update([
            'name' => $request->name,
            'color' => $request->color ?? '#9CA3AF',
        ]);
        return redirect()->route('categories.index')->with('success', 'Kategori diperbarui');
    }

    // Menghapus data kategori dari database
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori dihapus');
    }
}
