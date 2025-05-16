@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">✏️ Catatan Saya</h1>

        <!-- Tombol Tambah Catatan -->
        <div class="mb-6 text-right">
            <a href="{{ route('notes.create') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
                + Tambah Catatan
            </a>
        </div>

        @if ($notes->count() > 0)
            <!-- Daftar Kartu Catatan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($notes as $note)
                    @php
                        $borderColor = $note->category->color ?? '#CBD5E1'; // default abu-abu terang jika tidak ada kategori
                    @endphp

                    <div class="relative rounded-xl p-5 transition duration-200 hover:shadow-md"
                        style="border: 2px solid {{ $borderColor }};">

                        {{-- Badge Nama Kategori --}}
                        @if ($note->category)
                            <span class="absolute top-3 right-3 text-xs font-semibold px-2 py-1 rounded-full"
                                style="background-color: {{ $borderColor }}; color: white;">
                                {{ $note->category->name }}
                            </span>
                        @endif

                        <!-- Judul Catatan -->
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">
                            <a href="{{ route('notes.show', $note->id) }}" class="hover:text-blue-600 transition">
                                {{ $note->title }}
                            </a>
                        </h2>

                        <!-- Preview Konten -->
                        <div class="text-sm text-gray-600 group relative mb-3">
                            <div class="line-clamp-5 group-hover:line-clamp-none transition-all duration-300">
                                {!! \Illuminate\Support\Str::limit(strip_tags($note->content), 100) !!}
                            </div>
                        </div>

                        <!-- Tombol Lihat Detail -->
                        <a href="{{ route('notes.show', $note->id) }}"
                            class="text-sm text-blue-500 font-medium hover:underline">
                            📄 Lihat Detail
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $notes->links() }}
            </div>
        @else
            <!-- Pesan Jika Tidak Ada Catatan -->
            <div class="text-center text-gray-500 mt-10">
                Belum ada catatan yang ditambahkan.
            </div>
        @endif
    </div>
@endsection
