@extends('layouts.app')

@section('content')
    {{-- Container utama form tambah tugas --}}
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        {{-- Judul halaman --}}
        <h1 class="text-2xl font-bold mb-6 text-center">Tambah Tugas</h1>

        {{-- Pesan error validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    {{-- Loop semua pesan error --}}
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li> {{-- Tampilkan pesan error --}}
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form tambah tugas --}}
        <form method="POST" action="{{ route('todos.store') }}">
            @csrf {{-- Token CSRF untuk keamanan form --}}

            {{-- Input Judul Tugas --}}
            <div class="mb-6">
                <label for="title" class="block text-lg font-semibold mb-2">Judul Tugas:</label>
                <input type="text" name="title" id="title"
                    class="w-full border p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('title') }}" {{-- Isi ulang value jika form gagal submit --}} required>
            </div>

            {{-- Input Deskripsi Tugas dengan editor custom --}}
            <div class="mb-6">
                <label for="description" class="block font-semibold mb-2">Deskripsi Tugas:</label>

                {{-- Editor WYSIWYG/custom --}}
                <div id="editor" class="bg-white p-3 rounded-md border h-40 overflow-y-auto"></div>

                {{-- Input tersembunyi yang menampung value deskripsi sebenarnya --}}
                <input type="hidden" name="description" id="description" value="{{ old('description') }}">
            </div>

            {{-- Input Deadline --}}
            <div class="mb-6">
                <label for="deadline" class="block text-lg font-semibold mb-2">Deadline:</label>
                <input type="date" name="deadline" id="deadline"
                    class="w-full border p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('deadline') }}" required>
            </div>

            {{-- Select Prioritas --}}
            <div class="mb-6">
                <label for="priority" class="block text-lg font-semibold mb-2">Prioritas:</label>
                <select name="priority" id="priority"
                    class="w-full border p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Prioritas --</option>
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Rendah</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Sedang</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>

            {{-- Select Kategori --}}
            <div class="mb-6">
                <label for="category_id" class="block text-lg font-semibold mb-2">Kategori:</label>
                <select name="category_id" id="category_id"
                    class="w-full border p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Kategori</option>
                    {{-- Loop semua kategori untuk opsi select --}}
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol aksi simpan / simpan draft --}}
            <div class="flex justify-between items-center mt-6">
                {{-- Link kembali ke daftar tugas --}}
                <a href="{{ route('todos.index') }}" class="text-sm text-gray-500 hover:text-blue-500 transition">
                    &larr; Kembali
                </a>

                <div class="flex gap-4 ml-auto">
                    {{-- Tombol submit simpan tugas --}}
                    <button type="submit" name="action" value="save"
                        class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan
                    </button>

                    {{-- Tombol submit simpan sebagai draft --}}
                    <button type="submit" name="action" value="draft"
                        class="bg-gray-500 text-white px-6 py-3 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Simpan sebagai Draft
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
