@extends('admin.layout')
@section('content')
<div class="page-head"><div><div class="eyebrow">Monitoring</div><h1>Data Absensi</h1><p>Pantau kehadiran siswa secara terstruktur.</p></div></div>
<div class="card"><form class="filters" method="GET" action="{{ route('admin.attendances.index') }}"><div class="field"><label>Tanggal</label><input type="date" name="tanggal" value="{{ request('tanggal') }}"></div><div class="field"><label>Status</label><select name="status"><option value="">Semua Status</option>@foreach(['hadir','izin','sakit','alpa'] as $status)<option value="{{ $status }}" @selected(request('status')==$status)>{{ ucfirst($status) }}</option>@endforeach</select></div><button class="btn" type="submit">Filter</button><a class="btn ghost" href="{{ route('admin.attendances.index') }}">Reset</a></form>
<div class="card-head"><h3>Riwayat Kehadiran</h3><span>{{ $attendances->count() }} data ditemukan</span></div>
<div class="table-wrap"><table><thead><tr><th>Tanggal</th><th>Siswa</th><th>Kelas</th><th>Waktu</th><th>Status</th><th>Lokasi</th></tr></thead><tbody>
@forelse($attendances as $item)<tr><td>{{ optional($item->tanggal)->format('d M Y') }}</td><td><strong>{{ $item->student->nama ?? '-' }}</strong><br><small style="color:#6f879d">{{ $item->student->nis ?? '-' }}</small></td><td>{{ $item->student->classRoom->nama_kelas ?? '-' }}</td><td>{{ $item->waktu }}</td><td><span class="badge {{ $item->status==='hadir'?'green':($item->status==='izin'?'gold':'red') }}">{{ ucfirst($item->status) }}</span></td><td>{{ $item->qrLocation->nama_lokasi ?? '-' }}</td></tr>
@empty<tr><td colspan="6"><div class="empty"><strong>Belum ada data absensi</strong><span>Data kehadiran siswa akan muncul di halaman ini.</span></div></td></tr>@endforelse
</tbody></table></div></div>
@endsection