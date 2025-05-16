@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        {{-- Judul halaman dinamis: Edit Tugas jika $todo ada, atau Tambah Tugas jika tidak --}}
        <h2 class="text-2xl font-semibold mb-6 text-center">
            {{ isset($todo) ? 'Edit Tugas' : 'Tambah Tugas' }}
        </h2>

        {{-- Form untuk tambah atau update tugas --}}
        <form method="POST" action="{{ isset($todo) ? route('todos.update', $todo->id) : route('todos.store') }}">
            @csrf
            @if (isset($todo))
                {{-- Jika edit, gunakan method PUT --}}
                @method('PUT')
            @endif

            {{-- Input Judul tugas --}}
            <div class="mb-6">
                <label for="title" class="block text-lg font-medium">Judul</label>
                <input id="title" type="text" name="title"
                    class="w-full border p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('title', $todo->title ?? '') }}" required>
            </div>

            {{-- Input Deskripsi tugas menggunakan Quill editor --}}
            <div class="mb-6">
                <label for="description" class="block font-semibold mb-2">Deskripsi Tugas:</label>

                {{-- Kontainer Quill editor --}}
                <div id="quill-editor" class="bg-white p-2 rounded-md border border-gray-300" style="height: 200px;"></div>

                {{-- Input hidden untuk menyimpan konten Quill yang akan dikirim ke server --}}
                <input type="hidden" name="description" id="description"
                    value="{{ old('description', $todo->description ?? '') }}">
            </div>

            {{-- Input tanggal deadline --}}
            <div class="mb-6">
                <label class="block text-lg font-medium">Deadline</label>
                <input type="date" name="deadline"
                    class="w-full border p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('deadline', isset($todo) ? $todo->deadline : '') }}" required>
            </div>

            {{-- Pilihan Status hanya muncul saat edit --}}
            @if (isset($todo))
                <div class="mb-6">
                    <label class="block text-lg font-medium">Status</label>
                    <select name="status"
                        class="w-full border p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="belum" {{ $todo->status === 'belum' ? 'selected' : '' }}>Belum</option>
                        <option value="selesai" {{ $todo->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
            @endif

            {{-- Pilihan Prioritas --}}
            <div class="mb-6">
                <label for="priority" class="block text-lg font-medium">Prioritas</label>
                <select name="priority" id="priority"
                    class="w-full border p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    {{-- Loop opsi prioritas dari variabel $priorities --}}
                    @foreach ($priorities as $key => $priority)
                        <option value="{{ $key }}" {{ $todo->priority == $key ? 'selected' : '' }}>
                            {{ $priority }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Pilihan Kategori --}}
            <div class="mb-6">
                <label for="category_id" class="block text-lg font-medium">Kategori</label>
                <select name="category_id"
                    class="w-full border p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Kategori</option>
                    {{-- Loop kategori --}}
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $todo->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jika tugas masih draft, beri hidden input untuk ubah ke aktif saat simpan --}}
            @if (isset($todo) && $todo->is_draft)
                <input type="hidden" name="is_draft" value="0">
                <div class="mb-6 p-4 bg-yellow-100 text-yellow-700 border border-yellow-300 rounded-md">
                    <strong>Catatan:</strong> Tugas ini adalah <em>draft</em>. Saat disimpan, status akan berubah menjadi
                    aktif.
                </div>
            @endif

            {{-- Tombol aksi: Kembali dan Submit --}}
            <div class="flex justify-between items-center mt-6">
                {{-- Tombol kembali --}}
                <a href="{{ route('todos.index') }}" class="text-sm text-gray-500 hover:text-blue-500 transition">
                    &larr; Kembali
                </a>

                {{-- Tombol submit form --}}
                <button
                    class="w-[100px] py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {{ isset($todo) ? 'Perbarui' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>

    {{-- Load Quill.js library untuk editor --}}
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        // Inisialisasi Quill editor dengan toolbar konfigurasi
        const quill = new Quill('#quill-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }, {
                        'list': 'check'
                    }],
                    ['link'],
                    ['clean']
                ]
            }
        });

        // Masukkan konten deskripsi lama ke editor saat halaman dimuat
        const oldDescription = `{!! addslashes(old('description', $todo->description ?? '')) !!}`;
        quill.root.innerHTML = oldDescription;

        // Sinkronkan isi Quill ke input hidden sebelum form submit
        document.querySelector('form').onsubmit = function() {
            document.querySelector('#description').value = quill.root.innerHTML;
        };
    </script>
@endsection
