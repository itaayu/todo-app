@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-6 py-10 bg-white rounded-2xl shadow-md mt-6">

        {{-- Judul Catatan --}}
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $note->title }}</h1>

        {{-- Informasi Kategori & Tanggal dibuat --}}
        <div class="text-sm text-gray-500 flex items-center justify-between border-b pb-3 mb-6">
            <span><strong>Kategori:</strong> {{ $note->category->name ?? '-' }}</span>
            <span>Dibuat: {{ $note->created_at->format('d M Y') }}</span>
        </div>

        {{-- Konten Catatan --}}
        <div class="prose max-w-none text-gray-800 leading-relaxed">
            {{-- nl2br + escape agar baris baru tetap tampil dan aman --}}
            {!! nl2br(e($note->content)) !!}
        </div>

        {{-- Tombol navigasi dan aksi (Edit, Hapus) --}}
        <div class="flex items-center justify-between mt-10">

            {{-- Kembali ke halaman daftar catatan --}}
            <a href="{{ route('notes.index') }}" class="text-blue-600 hover:underline text-sm flex items-center gap-1">
                &larr; Kembali ke daftar
            </a>

            {{-- Aksi Edit dan Hapus --}}
            <div class="flex gap-2">

                {{-- Tombol Edit --}}
                <a href="{{ route('notes.edit', $note->id) }}"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm px-4 py-2 rounded shadow transition">
                    ✏️ Edit
                </a>

                {{-- Form Hapus Catatan --}}
                <form action="{{ route('notes.destroy', $note->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded shadow transition">
                        🗑️ Hapus
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
