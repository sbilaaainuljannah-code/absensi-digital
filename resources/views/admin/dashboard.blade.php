@extends('admin.layout')
@section('content')
<div class="page-head"><div><div class="eyebrow">Overview · {{ now()->translatedFormat('l, d F Y') }}</div><h1>Dashboard Admin</h1><p>Pantau aktivitas absensi sekolah dari satu halaman.</p></div><a class="btn" href="{{ route('admin.qr.index') }}">＋ Buat QR Sesi</a></div>
@if(session('success'))<div class="alert">{{ session('success') }}</div>@endif
<div class="grid">
<div class="stat"><div class="stat-top"><span>Total Siswa</span><div class="stat-icon">♙</div></div><div class="stat-num">{{ $jumlahSiswa }}</div><div class="stat-foot">siswa terdaftar</div></div>
<div class="stat"><div class="stat-top"><span>Total Kelas</span><div class="stat-icon">▤</div></div><div class="stat-num">{{ $jumlahKelas }}</div><div class="stat-foot">kelas aktif</div></div>
<div class="stat"><div class="stat-top"><span>Absensi Hari Ini</span><div class="stat-icon">◷</div></div><div class="stat-num">{{ $jumlahAbsensiHariIni }}</div><div class="stat-foot">scan berhasil tercatat</div></div>
<div class="stat"><div class="stat-top"><span>Lokasi QR Aktif</span><div class="stat-icon">⌖</div></div><div class="stat-num">{{ $jumlahLokasiQr }}</div><div class="stat-foot">titik geofence aktif</div></div>
</div>
@php $total=$jumlahSiswa ?: 1; $hadir=$jumlahAbsensiHariIni; $persen=min(100,round(($hadir/$total)*100)); @endphp
<div class="dashboard-grid">
<div class="card"><div class="card-head"><h3>Ringkasan Kehadiran</h3><span>Hari ini</span></div><div class="ring-wrap"><div class="ring" style="--pct:{{ $persen }}%"><div class="ring-center"><strong>{{ $persen }}%</strong><span>tercatat</span></div></div><div class="legend"><div class="legend-item"><span class="dot green"></span><b>{{ $hadir }}</b> siswa sudah hadir</div><div class="legend-item"><span class="dot red"></span><b>{{ max(0,$jumlahSiswa-$hadir) }}</b> siswa belum tercatat</div><div class="legend-item"><span class="dot gold"></span>Validasi: QR + waktu + GPS</div></div></div></div>
<div class="card"><div class="card-head"><h3>Akses Cepat</h3><span>Menu favorit</span></div><div class="quick-grid"><a class="quick-tile" href="{{ route('admin.students.index') }}"><span>01</span><b>Data Siswa</b><span>Tambah & edit</span></a><a class="quick-tile" href="{{ route('admin.scan.index') }}"><span>02</span><b>Scan QR</b><span>Uji kamera</span></a><a class="quick-tile" href="{{ route('admin.reports.index') }}"><span>03</span><b>Rekap</b><span>Filter & export</span></a></div></div>
</div>
<div class="card" style="margin-top:16px"><div class="card-head"><h3>Aktivitas Absensi Terbaru</h3><span>{{ $absensiHariIni->count() }} data hari ini</span></div><div class="table-wrap"><table><thead><tr><th>Siswa</th><th>Kelas</th><th>Waktu</th><th>Status</th><th>Lokasi</th></tr></thead><tbody>@forelse($absensiHariIni->take(8) as $item)<tr><td><strong>{{ $item->student->nama ?? '-' }}</strong><br><small class="muted">{{ $item->student->nis ?? '-' }}</small></td><td>{{ $item->student->classRoom->nama_kelas ?? '-' }}</td><td>{{ $item->waktu }}</td><td><span class="badge green">{{ ucfirst($item->status) }}</span></td><td>{{ $item->qrLocation->nama_lokasi ?? '-' }}</td></tr>@empty<tr><td colspan="5"><div class="empty"><strong>Belum ada absensi hari ini</strong><span>Setelah siswa scan QR yang valid, datanya muncul di sini.</span></div></td></tr>@endforelse</tbody></table></div></div>
@endsection
