<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Laporan::truncate();

        $wishnu = User::where('username', 'wishnu')->first();
        $taufik = User::where('username', 'taufik')->first();
        $anita = User::where('username', 'anita')->first();
        $dani = User::where('username', 'dani')->first();

        if ($wishnu) {
            Laporan::create([
                'user_id' => $wishnu->id,
                'tanggal' => date('Y-m-d'),
                'waktu_1' => '07:45 - 08:30 WIB',
                'kegiatan_1' => 'Briefing persiapan survei lapangan dan pengecekan kuesioner bersama tim survei',
                'waktu_2' => '08:30 - 10:15 WIB',
                'kegiatan_2' => 'Perjalanan dinas menuju lokasi pencacahan di wilayah Kecamatan Warudoyong',
                'waktu_3' => '10:15 - 12:00 WIB',
                'kegiatan_3' => 'Pencacahan dan wawancara sampel responden rumah tangga blok sensus 012',
                'waktu_4' => '13:00 - 14:45 WIB',
                'kegiatan_4' => 'Pemeriksaan kelengkapan isian kuesioner dan verifikasi data anomali',
                'waktu_5' => '14:45 - 16:30 WIB',
                'kegiatan_5' => 'Penyusunan laporan progres harian dan pengunggahan berkas pencacahan',
                'waktu_6' => null,
                'kegiatan_6' => null,
                'foto_bukti_1' => 'uploads/laporan/sample_selfie.svg',
                'keterangan_foto_1' => 'Selfie bukti kehadiran di pos lapangan Warudoyong',
                'foto_bukti_2' => 'uploads/laporan/sample_kegiatan.svg',
                'keterangan_foto_2' => 'Dokumentasi wawancara responden survei Susenas',
                'latitude' => -6.92771200,
                'longitude' => 106.92994400,
                'lokasi_keterangan' => 'Kec. Warudoyong, Kota Sukabumi',
                'status' => 'submitted',
            ]);
        }

        if ($taufik) {
            Laporan::create([
                'user_id' => $taufik->id,
                'tanggal' => date('Y-m-d'),
                'waktu_1' => '08:00 - 09:30 WIB',
                'kegiatan_1' => 'Pengecekan anomali data inflasi dan komoditas pangan pasar tradisional',
                'waktu_2' => '09:30 - 11:45 WIB',
                'kegiatan_2' => 'Kunjungan pemantauan harga mingguan ke Pasar Tipar Gede Sukabumi',
                'waktu_3' => '13:00 - 15:00 WIB',
                'kegiatan_3' => 'Entri data survei harga konsumen ke aplikasi pengolahan BPS',
                'foto_bukti_1' => 'uploads/laporan/sample_selfie.svg',
                'keterangan_foto_1' => 'Selfie pemantauan di Pasar Tipar Gede',
                'foto_bukti_2' => null,
                'keterangan_foto_2' => null,
                'latitude' => -6.92543000,
                'longitude' => 106.93120000,
                'lokasi_keterangan' => 'Pasar Tipar Gede, Kec. Citamiang',
                'status' => 'approved',
                'diverifikasi_pada' => now(),
            ]);
        }
    }
}
