<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::withCount('schedules')->orderBy('nama')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'nip' => 'nullable|string|max:50|unique:teachers,nip',
            'email' => 'nullable|email|max:150|unique:teachers,email',
        ]);

        Teacher::create($data);
        return redirect()->route('admin.teachers.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'nip' => 'nullable|string|max:50|unique:teachers,nip,' . $teacher->id,
            'email' => 'nullable|email|max:150|unique:teachers,email,' . $teacher->id,
        ]);
        $teacher->update($data);
        return redirect()->route('admin.teachers.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Teacher::findOrFail($id)->delete();
        return back()->with('success', 'Data guru berhasil dihapus.');
    }
}
