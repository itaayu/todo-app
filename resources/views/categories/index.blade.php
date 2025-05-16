@extends('layouts.app')

@section('content')
    <div class="mb-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold text-gray-800">📁 Kategori</h1>
            <a href="{{ route('categories.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                + Tambah Kategori
            </a>
        </div>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 mb-4 rounded shadow-sm border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        {{-- Daftar kategori dalam bentuk chip --}}
        <div class="flex flex-wrap gap-3">
            @forelse ($categories as $category)
                @php
                    $color = $category->color ?? '#CBD5E1'; // fallback abu-abu terang
                @endphp
                <a href="{{ route('categories.show', $category->id) }}"
                    class="px-5 py-2 rounded-full border-2 shadow-sm hover:shadow-md transition-all font-medium text-sm"
                    style="border-color: {{ $color }}; color: {{ $color }};">
                    {{ $category->name }}
                </a>
            @empty
                <p class="text-gray-500 text-sm">Belum ada kategori tersedia.</p>
            @endforelse
        </div>

    </div>
@endsection
