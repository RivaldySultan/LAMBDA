<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LaporanController extends Controller
{
    /**
     * Tampilkan halaman portal pegawai dengan formulir input laporan harian dan riwayatnya.
     */
    public function portalPegawai()
    {
        $user = Auth::user();
        $riwayatLaporan = Laporan::where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Cek apakah hari ini sudah pernah kirim laporan
        $laporanHariIni = Laporan::where('user_id', $user->id)
            ->whereDate('tanggal', date('Y-m-d'))
            ->first();

        return view('pegawai.portal', compact('user', 'riwayatLaporan', 'laporanHariIni'));
    }

    /**
     * Simpan laporan harian pegawai lengkap dengan foto selfie & geotagging.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu_1' => 'required|string|max:50',
            'kegiatan_1' => 'required|string',
            'waktu_2' => 'nullable|string|max:50',
            'kegiatan_2' => 'nullable|string',
            'waktu_3' => 'nullable|string|max:50',
            'kegiatan_3' => 'nullable|string',
            'waktu_4' => 'nullable|string|max:50',
            'kegiatan_4' => 'nullable|string',
            'waktu_5' => 'nullable|string|max:50',
            'kegiatan_5' => 'nullable|string',
            'waktu_6' => 'nullable|string|max:50',
            'kegiatan_6' => 'nullable|string',
            'foto_bukti_1' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'keterangan_foto_1' => 'nullable|string|max:255',
            'foto_bukti_2' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'keterangan_foto_2' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'lokasi_keterangan' => 'nullable|string|max:255',
        ], [
            'tanggal.required' => 'Tanggal laporan wajib diisi.',
            'waktu_1.required' => 'Rentang waktu aktivitas pertama wajib diisi.',
            'kegiatan_1.required' => 'Uraian aktivitas pertama wajib diisi.',
            'foto_bukti_1.max' => 'Ukuran foto bukti 1 maksimal 5MB.',
            'foto_bukti_2.max' => 'Ukuran foto bukti 2 maksimal 5MB.',
        ]);

        $destinationPath = public_path('uploads/laporan');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $foto1 = null;
        if ($request->hasFile('foto_bukti_1')) {
            $file = $request->file('foto_bukti_1');
            $filename = 'selfie_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $foto1 = 'uploads/laporan/' . $filename;
        }

        $foto2 = null;
        if ($request->hasFile('foto_bukti_2')) {
            $file = $request->file('foto_bukti_2');
            $filename = 'kegiatan_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $foto2 = 'uploads/laporan/' . $filename;
        }

        Laporan::create([
            'user_id' => Auth::id(),
            'tanggal' => $validated['tanggal'],
            'waktu_1' => $validated['waktu_1'],
            'kegiatan_1' => $validated['kegiatan_1'],
            'waktu_2' => $validated['waktu_2'] ?? null,
            'kegiatan_2' => $validated['kegiatan_2'] ?? null,
            'waktu_3' => $validated['waktu_3'] ?? null,
            'kegiatan_3' => $validated['kegiatan_3'] ?? null,
            'waktu_4' => $validated['waktu_4'] ?? null,
            'kegiatan_4' => $validated['kegiatan_4'] ?? null,
            'waktu_5' => $validated['waktu_5'] ?? null,
            'kegiatan_5' => $validated['kegiatan_5'] ?? null,
            'waktu_6' => $validated['waktu_6'] ?? null,
            'kegiatan_6' => $validated['kegiatan_6'] ?? null,
            'foto_bukti_1' => $foto1,
            'keterangan_foto_1' => $validated['keterangan_foto_1'] ?? 'Foto selfie presensi / bukti perjalanan',
            'foto_bukti_2' => $foto2,
            'keterangan_foto_2' => $validated['keterangan_foto_2'] ?? 'Dokumentasi kegiatan lapangan',
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'lokasi_keterangan' => $validated['lokasi_keterangan'] ?? null,
            'status' => 'submitted',
        ]);

        return redirect()->route('pegawai.portal')->with('success', 'Laporan harian dan foto bukti berhasil dikirim.');
    }

    /**
     * Update profil dan tanda tangan digital mandiri oleh pegawai.
     */
    public function updateProfil(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'tanda_tangan' => 'nullable|file|mimes:png,jpg,jpeg,webp|max:2048',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Email ini sudah digunakan oleh akun lain.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
            'tanda_tangan.max' => 'Ukuran file tanda tangan maksimal 2MB.',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('tanda_tangan')) {
            $destPath = public_path('uploads/signatures');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }
            $file = $request->file('tanda_tangan');
            $filename = 'ttd_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destPath, $filename);
            $updateData['tanda_tangan'] = 'uploads/signatures/' . $filename;
        }

        $user->update($updateData);

        return back()->with('success', 'Profil dan tanda tangan digital Anda berhasil diperbarui.');
    }

    /**
     * Cetak mandiri Catatan Kinerja Harian (CKH) oleh pegawai.
     */
    public function cetakMandiri(Request $request)
    {
        $user = Auth::user();
        $bulan = $request->query('bulan', date('Y-m'));
        $sertakanFoto = $request->has('sertakan_foto') ? $request->boolean('sertakan_foto') : true;

        $laporans = Laporan::where('user_id', $user->id)
            ->where('tanggal', 'like', "{$bulan}%")
            ->orderBy('tanggal', 'asc')
            ->get();

        // Pejabat Penilai / Kepala BPS
        $pejabatList = User::where('jabatan', 'Kepala Kantor')
            ->orWhere('jabatan', 'Kepala Sub Bagian Umum')
            ->get();

        if ($pejabatList->isEmpty()) {
            $pejabatList = User::where('role', 'admin')->get();
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

        return view('pegawai.cetak', compact(
            'user',
            'laporans',
            'bulan',
            'sertakanFoto',
            'pejabatList',
            'selectedPejabat',
            'periodeFormat'
        ));
    }

    /**
     * Verifikasi laporan oleh Administrator.
     */
    public function verifikasi(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $status = $request->input('status', 'approved');

        $laporan->update([
            'status' => in_array($status, ['approved', 'rejected']) ? $status : 'approved',
            'catatan_verifikasi' => $request->input('catatan_verifikasi'),
            'diverifikasi_pada' => now(),
        ]);

        return back()->with('success', 'Status laporan ' . $laporan->user->name . ' berhasil diperbarui.');
    }
}
