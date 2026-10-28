<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['student.classRoom', 'qrLocation'])
            ->orderByDesc('tanggal')->orderByDesc('waktu');

        if ($request->filled('tanggal')) $query->whereDate('tanggal', $request->tanggal);
        if ($request->filled('status')) $query->where('status', $request->status);

        $attendances = $query->get();
        if ($request->routeIs('admin.reports.index')) {
            return view('admin.reports.index', compact('attendances'));
        }

        return view('admin.attendances.index', compact('attendances'));
    }

    public function exportCsv(Request $request)
    {
        $query = Attendance::with(['student.classRoom', 'qrLocation'])->orderByDesc('tanggal')->orderByDesc('waktu');
        if ($request->filled('tanggal')) $query->whereDate('tanggal', $request->tanggal);
        if ($request->filled('status')) $query->where('status', $request->status);
        $rows = $query->get();

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Tanggal', 'Waktu', 'NIS', 'Nama Siswa', 'Kelas', 'Status', 'Lokasi QR', 'Latitude', 'Longitude']);
            foreach ($rows as $row) {
                fputcsv($out, [
                    optional($row->tanggal)->format('Y-m-d'), $row->waktu,
                    $row->student->nis ?? '-', $row->student->nama ?? '-',
                    $row->student->classRoom->nama_kelas ?? '-', $row->status,
                    $row->qrLocation->nama_lokasi ?? '-', $row->latitude, $row->longitude,
                ]);
            }
            fclose($out);
        }, 'rekap-absensi-' . now()->format('Ymd-His') . '.csv');
    }
}
