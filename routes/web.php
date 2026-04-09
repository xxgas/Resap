<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

/*
|--------------------------------------------------------------------------
| SISWA (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Siswa
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard-siswa');

    // Form Pengajuan
    Route::get('/siswa/buat', [SiswaController::class, 'createPengaduan'])->name('pengaduan.buat');

    // Simpan Pengajuan
    Route::post('/pengaduan/simpan', [SiswaController::class, 'storePengaduan'])->name('pengaduan.store');

    // Detail Pengaduan Siswa
    Route::get('/pengaduan/detail/{id}', [SiswaController::class, 'showPengaduan'])->name('pengaduan.detail');
});

/*
|--------------------------------------------------------------------------
| ADMIN (Harus Login + Role Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Detail & Feedback Aspirasi
    Route::get('/aspirasi/{id}', [AdminController::class, 'show'])->name('aspirasi.show');
    Route::post('/aspirasi/{id}/update', [AdminController::class, 'update'])->name('aspirasi.update');

    // Manajemen Akun Siswa
    Route::get('/tambah-siswa', [AuthController::class, 'createSiswa'])->name('tambah-siswa');
    Route::post('/tambah-siswa', [AuthController::class, 'storeSiswa'])->name('tambah-siswa.store');
});
