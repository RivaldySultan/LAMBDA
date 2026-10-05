<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function teknis()
    {
        return view('modules.teknis');
    }

    public function survei()
    {
        return view('modules.survei');
    }

    public function laporan(Request $request)
    {
        $pegawai = User::where('role', 'pegawai')->get();
        $userId = $request->query('user_id');
        $tanggal = $request->query('tanggal');

        $laporans = Laporan::with('user')
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when($tanggal, fn($q) => $q->whereDate('tanggal', $tanggal))
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('modules.laporan', compact('pegawai', 'laporans', 'userId', 'tanggal'));
    }

    public function cetak(Request $request)
    {
        $pegawai = User::where('role', 'pegawai')->get();
        $userId = $request->query('user_id', $pegawai->first()?->id);
        $bulan = $request->query('bulan', date('Y-m'));
        $sertakanFoto = $request->has('sertakan_foto') ? $request->boolean('sertakan_foto') : true;

        $selectedUser = User::find($userId) ?? $pegawai->first();
        
        $laporans = Laporan::where('user_id', $selectedUser?->id)
            ->where('tanggal', 'like', "{$bulan}%")
            ->orderBy('tanggal', 'asc')
            ->get();

        // Pejabat Penilai / Kepala BPS
        $pejabatList = User::where('jabatan', 'Kepala Kantor')
            ->orWhere('jabatan', 'Kepala Sub Bagian Umum')
            ->get();
        
        if ($pejabatList->isEmpty()) {
            $pejabatList = User::all();
        }

        $pejabatId = $request->query('pejabat_id', $pejabatList->first()?->id);
        $selectedPejabat = User::find($pejabatId) ?? $pejabatList->first();

        // Nama Bulan Bahasa Indonesia
        $bulanAngka = (int) substr($bulan, 5, 2);
        $tahun = substr($bulan, 0, 4);
        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $periodeFormat = ($namaBulan[$bulanAngka] ?? 'Bulan') . ' ' . $tahun;

        return view('modules.cetak', compact(
            'pegawai',
            'selectedUser',
            'laporans',
            'userId',
            'bulan',
            'sertakanFoto',
            'pejabatList',
            'selectedPejabat',
            'periodeFormat'
        ));
    }

    public function info()
    {
        return view('modules.info');
    }
}
