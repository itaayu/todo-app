<!DOCTYPE html>
<html lang="id">

<head>
    {{-- 
        @section head
        Bagian <head> berisi meta informasi dan resource yang diperlukan halaman
        - Charset UTF-8 untuk encoding karakter universal
        - Viewport agar responsive di berbagai device
        - Title halaman: "Selamat Datang - Todo App"
        - Link ke Google Fonts (Inter) untuk font custom
        - Include Tailwind CSS via CDN untuk styling utilitas
    --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Todo App</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 to-white min-h-screen flex items-center justify-center font-sans">
    {{-- 
        @section body
        Struktur utama halaman welcome:
        - Background gradasi biru-putih
        - Container utama putih dengan shadow dan rounded corners
        - Header utama dengan judul dan deskripsi singkat
        - Gambar ikon todo dengan animasi bounce untuk visual menarik
        - Tombol link ke halaman daftar todo
        - Footer copyright sederhana
    --}}
    <div class="bg-white shadow-2xl rounded-2xl p-10 max-w-xl text-center">
        {{-- Judul utama halaman --}}
        <h1 class="text-4xl font-bold text-blue-700 mb-4">Selamat Datang di Todo App</h1>

        {{-- Deskripsi singkat aplikasi --}}
        <p class="text-gray-600 mb-6 text-lg">Kelola aktivitas harianmu dengan mudah, cepat, dan terorganisir.</p>

        {{-- Ikon ilustrasi todo --}}
        <img src="https://cdn-icons-png.flaticon.com/512/3022/3022254.png" alt="todo icon"
            class="w-32 mx-auto mb-6 animate-bounce">

        {{-- Tombol untuk mulai menggunakan aplikasi --}}
        <a href="{{ route('todos.index') }}"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold px-6 py-3 rounded-full shadow transition duration-300">
            Mulai Todo List
        </a>

        {{-- Footer copyright --}}
        <div class="mt-8 text-sm text-gray-400">
            &copy; {{ date('Y') }} Todo App | Dibuat dengan ❤️ oleh Kamu
        </div>
    </div>

</body>

</html>
