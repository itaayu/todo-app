<nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow px-6 py-4">
    <div class="container mx-auto flex justify-between items-center">
        {{-- Logo --}}
        <div class="text-xl font-bold text-blue-600">📋 TodoApp</div>

        {{-- Hamburger Button (untuk mobile) --}}
        <button id="menu-btn" class="block md:hidden text-gray-700 focus:outline-none" aria-label="Toggle menu">
            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                <path id="menu-icon" fill-rule="evenodd" clip-rule="evenodd"
                    d="M4 5h16v2H4V5zm0 6h16v2H4v-2zm0 6h16v2H4v-2z" />
            </svg>
        </button>

        {{-- Menu Links --}}
        <div id="menu" class="hidden md:flex space-x-4 text-sm font-medium">
            <a href="{{ route('todos.index') }}" class="text-gray-700 hover:text-blue-600 transition">Todo List</a>
            <a href="{{ route('notes.index') }}" class="text-gray-700 hover:text-blue-600 transition">Catatan</a>
            <a href="{{ route('agendas.index') }}" class="text-gray-700 hover:text-blue-600 transition">Agenda</a>
            <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-blue-600 transition">Kategori</a>
        </div>
    </div>

    {{-- Mobile menu (untuk layar kecil) --}}
    <div id="mobile-menu" class="hidden md:hidden px-6 pt-2 pb-4 space-y-2 bg-white shadow-inner">
        <a href="{{ route('todos.index') }}" class="block text-gray-700 hover:text-blue-600 transition">Todo List</a>
        <a href="{{ route('notes.index') }}" class="block text-gray-700 hover:text-blue-600 transition">Catatan</a>
        <a href="{{ route('agendas.index') }}" class="block text-gray-700 hover:text-blue-600 transition">Agenda</a>
        <a href="{{ route('categories.index') }}" class="block text-gray-700 hover:text-blue-600 transition">Kategori</a>
    </div>

    <script>
        // Toggle mobile menu
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('menu-btn');
            const menu = document.getElementById('mobile-menu');

            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        });
    </script>
</nav>
