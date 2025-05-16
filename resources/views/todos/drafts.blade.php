@extends('layouts.app')

@section('content')
    {{-- Judul halaman daftar draft tugas --}}
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-semibold text-gray-800">Daftar Tugas Draft</h2>
    </div>

    {{-- Cek apakah ada draft, jika kosong tampilkan pesan --}}
    @if ($drafts->isEmpty())
        <div class="text-center text-gray-600">
            <p>Tidak ada tugas draft.</p>
        </div>
    @else
        {{-- Grid menampilkan kartu-kartu draft --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @foreach ($drafts as $draft)
                <div
                    class="border border-gray-200 bg-white rounded-xl p-5 shadow-sm hover:shadow-md transition duration-200">
                    {{-- Judul tugas draft --}}
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $draft->title }}</h3>

                    {{-- Tanggal deadline, format d M Y --}}
                    <p class="text-sm text-gray-500 mb-1">
                        <span class="font-medium text-gray-700">Deadline:</span>
                        {{ \Carbon\Carbon::parse($draft->deadline)->format('d M Y') }}
                    </p>

                    {{-- Deskripsi singkat draft, dibatasi 100 karakter dan strip_tags untuk hapus HTML --}}
                    <div class="text-sm text-gray-600 mb-4">
                        {{ Str::limit(strip_tags($draft->description), 100) }}
                    </div>

                    {{-- Tombol aksi untuk lanjut edit atau hapus draft --}}
                    <div class="flex gap-2 text-sm">
                        {{-- Tombol lanjutkan edit draft --}}
                        <a href="{{ route('todos.edit', $draft->id) }}"
                            class="px-3 py-1 border border-yellow-500 text-yellow-600 rounded hover:bg-yellow-50 transition duration-200">
                            ✏️ Lanjutkan
                        </a>

                        {{-- Form hapus draft dengan konfirmasi --}}
                        <form method="POST" action="{{ route('todos.destroy', $draft->id) }}"
                            onsubmit="return confirm('Yakin ingin hapus draft ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1 border border-red-500 text-red-600 rounded hover:bg-red-50 transition duration-200">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Tombol kembali ke daftar tugas utama --}}
    <div class="mt-4">
        <a href="{{ route('todos.index') }}" class="inline-block text-sm text-gray-500 hover:text-blue-600 transition">
            &larr; Kembali ke Daftar Tugas
        </a>
    </div>

    {{-- Pagination --}}
    <div class="mt-8 flex justify-center">
        {{-- Menampilkan link pagination --}}
        {{ $drafts->links() }}
    </div>
@endsection
