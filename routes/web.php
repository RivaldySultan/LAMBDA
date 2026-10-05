<?php

use Illuminate\Support\Facades\Route;

// Tampilkan halaman login saat akses localhost:8000/
Route::get('/', function () {
    return view('auth.login');
});

// Tampilkan halaman dashboard setelah berhasil masuk
Route::get('/dashboard', function () {
    return view('dashboard');
});