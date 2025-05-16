<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class TodoController extends Controller
{
    // Mengelola operasi CRUD dan logika tampilan untuk entitas Tugas (Todo).

    // Menampilkan daftar tugas dengan filter status, draft, dan statistik tugas.
    public function index(Request $request)
    {
        // Mengambil statistik tugas
        $pendingCount = Todo::countPending();
        $completedCount = Todo::countCompleted();
        $lateCount = Todo::countLate();

        // Filter status dari query string
        $status = $request->query('status');
        $today = now()->toDateString(); // format: "2025-05-08"

        $query = Todo::query();

        if ($status === 'belum') {
            $query->where('status', 'belum')->whereDate('deadline', '>=', $today);
        } elseif ($status === 'terlambat') {
            $query->where('status', 'belum')->whereDate('deadline', '<', $today);
        } elseif ($status === 'selesai') {
            $query->where('status', 'selesai');
        }

        $todos = $query->where('is_draft', false)
            ->orderBy('deadline')
            ->paginate(6);

        $drafts = Todo::where('is_draft', true)->orderBy('created_at', 'desc')->get();

        // Ambil tugas terlambat dengan pagination terpisah
        $overdueTasks = Todo::where('status', 'belum')
            ->whereDate('deadline', '<', $today)
            ->orderBy('deadline', 'asc')
            ->paginate(3, ['*'], 'overdue_page'); // nama parameter pagination beda

        return view('todos.index', compact('todos', 'status', 'pendingCount', 'completedCount', 'lateCount', 'overdueTasks', 'drafts'));
    }

    // Menampilkan form untuk membuat tugas baru.
    public function create()
    {
        $priorities = Todo::getPriorities();
        $categories = Category::all();
        return view('todos.create', compact('priorities', 'categories'));
    }

    // Menyimpan tugas baru ke dalam database, termasuk sebagai draft jika diperlukan.
    public function store(Request $request)
    {
        // Cek apakah disimpan sebagai draft atau tidak
        $isDraft = $request->input('action') === 'draft';

        //validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'priority' => 'required|in:low,medium,high', // Validasi prioritas
            'category_id' => 'required|exists:categories,id',
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'status' => 'belum',
            'is_draft' => $isDraft,
            'category_id' => $request->category_id, // ini WAJIB agar tidak null
        ]);

        if ($isDraft) {
            return redirect()->route('todos.index')->with('success', 'Tugas disimpan sebagai draft.');
        } else {
            return redirect()->route('todos.index')->with('success', 'Tugas berhasil ditambahkan.');
        }
    }

    // Menampilkan form untuk mengedit tugas.
    public function edit(Todo $todo)
    {
        $priorities = Todo::getPriorities();
        $categories = Category::all();
        return view('todos.edit', compact('todo', 'priorities', 'categories'));
    }

    // Memperbarui data tugas di database.
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $todo->update($request->all());

        return redirect()->route('todos.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    // Menghapus tugas dari database
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'Tugas berhasil dihapus!');
    }

    // Menampilkan daftar tugas yang disimpan sebagai draft.
    public function show()
    {
        $drafts = Todo::where('is_draft', true)->latest()->paginate(6);
        return view('todos.drafts', compact('drafts'));
    }
}
