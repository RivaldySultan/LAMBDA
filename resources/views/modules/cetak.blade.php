@extends('layouts.app')

@section('content')
<style>
    /* Styling Kontrol Parameter */
    .control-panel {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px;
        margin-bottom: 28px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .control-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1.5fr auto;
        gap: 16px;
        align-items: flex-end;
    }

    .ctrl-group { display: flex; flex-direction: column; gap: 6px; }
    .ctrl-label { font-size: 0.75rem; text-transform: uppercase; font-weight: 600; color: #475569; }
    .ctrl-input {
        padding: 9px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 0.88rem;
        outline: none;
        background: white;
    }
    .ctrl-input:focus {
        border-color: #3b82f6;
    }

    .btn-print {
        background-color: #1e293b;
        color: white;
        border: none;
        padding: 10px 22px;
        border-radius: 8px;
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
        height: 40px;
    }
    .btn-print:hover { background-color: #0f172a; }
    .btn-print svg { width: 18px; height: 18px; }

    /* Lembar Kertas Dokumen Dinas A4 */
    .paper-sheet {
        background: #ffffff;
        width: 100%;
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 48px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        color: #000000;
        font-family: 'Times New Roman', Times, serif;
    }

    /* KOP Surat BPS */
    .kop-container {
        display: flex;
        align-items: center;
        gap: 20px;
        padding-bottom: 12px;
        border-bottom: 3px double #000000;
        margin-bottom: 24px;
    }

    .kop-logo {
        width: 80px;
        height: auto;
        flex-shrink: 0;
    }

    .kop-text {
        text-align: center;
        flex: 1;
        line-height: 1.35;
    }

    .kop-text h2 {
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: 1px;
        margin: 0 0 2px 0;
        text-transform: uppercase;
        color: #000000;
    }

    .kop-text h1 {
        font-size: 1.45rem;
        font-weight: 800;
        letter-spacing: 1px;
        margin: 0 0 4px 0;
        text-transform: uppercase;
        color: #000000;
    }

    .kop-text p {
        font-size: 0.85rem;
        margin: 0;
        color: #1e293b;
    }

    /* Judul Laporan */
    .doc-title-box {
        text-align: center;
        margin-bottom: 24px;
    }

    .doc-title {
        font-size: 1.15rem;
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: underline;
        margin-bottom: 4px;
    }

    .doc-subtitle {
        font-size: 0.95rem;
        font-weight: 600;
    }

    /* Tabel Identitas Pegawai */
    .identitas-table {
        width: 100%;
        margin-bottom: 20px;
        font-size: 0.95rem;
        border-collapse: collapse;
    }

    .identitas-table td {
        padding: 4px 6px;
        vertical-align: top;
    }

    /* Tabel Rekap Kinerja */
    .rekap-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 28px;
        font-size: 0.88rem;
    }

    .rekap-table th, .rekap-table td {
        border: 1px solid #000000;
        padding: 8px 10px;
        vertical-align: top;
    }

    .rekap-table th {
        background-color: #f1f5f9;
        text-align: center;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    /* Bagian Tanda Tangan */
    .signature-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-top: 36px;
        page-break-inside: avoid;
        font-size: 0.95rem;
    }

    .sig-box {
        text-align: center;
    }

    .sig-title {
        margin-bottom: 70px;
        line-height: 1.4;
    }

    .sig-name {
        font-weight: 700;
        text-decoration: underline;
    }

    .sig-nip {
        font-size: 0.88rem;
    }

    /* Lampiran Foto Bukti */
    .lampiran-section {
        margin-top: 48px;
        padding-top: 24px;
        border-top: 1px dashed #cbd5e1;
        page-break-before: always;
    }

    .lampiran-title {
        text-align: center;
        font-size: 1.05rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    .lampiran-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .lampiran-card {
        border: 1px solid #000000;
        padding: 8px;
        text-align: center;
    }

    .lampiran-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
        margin-bottom: 8px;
    }

    .lampiran-meta {
        font-size: 0.8rem;
        line-height: 1.35;
        text-align: left;
    }

    /* CSS Khusus Cetak (@media print) */
    @media print {
        body {
            background: #ffffff !important;
            color: #000000 !important;
        }

        .sidebar, .header, .control-panel, .screen-only {
            display: none !important;
        }

        .main-wrapper, .content {
            padding: 0 !important;
            margin: 0 !important;
            overflow: visible !important;
            width: 100% !important;
            background: white !important;
        }

        .paper-sheet {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            max-width: 100% !important;
            margin: 0 !important;
        }

        .rekap-table th {
            background-color: #f1f5f9 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        @page {
            size: A4 portrait;
            margin: 15mm 15mm 15mm 15mm;
        }
    }
</style>

<!-- Judul Halaman (Hanya Tampil di Layar) -->
<div class="screen-only" style="margin-bottom: 20px;">
    <h2 style="font-size: 1.4rem; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Cetak Rekapitulasi Laporan Kinerja</h2>
    <p style="font-size: 0.88rem; color: #64748b;">Pratinjau lembar dinas resmi Badan Pusat Statistik Kota Sukabumi siap cetak atau ekspor PDF</p>
</div>

<!-- Panel Kontrol Parameter Dokumen -->
<div class="control-panel screen-only">
    <form action="{{ route('cetak.index') }}" method="GET" id="filterCetakForm" class="control-grid">
        <!-- Pilih Pegawai -->
        <div class="ctrl-group">
            <label class="ctrl-label">Pilih Pegawai BPS</label>
            <select name="user_id" class="ctrl-input" onchange="document.getElementById('filterCetakForm').submit()">
                @foreach($pegawai as $p)
                    <option value="{{ $p->id }}" {{ $userId == $p->id ? 'selected' : '' }}>
                        {{ $p->name }} ({{ $p->nip ?? 'Tanpa NIP' }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Bulan -->
        <div class="ctrl-group">
            <label class="ctrl-label">Bulan Pelaporan</label>
            <input type="month" name="bulan" class="ctrl-input" value="{{ $bulan }}" onchange="document.getElementById('filterCetakForm').submit()">
        </div>

        <!-- Pilih Pejabat Penilai -->
        <div class="ctrl-group">
            <label class="ctrl-label">Pejabat Penilai / Pengesah</label>
            <select name="pejabat_id" class="ctrl-input" onchange="document.getElementById('filterCetakForm').submit()">
                @foreach($pejabatList as $pj)
                    <option value="{{ $pj->id }}" {{ ($selectedPejabat->id ?? '') == $pj->id ? 'selected' : '' }}>
                        {{ $pj->name }} ({{ $pj->jabatan ?? 'Atasan Langsung' }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Aksi Cetak -->
        <div>
            <button type="button" onclick="window.print()" class="btn-print">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.656h10.5Z" />
                </svg>
                Cetak / Simpan PDF
            </button>
        </div>
    </form>

    <div style="margin-top: 14px; font-size: 0.85rem; color: #475569; display: flex; align-items: center; gap: 8px;">
        <input type="checkbox" id="checkFoto" {{ $sertakanFoto ? 'checked' : '' }} onchange="toggleFoto(this)">
        <label for="checkFoto" style="cursor: pointer;">Sertakan Lampiran Lembar Dokumentasi Foto Selfie & Bukti Lapangan</label>
    </div>
</div>

<!-- ========================================== -->
<!-- LEMBAR PRATINJAU DOKUMEN RESMI BPS KOTA SUKABUMI -->
<!-- ========================================== -->
<div class="paper-sheet" id="printArea">
    <!-- KOP SURAT DINAS BPS -->
    <div class="kop-container">
        <img src="{{ asset('images/logo.webp') }}" class="kop-logo" alt="Logo BPS" onerror="this.src='{{ asset('images/logo-bps.png') }}'">
        <div class="kop-text">
            <h2>BADAN PUSAT STATISTIK</h2>
            <h1>KOTA SUKABUMI</h1>
            <p>Jl. Taman Bahagia No. 12, Benteng, Kec. Warudoyong, Kota Sukabumi, Jawa Barat 43132</p>
            <p>Telepon: (0266) 222123 • Email: bps3272@bps.go.id • Laman: sukabumikota.bps.go.id</p>
        </div>
    </div>

    <!-- JUDUL DOKUMEN -->
    <div class="doc-title-box">
        <div class="doc-title">LAPORAN CAPAIAN KINERJA HARIAN (CKH) PEGAWAI</div>
        <div class="doc-subtitle">Periode: {{ $periodeFormat }}</div>
    </div>

    <!-- TABEL IDENTITAS PEGAWAI -->
    <table class="identitas-table">
        <tr>
            <td style="width: 180px; font-weight: bold;">Nama Pegawai</td>
            <td style="width: 15px;">:</td>
            <td style="font-weight: bold;">{{ $selectedUser->name ?? '-' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">NIP</td>
            <td>:</td>
            <td>{{ $selectedUser->nip ?? '-' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Jabatan</td>
            <td>:</td>
            <td>{{ $selectedUser->jabatan ?? '-' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Unit Organisasi</td>
            <td>:</td>
            <td>Badan Pusat Statistik Kota Sukabumi</td>
        </tr>
    </table>

    <!-- TABEL REKAPITULASI AKTIVITAS KERJA -->
    <table class="rekap-table">
        <thead>
            <tr>
                <th style="width: 35px;">No</th>
                <th style="width: 95px;">Hari / Tanggal</th>
                <th style="width: 110px;">Jam Kerja</th>
                <th>Uraian Aktivitas Kinerja Lapangan / Kantor</th>
                <th style="width: 130px;">Lokasi / Titik Tugas</th>
                <th style="width: 85px;">Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporans as $index => $lap)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center; font-weight: bold;">{{ $lap->tanggal->format('d/m/Y') }}</td>
                <td style="font-size: 0.8rem; line-height: 1.4;">
                    <div>{{ $lap->waktu_1 }}</div>
                    @if($lap->waktu_2) <div>{{ $lap->waktu_2 }}</div> @endif
                    @if($lap->waktu_3) <div>{{ $lap->waktu_3 }}</div> @endif
                </td>
                <td style="line-height: 1.45;">
                    <div><strong>Aktivitas 1:</strong> {{ $lap->kegiatan_1 }}</div>
                    @if($lap->kegiatan_2)
                        <div style="margin-top: 4px;"><strong>Aktivitas 2:</strong> {{ $lap->kegiatan_2 }}</div>
                    @endif
                    @if($lap->kegiatan_3)
                        <div style="margin-top: 4px;"><strong>Aktivitas 3:</strong> {{ $lap->kegiatan_3 }}</div>
                    @endif
                    @if($lap->kegiatan_4)
                        <div style="margin-top: 4px;"><strong>Aktivitas 4:</strong> {{ $lap->kegiatan_4 }}</div>
                    @endif
                </td>
                <td style="font-size: 0.8rem;">
                    <div>{{ $lap->lokasi_keterangan ?? 'Kota Sukabumi' }}</div>
                    @if($lap->latitude && $lap->longitude)
                        <div style="font-family: monospace; font-size: 0.72rem; color: #475569; margin-top: 2px;">
                            GPS: {{ number_format($lap->latitude, 4) }}, {{ number_format($lap->longitude, 4) }}
                        </div>
                    @endif
                </td>
                <td style="text-align: center; font-size: 0.8rem; font-weight: bold;">
                    {{ $lap->status === 'approved' ? 'DISETUJUI' : 'TERVERIFIKASI' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px; font-style: italic; color: #64748b;">
                    Tidak ada catatan aktivitas kerja pada periode {{ $periodeFormat }}.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- LEMBAR PENGESAHAN TANDA TANGAN -->
    <div class="signature-grid">
        <!-- Kolom Pegawai -->
        <div class="sig-box">
            <div class="sig-title">
                Pegawai yang Dinilai,<br>
                BPS Kota Sukabumi
            </div>
            @if($selectedUser && $selectedUser->tanda_tangan)
                <div style="margin: -60px 0 10px 0;">
                    <img src="{{ asset($selectedUser->tanda_tangan) }}" style="height: 55px; width: auto;" alt="TTD">
                </div>
            @endif
            <div class="sig-name">{{ $selectedUser->name ?? '-' }}</div>
            <div class="sig-nip">NIP. {{ $selectedUser->nip ?? '-' }}</div>
        </div>

        <!-- Kolom Pejabat Penilai -->
        <div class="sig-box">
            <div class="sig-title">
                Sukabumi, {{ date('d') }} {{ $periodeFormat }}<br>
                Pejabat Penilai Kinerja,<br>
                {{ $selectedPejabat->jabatan ?? 'Kepala BPS Kota Sukabumi' }}
            </div>
            @if($selectedPejabat && $selectedPejabat->tanda_tangan)
                <div style="margin: -60px 0 10px 0;">
                    <img src="{{ asset($selectedPejabat->tanda_tangan) }}" style="height: 55px; width: auto;" alt="TTD">
                </div>
            @endif
            <div class="sig-name">{{ $selectedPejabat->name ?? 'Dani Jaelani' }}</div>
            <div class="sig-nip">NIP. {{ $selectedPejabat->nip ?? '-' }}</div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- LEMBAR LAMPIRAN FOTO BUKTI LAPANGAN (HALAMAN 2) -->
    <!-- ========================================== -->
    <div class="lampiran-section" id="lampiranFotoArea" style="{{ $sertakanFoto ? '' : 'display: none;' }}">
        <div class="lampiran-title">
            LAMPIRAN BUKTI FOTO KEGIATAN & SELFIE PRESENSI LAPANGAN<br>
            <span style="font-size: 0.9rem; font-weight: normal;">Periode: {{ $periodeFormat }} • Pegawai: {{ $selectedUser->name ?? '-' }}</span>
        </div>

        <div class="lampiran-grid">
            @php $fotoCount = 0; @endphp
            @foreach($laporans as $lap)
                @if($lap->foto_bukti_1)
                    @php $fotoCount++; @endphp
                    <div class="lampiran-card">
                        <img src="{{ asset($lap->foto_bukti_1) }}" alt="Foto Selfie Presensi">
                        <div class="lampiran-meta">
                            <strong>Tanggal:</strong> {{ $lap->tanggal->format('d/m/Y') }}<br>
                            <strong>Keterangan:</strong> {{ $lap->keterangan_foto_1 ?? 'Foto Selfie Presensi Lapangan' }}<br>
                            @if($lap->latitude && $lap->longitude)
                                <strong>Koordinat:</strong> {{ number_format($lap->latitude, 6) }}, {{ number_format($lap->longitude, 6) }}
                            @endif
                        </div>
                    </div>
                @endif

                @if($lap->foto_bukti_2)
                    @php $fotoCount++; @endphp
                    <div class="lampiran-card">
                        <img src="{{ asset($lap->foto_bukti_2) }}" alt="Dokumentasi Kegiatan">
                        <div class="lampiran-meta">
                            <strong>Tanggal:</strong> {{ $lap->tanggal->format('d/m/Y') }}<br>
                            <strong>Keterangan:</strong> {{ $lap->keterangan_foto_2 ?? 'Dokumentasi Survei Lapangan' }}<br>
                            @if($lap->latitude && $lap->longitude)
                                <strong>Koordinat:</strong> {{ number_format($lap->latitude, 6) }}, {{ number_format($lap->longitude, 6) }}
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach

            @if($fotoCount === 0)
                <div style="grid-column: 1 / -1; text-align: center; padding: 24px; font-style: italic; color: #64748b; border: 1px dashed #cbd5e1;">
                    Tidak ada lampiran foto bukti pada periode laporan ini.
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function toggleFoto(checkbox) {
        const lampiran = document.getElementById('lampiranFotoArea');
        if (checkbox.checked) {
            lampiran.style.display = 'block';
        } else {
            lampiran.style.display = 'none';
        }
    }
</script>
@endsection
