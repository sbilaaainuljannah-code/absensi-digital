<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Attendance;
use App\Models\QrLocation;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Student::count();

        $jumlahKelas = ClassRoom::count();

        $jumlahAbsensiHariIni = Attendance::whereDate(
            'tanggal',
            now()->toDateString()
        )->count();

        $jumlahLokasiQr = QrLocation::where('status', true)->count();

        $absensiHariIni = Attendance::with([
            'student.classRoom',
            'qrLocation'
        ])
        ->whereDate('tanggal', now()->toDateString())
        ->orderByDesc('waktu')
        ->get();

        return view('admin.dashboard', compact(
            'jumlahSiswa',
            'jumlahKelas',
            'jumlahAbsensiHariIni',
            'jumlahLokasiQr',
            'absensiHariIni'
        ));
    }
}