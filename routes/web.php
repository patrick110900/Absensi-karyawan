<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {

    // Dashboard — accessible by all authenticated users
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // ── Admin only ──────────────────────────────────────────────────
    Route::middleware('role:admin')->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::get('/absensi', [AttendanceController::class, 'adminIndex'])->name('attendance.admin');
        Route::delete('/absensi/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
        Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
    });

    // ── Karyawan only ───────────────────────────────────────────────
    Route::middleware('role:karyawan')->group(function () {
        Route::get('/absensi/check', [AttendanceController::class, 'checkInForm'])->name('attendance.checkin');
        Route::post('/absensi/checkin', [AttendanceController::class, 'checkIn'])->name('attendance.do-checkin');
        Route::post('/absensi/checkout', [AttendanceController::class, 'checkOut'])->name('attendance.do-checkout');
        Route::get('/absensi/riwayat', [AttendanceController::class, 'history'])->name('attendance.history');
    });
});
