<?php

namespace App\Http\Controllers\Api;

use App\Helpers\GeoHelper;
use App\Http\Controllers\Controller;
use App\Models\QrToken;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function today(Request $request)
    {
        $student = $request->user()->student;
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Data siswa tidak ditemukan.'], 404);
        }

        $attendance = $student->attendances()->whereDate('tanggal', today())->with('qrLocation')->first();
        return response()->json(['success' => true, 'message' => 'Data absensi hari ini.', 'data' => $attendance]);
    }

    public function history(Request $request)
    {
        $student = $request->user()->student;
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Data siswa tidak ditemukan.'], 404);
        }

        $attendance = $student->attendances()->with('qrLocation')->orderByDesc('tanggal')->orderByDesc('waktu')->get();
        return response()->json(['success' => true, 'message' => 'Riwayat absensi berhasil diambil.', 'data' => $attendance]);
    }

    public function scan(Request $request)
    {
        $request->validate([
            'qr_token' => 'required_without:token|string',
            'token' => 'required_without:qr_token|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $student = $request->user()->student;
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Data siswa tidak ditemukan.'], 404);
        }

        $tokenValue = $request->input('qr_token', $request->input('token'));
        $qrToken = QrToken::with('qrLocation')->where('token', $tokenValue)->where('status', true)->first();

        if (!$qrToken) {
            return response()->json(['success' => false, 'message' => 'QR Code tidak valid atau tidak ditemukan.'], 422);
        }

        if (!$qrToken->tanggal || !$qrToken->tanggal->isToday()) {
            return response()->json(['success' => false, 'message' => 'QR Code sudah tidak berlaku untuk hari ini.'], 422);
        }

        $now = now()->format('H:i:s');
        if ($now < $qrToken->waktu_mulai || $now > $qrToken->waktu_berakhir) {
            return response()->json(['success' => false, 'message' => 'QR Code belum aktif atau sudah kedaluwarsa.'], 422);
        }

        $location = $qrToken->qrLocation;
        if (!$location || !$location->status) {
            return response()->json(['success' => false, 'message' => 'Lokasi QR sedang tidak aktif.'], 422);
        }

        if ($location->latitude === null || $location->longitude === null) {
            return response()->json(['success' => false, 'message' => 'Koordinat lokasi QR belum diatur oleh admin.'], 422);
        }

        $distance = GeoHelper::distance(
            (float) $request->latitude,
            (float) $request->longitude,
            (float) $location->latitude,
            (float) $location->longitude
        );

        if ($distance > (float) $location->radius) {
            return response()->json([
                'success' => false,
                'message' => 'Absensi ditolak karena kamu berada di luar radius lokasi QR.',
                'data' => [
                    'distance_meter' => round($distance, 2),
                    'allowed_radius_meter' => (int) $location->radius,
                ],
            ], 422);
        }

        $sudahAbsen = $student->attendances()->whereDate('tanggal', today())->exists();
        if ($sudahAbsen) {
            return response()->json(['success' => false, 'message' => 'Kamu sudah melakukan absensi hari ini.'], 422);
        }

        $attendance = $student->attendances()->create([
            'tanggal' => today()->toDateString(),
            'waktu' => now()->format('H:i:s'),
            'status' => 'hadir',
            'qr_location_id' => $location->id,
            'token' => $qrToken->token,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil. Lokasi kamu valid.',
            'data' => [
                'attendance' => $attendance,
                'distance_meter' => round($distance, 2),
                'allowed_radius_meter' => (int) $location->radius,
                'student' => ['id' => $student->id, 'nis' => $student->nis, 'name' => $student->nama],
                'qr' => ['token_id' => $qrToken->id, 'location' => $location->nama_lokasi, 'location_code' => $location->kode_lokasi, 'tanggal' => $qrToken->tanggal->toDateString()],
            ],
        ], 201);
    }
}
