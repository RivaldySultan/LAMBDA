<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama dashboard admin dengan data riil dari database.
     */
    public function index()
    {
        $totalPegawai = User::where('role', 'pegawai')->count();
        $totalPengguna = User::count();
        $pegawaiAktif = User::where('role', 'pegawai')->where('is_active', true)->count();

        // Data laporan hari ini
        $laporansHariIni = Laporan::with('user')
            ->whereDate('tanggal', date('Y-m-d'))
            ->get();

        $jumlahLaporanHariIni = $laporansHariIni->count();
        $pegawaiBelumMelapor = max(0, $totalPegawai - $jumlahLaporanHariIni);

        return view('dashboard', compact(
            'totalPegawai',
            'totalPengguna',
            'pegawaiAktif',
            'laporansHariIni',
            'jumlahLaporanHariIni',
            'pegawaiBelumMelapor'
        ));
    }
}
