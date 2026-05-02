<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BkDashboardController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\GuruLaporanController;
use App\Http\Controllers\KepalaSekolahDashboardController;
use App\Http\Controllers\PeriodeEvaluasiController;
use App\Http\Controllers\SiswaDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard.redirect')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->middleware('throttle:login')->name('login.store');
});

Route::get('/admin/login', [AuthController::class, 'createAdmin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'storeAdmin'])->middleware('throttle:login')->name('admin.login.store');

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'redirect'])->name('dashboard.redirect');
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->as('siswa.')->group(function (): void {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/evaluasi/{guru}/create', [EvaluasiController::class, 'create'])->name('evaluasi.create');
    Route::post('/evaluasi/{guru}', [EvaluasiController::class, 'store'])->name('evaluasi.store');
});

Route::middleware(['auth', 'role:guru_bk'])->prefix('bk')->as('bk.')->group(function (): void {
    Route::get('/dashboard', [BkDashboardController::class, 'index'])->name('dashboard');
    Route::get('/evaluasi/{evaluasi}', [BkDashboardController::class, 'show'])->name('evaluasi.show');
    Route::post('/evaluasi/{evaluasi}/verifikasi', [BkDashboardController::class, 'verify'])->name('evaluasi.verify');
    Route::post('/evaluasi/{evaluasi}/tolak', [BkDashboardController::class, 'reject'])->name('evaluasi.reject');
});

Route::middleware(['auth', 'role:kepala_sekolah'])->prefix('kepala-sekolah')->as('kepala-sekolah.')->group(function (): void {
    Route::get('/dashboard', [KepalaSekolahDashboardController::class, 'index'])->name('dashboard');
    Route::get('/guru/{guru}/laporan', [GuruLaporanController::class, 'show'])->name('guru.laporan');
    Route::get('/guru/{guru}/laporan/pdf', [GuruLaporanController::class, 'pdf'])->name('guru.laporan.pdf');

    Route::get('/periode', [PeriodeEvaluasiController::class, 'index'])->name('periode.index');
    Route::get('/periode/create', [PeriodeEvaluasiController::class, 'create'])->name('periode.create');
    Route::post('/periode', [PeriodeEvaluasiController::class, 'store'])->name('periode.store');
    Route::post('/periode/{periode}/aktifkan', [PeriodeEvaluasiController::class, 'activate'])->name('periode.activate');
    Route::post('/periode/{periode}/selesaikan', [PeriodeEvaluasiController::class, 'complete'])->name('periode.complete');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function (): void {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/siswa', [AdminDashboardController::class, 'storeSiswa'])->name('siswa.store');
    Route::post('/guru', [AdminDashboardController::class, 'storeGuru'])->name('guru.store');
});
