<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QrToken;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show($id)
    {
        $qrToken = QrToken::with('qrLocation')->find($id);

        if (!$qrToken) {
            return response()->json([
                'success' => false,
                'message' => 'QR Token tidak ditemukan.',
            ], 404);
        }

        if (!$qrToken->status) {
            return response()->json([
                'success' => false,
                'message' => 'QR Token sudah tidak aktif.',
            ], 422);
        }

        $qr = QrCode::format('svg')
            ->size(400)
            ->margin(2)
            ->generate($qrToken->token);

        return response($qr)
            ->header('Content-Type', 'image/svg+xml');
    }
}