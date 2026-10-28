@extends('admin.layout')
@section('content')
<div class="page-head"><div><div class="eyebrow">Management</div><h1>Data Kelas</h1><p>Kelola kelas dan jumlah siswa di dalamnya.</p></div><a class="btn" href="{{ route('admin.classes.create') }}">＋ Tambah Kelas</a></div>
@if(session('success'))<div class="alert">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert error">{{ session('error') }}</div>@endif
<div class="card"><div class="card-head"><h3>Daftar Kelas</h3><span>{{ $classes->count() }} kelas aktif</span></div><div class="table-wrap"><table><thead><tr><th>No</th><th>Nama Kelas</th><th>Jumlah Siswa</th><th>Aksi</th></tr></thead><tbody>
@forelse($classes as $class)<tr><td>{{ $loop->iteration }}</td><td><strong>{{ $class->nama_kelas }}</strong></td><td><span class="badge blue">{{ $class->students_count }} Siswa</span></td><td><div class="actions"><a class="mini" href="{{ route('admin.classes.edit',$class->id) }}">Edit</a><form action="{{ route('admin.classes.destroy',$class->id) }}" method="POST" onsubmit="return confirm('Hapus kelas ini?')">@csrf @method('DELETE')<button class="mini delete" type="submit">Hapus</button></form></div></td></tr>
@empty<tr><td colspan="4"><div class="empty"><strong>Belum ada kelas</strong><span>Tambahkan kelas pertama kamu.</span></div></td></tr>@endforelse
</tbody></table></div></div>
@endsection