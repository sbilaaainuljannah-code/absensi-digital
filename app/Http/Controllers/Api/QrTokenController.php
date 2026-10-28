<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QrLocation;
use App\Models\QrToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QrTokenController extends Controller
{
    public function index()
    {
        $tokens = QrToken::with('qrLocation')
            ->orderByDesc('tanggal')
            ->orderByDesc('waktu_mulai')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data QR Token berhasil diambil.',
            'data' => $tokens,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'qr_location_id' => 'required|exists:qr_locations,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_berakhir' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        $location = QrLocation::find($request->qr_location_id);

        if (!$location->status) {
            return response()->json([
                'success' => false,
                'message' => 'Lokasi QR sedang tidak aktif.',
            ], 422);
        }

        $token = QrToken::create([
            'qr_location_id' => $request->qr_location_id,
            'token' => Str::random(40),
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_berakhir' => $request->waktu_berakhir,
            'status' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'QR Token berhasil dibuat.',
            'data' => $token->load('qrLocation'),
        ], 201);
    }

    public function show($id)
    {
        $token = QrToken::with('qrLocation')->find($id);

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'QR Token tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data QR Token berhasil diambil.',
            'data' => $token,
        ]);
    }

    public function destroy($id)
    {
        $token = QrToken::find($id);

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'QR Token tidak ditemukan.',
            ], 404);
        }

        $token->delete();

        return response()->json([
            'success' => true,
            'message' => 'QR Token berhasil dihapus.',
        ]);
    }
}