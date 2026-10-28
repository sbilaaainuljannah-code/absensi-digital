@extends('admin.layout')
@section('content')
<div class="page-head"><div><div class="eyebrow">Management</div><h1>Edit Siswa</h1><p>Daftarkan siswa baru ke sistem.</p></div><a class="btn ghost" href="{{ route('admin.students.index') }}">← Kembali</a></div>
<div class="card form-card"><form method="POST" action="{{ route('admin.students.update',$student->id) }}">@csrf @method('PUT')
<div class="form-grid"><div><label>Nama Siswa</label><input name="nama" value="{{ old('nama', $student->nama) }}" required></div><div><label>NIS</label><input name="nis" value="{{ old('nis', $student->nis) }}" required></div><div><label>Email</label><input type="email" name="email" value="{{ old('email', optional($student->user)->email) }}" required></div><div><label>Kelas</label><select name="class_id" required><option value="">Pilih kelas</option>@foreach($classes as $class)<option value="{{ $class->id }}" @selected(old('class_id', $student->class_id)==$class->id)>{{ $class->nama_kelas }}</option>@endforeach</select></div></div>
@if($errors->any())<div class="alert error" style="margin-top:17px">{{ $errors->first() }}</div>@endif
<div class="form-actions"><button class="btn" type="submit">Simpan Siswa</button><a class="btn ghost" href="{{ route('admin.students.index') }}">Batal</a></div></form></div>
@endsection