<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',
        'waktu_1',
        'kegiatan_1',
        'waktu_2',
        'kegiatan_2',
        'waktu_3',
        'kegiatan_3',
        'waktu_4',
        'kegiatan_4',
        'waktu_5',
        'kegiatan_5',
        'waktu_6',
        'kegiatan_6',
        'foto_bukti_1',
        'keterangan_foto_1',
        'foto_bukti_2',
        'keterangan_foto_2',
        'latitude',
        'longitude',
        'lokasi_keterangan',
        'status',
        'catatan_verifikasi',
        'diverifikasi_pada',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'latitude' => 'float',
            'longitude' => 'float',
            'diverifikasi_pada' => 'datetime',
        ];
    }

    /**
     * Relasi ke data pegawai pemilik laporan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
