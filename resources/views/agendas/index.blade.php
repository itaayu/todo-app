@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-900">📅 Daftar Agenda</h1>
        <a href="{{ route('agendas.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
            + Tambah Agenda
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-4 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Daftar Agenda --}}
    <div class="w-full bg-white shadow rounded-lg p-4 mb-8 overflow-x-auto">
        <div id="calendar" class="w-full min-h-[400px]"></div>
    </div>

    <!-- Agenda List Section -->
    @if ($agendas->count())
        <div class="relative border-l border-gray-300 pl-6 space-y-8">
            @foreach ($agendas as $agenda)
                <div
                    class="relative bg-white rounded-lg shadow-sm p-5 hover:shadow-md transition flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">

                    <!-- Circle timeline dot -->
                    <span class="absolute -left-3 top-8 w-4 h-4 bg-blue-600 rounded-full border-2 border-white"></span>

                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-1">
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $agenda->title }}
                            </h3>
                            <time class="text-sm text-gray-500 whitespace-nowrap" datetime="{{ $agenda->event_date }}">
                                {{ \Carbon\Carbon::parse($agenda->event_date)->format('d M Y') }}
                            </time>
                        </div>
                        <p class="text-gray-700 text-sm leading-relaxed line-clamp-2">
                            {{ $agenda->description }}
                        </p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center gap-2 text-sm">
                        <a href="{{ route('agendas.edit', $agenda->id) }}"
                            class="px-3 py-1 border border-yellow-500 text-yellow-600 rounded hover:bg-yellow-50 transition duration-200">
                            ✏️ Edit
                        </a>
                        <form method="POST" action="{{ route('agendas.destroy', $agenda->id) }}"
                            onsubmit="return confirm('Yakin ingin hapus?')">
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

        <!-- Pagination Section -->
        <div class="mt-10 flex justify-center">
            {{ $agendas->links() }}
        </div>
    @else
        <div class="text-center text-gray-500 mt-10">
            Belum ada agenda yang ditambahkan.
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                height: 'auto',
                aspectRatio: 1.8,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                events: '{{ route('agendas.json') }}',
                contentHeight: "auto",
            });

            calendar.render();
        });
    </script>
@endpush
