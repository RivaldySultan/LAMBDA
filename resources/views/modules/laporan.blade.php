@extends('layouts.app')

@section('content')
<style>
    .filter-card {
        background: white; border: 1px solid #e2e8f0; border-radius: 12px;
        padding: 20px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        display: flex; gap: 16px; align-items: flex-end; flex-wrap: wrap;
    }
    .filter-group { display: flex; flex-direction: column; gap: 6px; }
    .filter-label { font-size: 0.75rem; text-transform: uppercase; font-weight: 600; color: #64748b; }
    .filter-control {
        padding: 9px 14px; border: 1px solid #cbd5e1; border-radius: 8px;
        font-size: 0.88rem; outline: none; background: white;
    }

    .table-container {
        background: white; border: 1px solid #e2e8f0; border-radius: 12px;
        padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow-x: auto;
    }
    table { width: 100%; border-collapse: collapse; text-align: left; }
    th, td { padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-size: 0.88rem; }
    th { background-color: #f8fafc; color: #475569; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; }
    td { color: #334155; }
    tr:hover td { background-color: #f8fafc; }

    /* Modal Verifikasi & Galeri */
    .modal-backdrop {
        position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6);
        display: none; justify-content: center; align-items: center; z-index: 1000; padding: 20px;
    }
    .modal-backdrop.show { display: flex; }
    .modal-card {
        background: white; border-radius: 14px; width: 100%; max-width: 680px;
        max-height: 90vh; overflow-y: auto; padding: 28px; box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
    .modal-header {
        display: flex; justify-content: space-between; align-items: center;
        border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; margin-bottom: 20px;
    }
    .modal-title { font-size: 1.2rem; font-weight: 700; color: #0f172a; }
    .modal-close { background: none; border: none; cursor: pointer; color: #94a3b8; }
    .modal-close svg { width: 20px; height: 20px; }

    .photo-gallery-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin: 16px 0 24px 0;
    }
    .photo-card {
        background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden;
    }
    .photo-card img {
        width: 100%; height: 160px; object-fit: cover; display: block; border-bottom: 1px solid #e2e8f0;
    }
    .photo-caption {
        padding: 10px 12px; font-size: 0.8rem; color: #475569; line-height: 1.4;
    }

    .btn-verify {
        background-color: #16a34a; color: white; border: none; padding: 9px 18px;
        border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer;
    }
    .btn-verify:hover { background-color: #15803d; }
</style>

<div style="margin-bottom: 24px;">
    <h2 style="font-size: 1.4rem; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Rekapitulasi Laporan Harian Pegawai</h2>
    <p style="font-size: 0.88rem; color: #64748b;">Monitoring log kerja dan verifikasi bukti foto selfie perjalanan dinas BPS Kota Sukabumi</p>
</div>

<!-- Form Filter -->
<form action="{{ route('laporan.index') }}" method="GET" class="filter-card">
    <div class="filter-group">
        <label class="filter-label">Filter Pegawai</label>
        <select name="user_id" class="filter-control" style="min-width: 220px;">
            <option value="">-- Semua Pegawai --</option>
            @foreach($pegawai as $p)
                <option value="{{ $p->id }}" {{ ($userId ?? '') == $p->id ? 'selected' : '' }}>
                    {{ $p->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="filter-group">
        <label class="filter-label">Filter Tanggal</label>
        <input type="date" name="tanggal" class="filter-control" value="{{ $tanggal ?? '' }}">
    </div>

    <div>
        <button type="submit" style="background-color: #1e293b; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer;">
            Terapkan Filter
        </button>
        @if($userId || $tanggal)
            <a href="{{ route('laporan.index') }}" style="margin-left: 10px; font-size: 0.85rem; color: #64748b; text-decoration: underline;">Reset</a>
        @endif
    </div>
</form>

<!-- Tabel Laporan -->
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <span style="font-size: 0.95rem; font-weight: 600; color: #1e293b;">Daftar Pelaporan Masuk (Total: {{ $laporans->count() }})</span>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Tanggal</th>
                <th>Nama Pegawai</th>
                <th>Aktivitas Utama</th>
                <th>Bukti Foto</th>
                <th>Lokasi GPS</th>
                <th>Status</th>
                <th style="text-align: right; width: 140px;">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporans as $index => $lap)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="font-weight: 600; color: #0f172a;">{{ $lap->tanggal->format('d M Y') }}</td>
                <td>
                    <div style="font-weight: 600; color: #0f172a;">{{ $lap->user->name }}</div>
                    <div style="font-size: 0.75rem; color: #64748b; font-family: monospace;">{{ $lap->user->nip ?? 'NIP: -' }}</div>
                </td>
                <td>
                    <div style="font-size: 0.85rem; color: #334155;">{{ $lap->kegiatan_1 }}</div>
                </td>
                <td>
                    @if($lap->foto_bukti_1 && $lap->foto_bukti_2)
                        <span style="color: #2563eb; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                            <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            </svg>
                            2 Foto Bukti
                        </span>
                    @elseif($lap->foto_bukti_1)
                        <span style="color: #2563eb; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                            <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            </svg>
                            1 Foto Selfie
                        </span>
                    @else
                        <span style="color: #94a3b8;">Tanpa Foto</span>
                    @endif
                </td>
                <td>
                    @if($lap->latitude && $lap->longitude)
                        <a href="https://www.google.com/maps?q={{ $lap->latitude }},{{ $lap->longitude }}" target="_blank" style="color: #2563eb; text-decoration: none; font-size: 0.8rem; font-family: monospace; display: inline-flex; align-items: center; gap: 4px;">
                            <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            Buka Peta
                        </a>
                    @else
                        <span style="color: #94a3b8;">-</span>
                    @endif
                </td>
                <td>
                    @if($lap->status === 'approved')
                        <span style="color: #16a34a; font-weight: 600; font-size: 0.82rem;">Disetujui</span>
                    @elseif($lap->status === 'rejected')
                        <span style="color: #ef4444; font-weight: 600; font-size: 0.82rem;">Ditolak</span>
                    @else
                        <span style="color: #2563eb; font-weight: 600; font-size: 0.82rem;">Perlu Review</span>
                    @endif
                </td>
                <td style="text-align: right;">
                    <button type="button" class="btn-verify" onclick='openModalDetail(@json($lap), @json($lap->user))'>
                        Lihat Rincian
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="padding: 32px; text-align: center; color: #94a3b8;">
                    Tidak ada laporan yang sesuai dengan kriteria filter.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Rincian Laporan & Galeri Bukti -->
<div id="modalDetail" class="modal-backdrop">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title" id="mUserTitle">Rincian Laporan Pegawai</h3>
            <button type="button" class="modal-close" onclick="closeModalDetail()">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 20px; font-size: 0.85rem;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span style="color: #64748b;">Nama & NIP:</span>
                <span style="font-weight: 600; color: #0f172a;" id="mNameNip">-</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span style="color: #64748b;">Tanggal Tugas:</span>
                <span style="font-weight: 600; color: #0f172a;" id="mTanggal">-</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="color: #64748b;">Titik Lokasi GPS:</span>
                <span style="font-weight: 600; color: #2563eb;" id="mLocationLink">-</span>
            </div>
        </div>

        <!-- Daftar Aktivitas -->
        <h4 style="font-size: 0.82rem; text-transform: uppercase; font-weight: 700; color: #475569; margin-bottom: 10px;">Log Aktivitas Jam Kerja</h4>
        <div id="mActivityList" style="font-size: 0.88rem; color: #334155; line-height: 1.5; margin-bottom: 20px;"></div>

        <!-- Galeri Bukti Foto -->
        <h4 style="font-size: 0.82rem; text-transform: uppercase; font-weight: 700; color: #475569; margin-bottom: 10px;">Bukti Foto Perjalanan & Dokumentasi Lapangan</h4>
        <div id="mPhotoGallery" class="photo-gallery-grid"></div>

        <!-- Form Verifikasi -->
        <form id="formVerifikasi" method="POST" style="border-top: 1px solid #f1f5f9; padding-top: 18px; margin-top: 20px;">
            @csrf
            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 0.78rem; text-transform: uppercase; font-weight: 600; color: #475569; margin-bottom: 6px;">Catatan Verifikator (Opsional)</label>
                <input type="text" name="catatan_verifikasi" class="filter-control" style="width: 100%;" placeholder="Contoh: Kinerja terverifikasi lengkap dan sesuai penugasan">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="submit" name="status" value="rejected" style="background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca; padding: 9px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer;">
                    Tolak Laporan
                </button>
                <button type="submit" name="status" value="approved" style="background-color: #16a34a; color: white; border: none; padding: 9px 22px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer;">
                    Setujui & Verifikasi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModalDetail(lap, user) {
        document.getElementById('mUserTitle').textContent = 'Laporan Harian: ' + user.name;
        document.getElementById('mNameNip').textContent = user.name + ' (' + (user.nip || 'Tanpa NIP') + ')';
        document.getElementById('mTanggal').textContent = lap.tanggal;
        
        if (lap.latitude && lap.longitude) {
            document.getElementById('mLocationLink').innerHTML = `<a href="https://www.google.com/maps?q=${lap.latitude},${lap.longitude}" target="_blank" style="color: #2563eb; text-decoration: underline;">Buka Koordinat (${Number(lap.latitude).toFixed(4)}, ${Number(lap.longitude).toFixed(4)})</a>`;
        } else {
            document.getElementById('mLocationLink').textContent = 'Tidak ada koordinat terlampir';
        }

        // Tampilkan Aktivitas
        let actHtml = '';
        for (let i = 1; i <= 6; i++) {
            if (lap['waktu_' + i] && lap['kegiatan_' + i]) {
                actHtml += `<div style="padding: 8px 12px; background: #f8fafc; border-radius: 6px; margin-bottom: 6px;">
                    <strong style="color: #0f172a;">${lap['waktu_' + i]}:</strong> ${lap['kegiatan_' + i]}
                </div>`;
            }
        }
        document.getElementById('mActivityList').innerHTML = actHtml || '<span style="color:#94a3b8;">Tidak ada rincian kegiatan terinput.</span>';

        // Tampilkan Galeri Foto
        let photoHtml = '';
        if (lap.foto_bukti_1) {
            photoHtml += `<div class="photo-card">
                <a href="/${lap.foto_bukti_1}" target="_blank"><img src="/${lap.foto_bukti_1}" alt="Foto 1"></a>
                <div class="photo-caption"><strong>Foto 1:</strong> ${lap.keterangan_foto_1 || 'Selfie Presensi Lapangan'}</div>
            </div>`;
        }
        if (lap.foto_bukti_2) {
            photoHtml += `<div class="photo-card">
                <a href="/${lap.foto_bukti_2}" target="_blank"><img src="/${lap.foto_bukti_2}" alt="Foto 2"></a>
                <div class="photo-caption"><strong>Foto 2:</strong> ${lap.keterangan_foto_2 || 'Dokumentasi Kegiatan'}</div>
            </div>`;
        }
        document.getElementById('mPhotoGallery').innerHTML = photoHtml || '<div style="color: #94a3b8; font-size: 0.85rem; padding: 12px;">Pegawai tidak melampirkan foto bukti pada laporan ini.</div>';

        // Form action
        document.getElementById('formVerifikasi').action = '{{ url("laporan") }}/' + lap.id + '/verifikasi';
        document.getElementById('modalDetail').classList.add('show');
    }

    function closeModalDetail() {
        document.getElementById('modalDetail').classList.remove('show');
    }

    window.onclick = function(event) {
        const modal = document.getElementById('modalDetail');
        if (event.target === modal) modal.classList.remove('show');
    }
</script>
@endsection
