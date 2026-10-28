<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\QrLocation;
use App\Models\QrToken;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $kelasRpl1 = ClassRoom::create(['nama_kelas' => 'XII RPL 1']);
        $kelasRpl2 = ClassRoom::create(['nama_kelas' => 'XII RPL 2']);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@absensi.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        foreach ([
            ['Budi Santoso','budi@absensi.test','12345001',$kelasRpl1->id],
            ['Andi Pratama','andi@absensi.test','12345002',$kelasRpl1->id],
            ['Siti Aisyah','siti@absensi.test','12345003',$kelasRpl2->id],
        ] as [$nama,$email,$nis,$classId]) {
            $user = User::create(['name'=>$nama,'email'=>$email,'password'=>Hash::make('password'),'role'=>'student']);
            Student::create(['user_id'=>$user->id,'nis'=>$nis,'nama'=>$nama,'class_id'=>$classId]);
        }

        $gerbang = QrLocation::create([
            'nama_lokasi' => 'Gerbang Sekolah', 'kode_lokasi' => 'GERBANG',
            'latitude' => -6.9000000, 'longitude' => 107.6000000, 'radius' => 80, 'status' => true,
        ]);
        $lab = QrLocation::create([
            'nama_lokasi' => 'Lab RPL', 'kode_lokasi' => 'LAB-RPL',
            'latitude' => -6.9001000, 'longitude' => 107.6001000, 'radius' => 50, 'status' => true,
        ]);
        QrLocation::create([
            'nama_lokasi' => 'Gedung A', 'kode_lokasi' => 'GEDUNG-A',
            'latitude' => -6.9003000, 'longitude' => 107.6003000, 'radius' => 70, 'status' => true,
        ]);

        $guru1 = Teacher::create(['nama'=>'Rina Kartika, S.Kom','nip'=>'19870001','email'=>'rina@sekolah.test']);
        $guru2 = Teacher::create(['nama'=>'Dedi Firmansyah, S.Kom','nip'=>'19870002','email'=>'dedi@sekolah.test']);
        Schedule::create(['class_id'=>$kelasRpl1->id,'teacher_id'=>$guru1->id,'mata_pelajaran'=>'Pemrograman Web','hari'=>'Senin','jam_mulai'=>'07:00','jam_selesai'=>'09:30']);
        Schedule::create(['class_id'=>$kelasRpl1->id,'teacher_id'=>$guru2->id,'mata_pelajaran'=>'Basis Data','hari'=>'Selasa','jam_mulai'=>'08:00','jam_selesai'=>'10:00']);
        Schedule::create(['class_id'=>$kelasRpl2->id,'teacher_id'=>$guru1->id,'mata_pelajaran'=>'Pemrograman Mobile','hari'=>'Rabu','jam_mulai'=>'07:00','jam_selesai'=>'09:30']);

        // Token demo berlaku sepanjang hari agar alur QR + GPS dapat langsung diuji.
        QrToken::create([
            'qr_location_id' => $gerbang->id,
            'token' => Str::random(48),
            'tanggal' => today(),
            'waktu_mulai' => '00:00:00',
            'waktu_berakhir' => '23:59:59',
            'status' => true,
        ]);
        QrToken::create([
            'qr_location_id' => $lab->id,
            'token' => Str::random(48),
            'tanggal' => today(),
            'waktu_mulai' => '00:00:00',
            'waktu_berakhir' => '23:59:59',
            'status' => true,
        ]);
    }
}
