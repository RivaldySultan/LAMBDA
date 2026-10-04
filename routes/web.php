use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\InfoBpsController;

// Route Bersama
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/info-bps', [InfoBpsController::class, 'index'])->name('info-bps.index');
    Route::get('/cetak', [CetakController::class, 'index'])->name('cetak.index');
});

// Route Khusus Admin (menggunakan middleware admin[cite: 1])
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/kelola-pengguna', [AdminController::class, 'pengguna'])->name('pengguna.index');
    Route::get('/kelola-teknis', [AdminController::class, 'teknis'])->name('teknis.index');
    Route::get('/kelola-survei', [AdminController::class, 'survei'])->name('survei.index');
});

// Route Khusus User
Route::middleware(['auth'])->group(function () {
    Route::resource('laporan', LaporanController::class);
});