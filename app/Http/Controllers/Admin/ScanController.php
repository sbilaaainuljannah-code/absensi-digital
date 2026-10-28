<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QrToken;

class ScanController extends Controller
{
    public function index()
    {
        $tokens = QrToken::with('qrLocation')
            ->where('status', true)
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        return view('admin.scan.index', compact('tokens'));
    }
}
