<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QrLocation;
use App\Models\QrToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QrController extends Controller
{
    public function index()
    {
        $tokens = QrToken::with('qrLocation')->orderByDesc('tanggal')->orderByDesc('id')->get();
        $locations = QrLocation::where('status', true)->orderBy('nama_lokasi')->get();
        return view('admin.qr.index', compact('tokens', 'locations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'qr_location_id' => 'required|exists:qr_locations,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_berakhir' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        $location = QrLocation::findOrFail($data['qr_location_id']);
        if (!$location->status) {
            return back()->withErrors(['qr_location_id' => 'Lokasi QR sedang nonaktif.'])->withInput();
        }

        $data['token'] = Str::random(48);
        $data['status'] = true;
        QrToken::create($data);

        return redirect()->route('admin.qr.index')->with('success', 'QR Code berhasil dibuat.');
    }

    public function destroy($id)
    {
        QrToken::findOrFail($id)->delete();
        return back()->with('success', 'QR Code berhasil dihapus.');
    }
}
