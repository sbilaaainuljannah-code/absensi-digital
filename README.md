# ABSENSI DIGITAL — Laravel 10 + REST API + GPS/Haversine + Flutter

Project siap pakai untuk materi sampai **Pertemuan 9**.

## Isi project

### Web Admin
- Login admin
- Dashboard dark navy / aesthetic
- CRUD Data Siswa
- CRUD Data Kelas
- CRUD Data Guru
- CRUD Jadwal
- Data Absensi + filter
- Rekap Absensi + Export CSV
- CRUD Lokasi QR + latitude/longitude/radius
- Generate QR Token berdasarkan tanggal + waktu + lokasi
- Menampilkan gambar QR
- Scan QR kamera untuk pengecekan token
- Pengaturan
- Logout

### REST API
- `POST /api/login`
- `GET /api/me`
- `POST /api/logout`
- `GET /api/profile`
- `GET /api/attendance/today`
- `GET /api/attendance/history`
- `POST /api/attendance/scan`
- QR token endpoints
- QR image endpoint
- Laravel Sanctum Bearer Token
- Validasi QR + tanggal + jam + lokasi
- GPS latitude/longitude
- Haversine distance dalam meter
- Validasi radius server-side
- Cegah absensi dua kali pada hari yang sama

### Mobile Flutter
Folder: `mobile/absensi_mobile`
- Splash
- Login
- Simpan Sanctum token
- Dashboard
- Profil siswa
- Status absensi hari ini
- Scan QR
- Ambil GPS
- Kirim QR + GPS ke Laravel
- Riwayat absensi
- Logout

## Instalasi Laravel

1. Extract ZIP.
2. Buka CMD di folder Laravel ini.
3. Pastikan XAMPP/MySQL aktif.
4. Buat database MySQL bernama `absensi_digital`.
5. Cek `.env`:

```env
DB_DATABASE=absensi_digital
DB_USERNAME=root
DB_PASSWORD=
```

6. Jika vendor tidak tersedia, jalankan:

```bat
composer install
```

7. Jika `.env` baru dibuat, jalankan:

```bat
php artisan key:generate
```

8. Buat tabel + data demo:

```bat
php artisan migrate:fresh --seed
```

9. Jalankan:

```bat
php artisan serve --host=0.0.0.0
```

Buka `http://127.0.0.1:8000/admin/login`.

## Akun demo

Admin:
- Email: `admin@absensi.test`
- Password: `password`

Siswa API/mobile:
- `budi@absensi.test` / `password`
- `andi@absensi.test` / `password`
- `siti@absensi.test` / `password`

## Uji QR + GPS

1. Login admin.
2. Buka **Lokasi QR** dan pastikan latitude, longitude, radius sesuai lokasi sekolah sebenarnya.
3. Buka **QR Code** dan buat sesi QR.
4. QR demo hasil seeder berlaku hari ini sepanjang hari.
5. Di aplikasi Flutter, login sebagai siswa.
6. Buka **Scan QR**.
7. Izinkan kamera + lokasi.
8. Scan QR.
9. Server mengecek token, tanggal, waktu, lokasi, Haversine, radius, dan duplikasi absensi.
10. Jika valid, data masuk ke **Data Absensi** dan **Dashboard**.

> Koordinat pada seeder adalah koordinat contoh pembelajaran. Untuk penggunaan nyata, ganti dengan koordinat sekolah pada menu **Lokasi QR**.

## Catatan Flutter

Flutter SDK tidak disertakan karena biasanya dibuat oleh `flutter create` sesuai versi Android SDK komputer. Masuk ke:

`mobile/absensi_mobile`

lalu:

```bat
flutter create .
flutter pub get
flutter run
```

Untuk Android Emulator, `baseUrl` sudah diarahkan ke `http://10.0.2.2:8000/api`.
Untuk HP fisik, ganti `baseUrl` di `lib/services/api_service.dart` menjadi IP komputer, misalnya `http://192.168.1.10:8000/api`.

Tambahkan izin kamera dan lokasi pada Android setelah `flutter create .`:

- `android.permission.CAMERA`
- `android.permission.ACCESS_FINE_LOCATION`
- `android.permission.ACCESS_COARSE_LOCATION`
- `android.permission.INTERNET`

## Urutan pembelajaran

- Pertemuan 7 → API Scan QR + Sanctum + validasi token
- Pertemuan 8 → GPS + Radius + Haversine
- Pertemuan 9 → Mobile App Siswa + Integrasi API

Project ini menggabungkan ketiganya supaya alur akhir bisa diuji dari login siswa → scan QR → GPS → validasi server → absensi tersimpan.
