@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
        {{-- Judul Halaman --}}
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Catatan</h1>

        {{-- Form Update Catatan --}}
        <form action="{{ route('notes.update', $note->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Input Judul --}}
            <div class="mb-4">
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul:</label>
                <input type="text" name="title" id="title"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('title', $note->title) }}" required>
            </div>

            {{-- Input Isi Catatan --}}
            <div class="mb-4">
                <label for="content" class="block text-sm font-semibold text-gray-700 mb-1">Isi Catatan:</label>
                <textarea name="content" id="content" rows="5"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>{{ old('content', $note->content) }}</textarea>
            </div>

            {{-- Pilih Kategori --}}
            <div class="mb-6">
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-1">Kategori:</label>
                <select name="category_id" id="category_id"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $note->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between">
                <a href="{{ route('notes.index') }}"
                   class="text-sm text-gray-500 hover:text-blue-500 transition">&larr; Kembali</a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow transition">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
