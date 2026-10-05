<?php

use Illuminate\Support\Facades\Route;

// Karena login.blade.php ada di luar, kita panggil 'login' saja
Route::get('/', function () {
    return view('login'); 
});

// Route menuju dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Halaman Kelola Pengguna
Route::get('/kelola-pengguna', function () {
    return view('pengguna.index');
})->name('pengguna.index');