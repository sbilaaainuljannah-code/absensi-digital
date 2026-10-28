@extends('admin.layout')
@section('content')
<div class="page-head"><div><div class="eyebrow">Management</div><h1>Edit Kelas</h1><p>Buat kelas baru untuk data siswa.</p></div><a class="btn ghost" href="{{ route('admin.classes.index') }}">← Kembali</a></div>
<div class="card form-card"><form method="POST" action="{{ route('admin.classes.update',$class->id) }}">@csrf @method('PUT')
<div class="field"><label>Nama Kelas</label><input name="nama_kelas" value="{{ old('nama_kelas', $class->nama_kelas) }}" placeholder="Contoh: XII RPL 3" required></div>
@if($errors->any())<div class="alert error" style="margin-top:15px">{{ $errors->first() }}</div>@endif
<div class="form-actions"><button class="btn" type="submit">Simpan Kelas</button><a class="btn ghost" href="{{ route('admin.classes.index') }}">Batal</a></div></form></div>
@endsection