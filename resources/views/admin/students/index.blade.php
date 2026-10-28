@extends('admin.layout')
@section('content')
<div class="page-head"><div><div class="eyebrow">Management</div><h1>Data Siswa</h1><p>Kelola siswa yang terdaftar dalam sistem.</p></div><a class="btn" href="{{ route('admin.students.create') }}">＋ Tambah Siswa</a></div>
@if(session('success'))<div class="alert">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert error">{{ session('error') }}</div>@endif
<div class="card"><div class="card-head"><h3>Daftar Siswa</h3><span>{{ $students->count() }} siswa terdaftar</span></div>
<div class="table-wrap"><table><thead><tr><th>No</th><th>Siswa</th><th>NIS</th><th>Kelas</th><th>Aksi</th></tr></thead><tbody>
@forelse($students as $student)<tr><td>{{ $loop->iteration }}</td><td><strong>{{ $student->nama }}</strong><br><small style="color:#6f879d">{{ $student->user->email ?? '-' }}</small></td><td>{{ $student->nis }}</td><td><span class="badge blue">{{ $student->classRoom->nama_kelas ?? '-' }}</span></td><td><div class="actions"><a class="mini" href="{{ route('admin.students.edit',$student->id) }}">Edit</a><form action="{{ route('admin.students.destroy',$student->id) }}" method="POST" onsubmit="return confirm('Hapus siswa ini?')">@csrf @method('DELETE')<button class="mini delete" type="submit">Hapus</button></form></div></td></tr>
@empty<tr><td colspan="5"><div class="empty"><strong>Belum ada siswa</strong><span>Tambahkan data siswa untuk mulai mengelola.</span></div></td></tr>@endforelse
</tbody></table></div></div>
@endsection