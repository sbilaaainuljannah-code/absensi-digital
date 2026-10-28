@extends('admin.layout')
@section('head')<script src="https://unpkg.com/html5-qrcode" defer></script>@endsection
@section('content')
<div class="page-head"><div><div class="eyebrow">Camera Scanner</div><h1>Scan QR</h1><p>Gunakan kamera untuk membaca token QR dan mengecek status sesi.</p></div><a class="btn ghost" href="{{ route('admin.qr.index') }}">Kelola QR</a></div>
<div class="two">
<div class="card scanner-box"><div class="card-head"><h3>Scanner Kamera</h3><span>HTTPS / localhost diperlukan</span></div><div style="padding:18px"><div id="reader" class="scanner"></div><div id="scanResult" class="scanner-result">Arahkan kamera ke QR absensi.</div></div></div>
<div class="card"><div class="card-head"><h3>QR Aktif</h3><span>{{ $tokens->count() }} sesi</span></div><div class="table-wrap"><table><thead><tr><th>Lokasi</th><th>Waktu</th><th>Aksi</th></tr></thead><tbody>@forelse($tokens as $token)<tr><td><strong>{{ $token->qrLocation->nama_lokasi ?? '-' }}</strong></td><td>{{ $token->waktu_mulai }}–{{ $token->waktu_berakhir }}</td><td><a class="mini" target="_blank" href="{{ route('qr.scan',$token->token) }}">Buka</a></td></tr>@empty<tr><td colspan="3"><div class="empty">Belum ada QR aktif.</div></td></tr>@endforelse</tbody></table></div></div>
</div>
@endsection
@section('scripts')
<script>
window.addEventListener('load',()=>{
 const result=document.getElementById('scanResult');
 if(!window.Html5Qrcode){result.textContent='Library scanner belum termuat. Pastikan internet aktif atau gunakan daftar QR aktif.';return;}
 const scanner=new Html5Qrcode('reader');
 const config={fps:10,qrbox:{width:250,height:250}};
 scanner.start({facingMode:'environment'},config,async text=>{
   scanner.pause(true); result.textContent='Token terbaca. Memeriksa ke server...';
   try{
     const res=await fetch('{{ url('/scan') }}/'+encodeURIComponent(text));
     const data=await res.text();
     const ok=res.ok;
     result.innerHTML=ok?'<span style="color:#8de0b8">✓ QR valid dan sesi masih aktif.</span>':'<span style="color:#e6a3af">✕ QR tidak valid / sudah kedaluwarsa.</span>';
   }catch(e){result.textContent='Gagal menghubungi server: '+e.message;}
   setTimeout(()=>scanner.resume(),1600);
 },()=>{}).catch(err=>{result.textContent='Kamera tidak dapat dibuka: '+err;});
});
</script>
@endsection
