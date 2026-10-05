<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\LaporanController;

// Autentikasi Publik
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Pegawai (Portal Laporan, Upload Bukti, Profil, Cetak Mandiri)
Route::middleware('auth')->group(function () {
    Route::get('/portal-pegawai', [LaporanController::class, 'portalPegawai'])->name('pegawai.portal');
    Route::post('/portal-pegawai/laporan', [LaporanController::class, 'store'])->name('pegawai.laporan.store');
    Route::post('/portal-pegawai/profil', [LaporanController::class, 'updateProfil'])->name('pegawai.profil.update');
    Route::get('/portal-pegawai/cetak', [LaporanController::class, 'cetakMandiri'])->name('pegawai.cetak');
});

// Rute Admin & Modul Sistem
Route::middleware('auth')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Modul Kelola Pengguna (CRUD)
    Route::get('/kelola-pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::post('/kelola-pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::put('/kelola-pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/kelola-pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');

    // Modul Teknis, Survei, Laporan, Cetak, dan Info BPS
    Route::get('/kelola-teknis', [ModulController::class, 'teknis'])->name('teknis.index');
    Route::get('/kelola-survei', [ModulController::class, 'survei'])->name('survei.index');
    Route::get('/laporan', [ModulController::class, 'laporan'])->name('laporan.index');
    Route::post('/laporan/{id}/verifikasi', [LaporanController::class, 'verifikasi'])->name('laporan.verifikasi');
    Route::get('/cetak', [ModulController::class, 'cetak'])->name('cetak.index');
    Route::get('/info-bps', [ModulController::class, 'info'])->name('info.index');
});