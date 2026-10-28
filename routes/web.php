<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ClassRoomController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\QrController;
use App\Http\Controllers\Admin\QrLocationController;
use App\Http\Controllers\Admin\ScanController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ScheduleController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\QrToken;

/* LOGIN ADMIN */
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/* PUBLIC QR SCAN / DISPLAY TARGET */
Route::get('/scan/{token}', function (string $token) {
    $qrToken = QrToken::with('qrLocation')->where('token', $token)->first();

    if (!$qrToken || !$qrToken->status) {
        return response()->view('scan.result', ['valid' => false, 'message' => 'QR Code tidak valid atau tidak ditemukan.'], 422);
    }

    $today = now()->toDateString();
    $time = now()->format('H:i:s');
    $valid = $qrToken->tanggal?->toDateString() === $today
        && $time >= $qrToken->waktu_mulai
        && $time <= $qrToken->waktu_berakhir
        && $qrToken->qrLocation
        && $qrToken->qrLocation->status;

    return response()->view('scan.result', [
        'valid' => $valid,
        'qrToken' => $qrToken,
        'message' => $valid ? 'QR Code valid. Silakan lanjutkan proses absensi melalui aplikasi siswa.' : 'QR Code belum aktif atau sudah kedaluwarsa.',
    ], $valid ? 200 : 422);
})->name('qr.scan');

/* HALAMAN ADMIN */
Route::middleware('auth')->group(function () {

    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    /* DATA SISWA */
    Route::get('/admin/students', [StudentController::class, 'index'])->name('admin.students.index');
    Route::get('/admin/students/create', [StudentController::class, 'create'])->name('admin.students.create');
    Route::post('/admin/students', [StudentController::class, 'store'])->name('admin.students.store');
    Route::get('/admin/students/{id}/edit', [StudentController::class, 'edit'])->name('admin.students.edit');
    Route::put('/admin/students/{id}', [StudentController::class, 'update'])->name('admin.students.update');
    Route::delete('/admin/students/{id}', [StudentController::class, 'destroy'])->name('admin.students.destroy');

    /* DATA KELAS */
    Route::get('/admin/classes', [ClassRoomController::class, 'index'])->name('admin.classes.index');
    Route::get('/admin/classes/create', [ClassRoomController::class, 'create'])->name('admin.classes.create');
    Route::post('/admin/classes', [ClassRoomController::class, 'store'])->name('admin.classes.store');
    Route::get('/admin/classes/{id}/edit', [ClassRoomController::class, 'edit'])->name('admin.classes.edit');
    Route::put('/admin/classes/{id}', [ClassRoomController::class, 'update'])->name('admin.classes.update');
    Route::delete('/admin/classes/{id}', [ClassRoomController::class, 'destroy'])->name('admin.classes.destroy');

    /* ABSENSI */
    Route::get('/admin/attendances', [AttendanceController::class, 'index'])->name('admin.attendances.index');
    Route::get('/admin/reports', [AttendanceController::class, 'index'])->name('admin.reports.index');

    /* QR CODE */
    Route::get('/admin/qr', [QrController::class, 'index'])->name('admin.qr.index');
    Route::post('/admin/qr', [QrController::class, 'store'])->name('admin.qr.store');
    Route::delete('/admin/qr/{id}', [QrController::class, 'destroy'])->name('admin.qr.destroy');

    /* LOKASI QR */
    Route::get('/admin/locations', [QrLocationController::class, 'index'])->name('admin.locations.index');
    Route::get('/admin/locations/create', [QrLocationController::class, 'create'])->name('admin.locations.create');
    Route::post('/admin/locations', [QrLocationController::class, 'store'])->name('admin.locations.store');
    Route::get('/admin/locations/{id}/edit', [QrLocationController::class, 'edit'])->name('admin.locations.edit');
    Route::put('/admin/locations/{id}', [QrLocationController::class, 'update'])->name('admin.locations.update');
    Route::delete('/admin/locations/{id}', [QrLocationController::class, 'destroy'])->name('admin.locations.destroy');

    /* SCAN QR - HALAMAN ADMIN */
    Route::get('/admin/scan', [ScanController::class, 'index'])->name('admin.scan.index');

    /* GURU */
    Route::get('/admin/teachers', [TeacherController::class, 'index'])->name('admin.teachers.index');
    Route::get('/admin/teachers/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
    Route::post('/admin/teachers', [TeacherController::class, 'store'])->name('admin.teachers.store');
    Route::get('/admin/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
    Route::put('/admin/teachers/{id}', [TeacherController::class, 'update'])->name('admin.teachers.update');
    Route::delete('/admin/teachers/{id}', [TeacherController::class, 'destroy'])->name('admin.teachers.destroy');

    /* JADWAL */
    Route::get('/admin/schedules', [ScheduleController::class, 'index'])->name('admin.schedules.index');
    Route::get('/admin/schedules/create', [ScheduleController::class, 'create'])->name('admin.schedules.create');
    Route::post('/admin/schedules', [ScheduleController::class, 'store'])->name('admin.schedules.store');
    Route::get('/admin/schedules/{id}/edit', [ScheduleController::class, 'edit'])->name('admin.schedules.edit');
    Route::put('/admin/schedules/{id}', [ScheduleController::class, 'update'])->name('admin.schedules.update');
    Route::delete('/admin/schedules/{id}', [ScheduleController::class, 'destroy'])->name('admin.schedules.destroy');

    /* QR IMAGE */
    Route::get('/admin/qr/{id}/image', function ($id) {
        $qrToken = \App\Models\QrToken::findOrFail($id);
        return response(QrCode::format('svg')->size(480)->margin(2)->generate($qrToken->token))
            ->header('Content-Type', 'image/svg+xml');
    })->name('admin.qr.image');

    /* EXPORT REKAP */
    Route::get('/admin/reports/export', [AttendanceController::class, 'exportCsv'])->name('admin.reports.export');

    /* PENGATURAN */
    Route::get('/admin/settings', fn () => view('admin.settings.index'))->name('admin.settings.index');
});
