@extends('layouts.app')

@section('content')
<!-- Container utama dengan lebar maksimal 4xl, center dan padding -->
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-center">Tambah Agenda</h1>

    <form action="{{ route('agendas.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Judul -->
        <div class="mb-6">
            <label for="title" class="block font-semibold text-gray-700 mb-2">Judul:</label>
            <input type="text" name="title" id="title"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <!-- Tanggal Acara -->
        <div class="mb-6">
            <label for="event_date" class="block font-semibold text-gray-700 mb-2">Tanggal Acara:</label>
            <input type="date" name="event_date" id="event_date"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <!-- Keterangan -->
        <div class="mb-6">
            <label for="description" class="block font-semibold text-gray-700 mb-2">Keterangan:</label>
            <textarea name="description" id="description" rows="4"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('agendas.index') }}" 
               class="text-sm text-gray-500 hover:text-blue-500 transition">
               &larr; Kembali
            </a>

            <button type="submit" name="action" value="save"
                class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 
                       focus:outline-none focus:ring-2 focus:ring-blue-500
                       hover:scale-105 transition-transform duration-200">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
