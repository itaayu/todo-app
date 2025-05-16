@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4 text-center">Tambah Kategori</h1>
        {{-- Tampilkan pesan error jika ada --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

         {{-- Form tambah kategori --}}
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Input nama kategori --}}
            <div>
                <label for="name" class="block font-semibold mb-1">Nama Kategori</label>
                <input type="text" id="name" name="name" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Misalnya: Kuliah, Kesehatan, Habit..." value="{{ old('name') }}">
            </div>

             {{-- Input warna kategori --}}
            <div>
                <label for="color" class="block font-semibold mb-1">Warna Kategori</label>
                <input type="color" id="color" name="color" class="w-20 h-10 p-0 border-0 cursor-pointer"
                    value="{{ old('color', '#9CA3AF') }}">
            </div>

            {{-- tombol aksi --}}
            <div class="flex justify-between items-center mt-6">
                {{-- Tombol Kembali di kiri --}}
                <a href="{{ route('categories.index') }}" class="text-sm text-gray-500 hover:text-blue-500 transition">
                    &larr; Kembali
                </a>

                {{-- Tombol simpan di kanan --}}
                <div class="flex gap-4 ml-auto">
                    <button type="submit" name="action" value="save"
                        class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
