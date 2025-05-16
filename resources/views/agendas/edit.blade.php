@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-center">Edit Agenda</h1>

    <form action="{{ route('agendas.update', $agenda->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div>
            <label for="title" class="block font-semibold text-gray-700 mb-2">Judul:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $agenda->title) }}"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <!-- Tanggal Acara -->
        <div>
            <label for="event_date" class="block font-semibold text-gray-700 mb-2">Tanggal Acara:</label>
            <input type="date" name="event_date" id="event_date" value="{{ old('event_date', $agenda->event_date) }}"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <!-- Keterangan -->
        <div>
            <label for="description" class="block font-semibold text-gray-700 mb-2">Keterangan:</label>
            <textarea name="description" id="description" rows="4"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>{{ old('description', $agenda->description) }}</textarea>
        </div>

        <!-- Tombol aksi -->
        <div class="flex justify-between items-center mt-6">
            <!-- Link kembali -->
            <a href="{{ route('agendas.index') }}"
                class="text-sm text-gray-500 hover:text-blue-500 transition">&larr; Kembali</a>

            <!-- Tombol update -->
            <button type="submit" name="action" value="save"
                class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 
                       focus:outline-none focus:ring-2 focus:ring-blue-500
                       hover:scale-105 transition-transform duration-200">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
