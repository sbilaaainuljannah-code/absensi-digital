<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Menampilkan profile siswa.
     */
    public function profile(Request $request)
    {
        $user = $request->user()->load('student.classRoom');

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil diambil.',
            'data' => $user,
        ]);
    }
}