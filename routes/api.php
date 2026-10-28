<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\QrTokenController;
use App\Http\Controllers\Api\QrCodeController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/profile', [ProfileController::class, 'profile']);

    Route::get('/attendance/today', [AttendanceController::class, 'today']);
    Route::get('/attendance/history', [AttendanceController::class, 'history']);
    Route::post('/attendance/scan', [AttendanceController::class, 'scan']);

    Route::get('/qr-tokens', [QrTokenController::class, 'index']);
    Route::post('/qr-tokens', [QrTokenController::class, 'store']);
    Route::get('/qr-tokens/{id}', [QrTokenController::class, 'show']);
    Route::delete('/qr-tokens/{id}', [QrTokenController::class, 'destroy']);

    Route::get('/qr-code/{id}', [QrCodeController::class, 'show']);
});
