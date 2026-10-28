# Absensi Mobile — Pertemuan 9

Flutter client untuk Laravel Absensi Digital.

## Struktur
- `lib/main.dart` — splash dan routing awal
- `lib/services/api_service.dart` — komunikasi REST API + Bearer Token
- `lib/services/storage_service.dart` — penyimpanan Sanctum token
- `lib/models/user_model.dart` — model user/siswa
- `lib/screens/login_screen.dart` — login siswa
- `lib/screens/dashboard_screen.dart` — dashboard + profil + status hari ini
- `lib/screens/scan_screen.dart` — scan QR + GPS + kirim ke `/api/attendance/scan`
- `lib/screens/history_screen.dart` — riwayat absensi

## Jalankan
1. Pastikan backend Laravel berjalan: `php artisan serve --host=0.0.0.0`
2. Jalankan `flutter create .` di folder `mobile/absensi_mobile` jika folder Android/iOS belum dibuat.
3. Jalankan `flutter pub get`.
4. Android emulator memakai `http://10.0.2.2:8000/api` (sudah diset di `api_service.dart`).
5. HP fisik harus satu jaringan dengan PC. Ganti `baseUrl` menjadi `http://IP-PC:8000/api`.
6. Untuk Android, pastikan izin internet dan lokasi aktif. `mobile_scanner` juga membutuhkan izin kamera.

## Akun demo
- `budi@absensi.test` / `password`
- `andi@absensi.test` / `password`
- `siti@absensi.test` / `password`
