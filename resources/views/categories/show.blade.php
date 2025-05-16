@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">📁 Kategori: {{ $category->name }}</h2>

            {{-- Tombol Aksi --}}
            <div class="flex gap-2">
                <a href="{{ route('categories.edit', $category->id) }}"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg shadow transition">
                    ✏️ Edit
                </a>

                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow transition">
                        🗑️ Hapus
                    </button>
                </form>
            </div>
        </div>

        {{-- Daftar Todo --}}
        <div class="mb-10">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">📋 Daftar Tugas</h3>
            @if ($todos->count())
                <div class="space-y-4">
                    @foreach ($todos as $todo)
                        <div class="border-l-4 p-4 bg-white rounded shadow"
                            style="border-color: {{ $category->color ?? '#CBD5E1' }};">
                            <div class="text-lg font-medium text-gray-800">{{ $todo->title }}</div>
                            <div class="text-sm text-gray-500">
                                Status: <span class="capitalize">{{ $todo->status }}</span> •
                                Deadline: {{ \Carbon\Carbon::parse($todo->deadline)->translatedFormat('d M Y') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">Belum ada tugas untuk kategori ini.</p>
            @endif
        </div>

        {{-- Daftar Notes --}}
        <div class="mb-10">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">📝 Catatan</h3>
            @if ($notes->count())
                <div class="space-y-4">
                    @foreach ($notes as $note)
                        <div class="border-l-4 p-4 bg-white rounded shadow"
                            style="border-color: {{ $category->color ?? '#CBD5E1' }};">
                            <div class="text-lg font-medium text-gray-800">{{ $note->title }}</div>
                            <div class="text-sm text-gray-500">
                                {!! \Illuminate\Support\Str::limit(strip_tags($note->content), 100) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">Belum ada catatan untuk kategori ini.</p>
            @endif
        </div>

        {{-- Tombol Kembali --}}
        <div>
            <a href="{{ route('categories.index') }}" class="inline-block text-sm text-blue-600 hover:underline">
                ← Kembali ke Daftar Kategori
            </a>
        </div>

    </div>
@endsection
