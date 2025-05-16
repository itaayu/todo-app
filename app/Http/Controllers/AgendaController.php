<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;


class AgendaController extends Controller
{
    // /**
    //  * Controller ini menangani semua fitur CRUD untuk data Agenda,
    //  * termasuk fitur JSON untuk integrasi dengan kalender visual.

    // Menampilkan daftar agenda dengan pagination.
    public function index()
    {
        $agendas = Agenda::orderBy('event_date', 'asc')->paginate(6);
        return view('agendas.index', compact('agendas'));
    }

    // Menampilkan halaman form tambah agenda.
    public function create()
    {
        return view('agendas.create');
    }

    // Menyimpan data agenda baru ke database.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'event_date' => 'required|date',
            'description' => 'nullable'
        ]);

        Agenda::create($request->only(['title', 'event_date', 'description']));
        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil ditambahkan!');
    }

    // Menampilkan halaman edit agenda.
    public function edit(Agenda $agenda)
    {
        return view('agendas.edit', compact('agenda'));
    }

    // Memperbarui data agenda yang dipilih.
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'title' => 'required',
            'event_date' => 'required|date',
            'description' => 'nullable'
        ]);

        $agenda->update($request->only(['title', 'event_date', 'description']));
        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil diperbarui!');
    }

    // Menghapus agenda dari database.
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('agendas.index')->with('success', 'Agenda dihapus.');
    }

    // Mengembalikan data agenda dalam format JSON untuk kalender visual.
    public function json()
    {
        $agendas = Agenda::all();

        $events = $agendas->map(function ($agenda) {
            return [
                'title' => $agenda->title,
                'start' => $agenda->event_date,
                'color' => '#e3342f' // merah
            ];
        });

        return response()->json($events);
    }
}
