<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::withCount('students')
            ->orderBy('nama_kelas')
            ->get();

        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100|unique:classes,nama_kelas',
        ]);

        ClassRoom::create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $class = ClassRoom::findOrFail($id);

        return view('admin.classes.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $class = ClassRoom::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:100|unique:classes,nama_kelas,' . $class->id,
        ]);

        $class->update([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $class = ClassRoom::findOrFail($id);

        if ($class->students()->count() > 0) {
            return redirect()
                ->route('admin.classes.index')
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki siswa.');
        }

        $class->delete();

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}