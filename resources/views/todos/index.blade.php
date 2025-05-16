@extends('layouts.app')

@section('content')
    @php
        $priorityLabels = [
            'low' => 'Rendah',
            'medium' => 'Sedang',
            'high' => 'Tinggi',
        ];
    @endphp

    <!-- Judul Halaman -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-semibold text-gray-800">Dashboard Ringkasan</h2>
    </div>

    <!-- Ringkasan Tugas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-blue-500 text-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
            <h3 class="text-lg font-semibold mb-2">Tugas Belum Selesai</h3>
            <p class="text-4xl font-bold">{{ $pendingCount }}</p>
        </div>
        <div class="bg-green-500 text-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
            <h3 class="text-lg font-semibold mb-2">Tugas Selesai</h3>
            <p class="text-4xl font-bold">{{ $completedCount }}</p>
        </div>
        <div class="bg-red-500 text-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
            <h3 class="text-lg font-semibold mb-2">Tugas Terlambat</h3>
            <p class="text-4xl font-bold">{{ $lateCount }}</p>
        </div>
    </div>

    <!-- Notifikasi Tugas Terlambat -->
    @if ($overdueTasks->isNotEmpty())
        <div class="border border-red-200 bg-red-50 p-6 rounded-xl shadow-sm mb-8">
            <h2 class="text-lg font-semibold text-red-600 mb-4">Tugas yang Terlambat</h2>
            <ul class="list-disc pl-5 text-sm text-red-700 space-y-1">
                @foreach ($overdueTasks as $task)
                    <li>
                        <strong>{{ $task->title }}</strong>
                        (Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y') }})
                    </li>
                @endforeach
            </ul>
            <div class="mt-8 flex justify-center">
                {{ $overdueTasks->links() }}
            </div>
        </div>
    @else
        <p class="text-green-600 mb-8">Tidak ada tugas yang terlambat!</p>
    @endif

    <!-- Draft Section -->
    <div class="border border-gray-200 bg-gray-50 p-5 rounded-xl shadow-sm mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Tugas Draft</h2>
        <p class="text-gray-700">Terdapat <strong>{{ $drafts->count() }}</strong> tugas draft.</p>
        <a href="{{ route('todos.drafts') }}"
            class="inline-block mt-3 bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800 transition">
            Lihat Semua Draft
        </a>
    </div>

    <!-- Tombol Tambah -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('todos.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
            + Tambah Tugas
        </a>
    </div>

    <!-- Daftar Tugas - Notion Style Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($todos as $todo)
            @php
                // Warna berdasarkan prioritas
                $priorityColor = match ($todo->priority) {
                    'high' => 'bg-red-50 border-red-400 hover:border-red-500',
                    'medium' => 'bg-yellow-50 border-yellow-400 hover:border-yellow-500',
                    'low' => 'bg-green-50 border-green-400 hover:border-green-500',
                    default => 'bg-white border-gray-300 hover:border-gray-400',
                };
            @endphp

            <div class="relative border rounded-xl p-5 transition duration-200 hover:shadow-md {{ $priorityColor }}">
                <!-- Badge Prioritas -->
                <div
                    class="absolute top-3 right-3 text-xs font-semibold px-2 py-1 rounded-full
                    @if ($todo->priority === 'high') bg-red-500 text-white
                    @elseif($todo->priority === 'medium') bg-yellow-400 text-white
                @else bg-green-500 text-white @endif">
                    {{ $priorityLabels[$todo->priority] ?? ucfirst($todo->priority) }}
                </div>

                <!-- Judul -->
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $todo->title }}</h3>

                <!-- Deskripsi -->
                <div class="text-sm text-gray-600 mb-2 group relative">
                    <div class="line-clamp-4 group-hover:line-clamp-none transition-all duration-300">
                        {!! $todo->description !!}
                    </div>
                </div>

                <!-- Info Detail -->
                <div class="grid grid-cols-2 gap-y-1 text-xs text-gray-500 mb-4">
                    <div><span class="font-medium text-gray-700">Deadline:</span>
                        {{ \Carbon\Carbon::parse($todo->deadline)->format('d M Y') }}</div>
                    <div><span class="font-medium text-gray-700">Status:</span>
                        @if ($todo->status === 'selesai')
                            <span class="text-green-600 font-medium">Selesai</span>
                        @elseif($todo->isLate)
                            <span class="text-red-500 font-medium">Terlambat</span>
                        @else
                            <span class="text-yellow-500 font-medium">Belum</span>
                        @endif
                    </div>
                    <div><span class="font-medium text-gray-700">Kategori:</span> {{ $todo->category->name ?? '-' }}</div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex items-center gap-2 text-sm">
                    <a href="{{ route('todos.edit', $todo->id) }}"
                        class="px-3 py-1 border border-yellow-500 text-yellow-600 rounded hover:bg-yellow-50 transition duration-200">
                        ✏️ Edit
                    </a>
                    <form method="POST" action="{{ route('todos.destroy', $todo->id) }}"
                        onsubmit="return confirm('Yakin ingin hapus?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="px-3 py-1 border border-red-500 text-red-600 rounded hover:bg-red-50 transition duration-200">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

        {{-- Pesan Kalau Tidak Ada Tugas --}}
        @if ($todos->isEmpty())
            <p class="text-center text-gray-500 mt-8 col-span-full">Belum ada tugas yang dibuat.</p>
        @endif
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $todos->links() }}
    </div>
@endsection
