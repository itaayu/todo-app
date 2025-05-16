<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Todo List App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- FullCalendar CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

    {{-- Quill Editor CSS --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <main class="flex-1 container mx-auto px-4 pt-20">
        {{-- Notifikasi Flash (fallback jika SweetAlert tidak berjalan) --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- FullCalendar JS --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    {{-- Quill Editor JS --}}
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Stack Script Tambahan --}}
    @stack('scripts')

    {{-- Inisialisasi Quill --}}
    <script>
        // Jalankan hanya jika elemen #editor ditemukan
        if (document.querySelector('#editor')) {
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'list': 'check' }]
                    ]
                }
            });

            // Ambil isi editor ke hidden input saat submit
            document.querySelector('form')?.addEventListener('submit', function () {
                document.querySelector('#description').value = quill.root.innerHTML;
            });
        }
    </script>

    {{-- SweetAlert Feedback --}}
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
            });
        @elseif (session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: '{{ session('info') }}',
            });
        @endif
    </script>

</body>

</html>