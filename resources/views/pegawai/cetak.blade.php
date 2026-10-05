<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak CKH - {{ $user->name }} - {{ $periodeFormat }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f1f5f9; color: #1e293b; min-height: 100vh; padding: 32px 16px; }

        /* Toolbar Kontrol Cetak */
        .toolbar {
            max-width: 960px;
            margin: 0 auto 24px auto;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .toolbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #475569;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 8px 14px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            background: white;
            transition: all 0.2s;
        }
        .btn-back:hover { background-color: #f8fafc; color: #0f172a; }
        .btn-back svg { width: 16px; height: 16px; }

        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #1e293b;
            color: white;
            padding: 9px 20px;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: background 0.2s;
        }
        .btn-print:hover { background-color: #0f172a; }
        .btn-print svg { width: 18px; height: 18px; }

        .filter-form {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .filter-input {
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 0.85rem;
            outline: none;
            background: white;
        }

        /* Lembar Dokumen A4 */
        .paper-sheet {
            max-width: 960px;
            margin: 0 auto 32px auto;
            background: white;
            padding: 48px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        /* Kop Surat BPS */
        .kop-surat {
            display: flex;
            align-items: center;
            gap: 20px;
            border-bottom: 2.5px solid #0f172a;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }

        .kop-logo {
            width: 72px;
            height: auto;
        }

        .kop-text h2 {
            font-size: 1.15rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
        }

        .kop-text h1 {
            font-size: 1.35rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #0f172a;
            margin: 2px 0;
        }

        .kop-text p {
            font-size: 0.78rem;
            color: #475569;
            line-height: 1.4;
        }

        .doc-title {
            text-align: center;
            margin-bottom: 24px;
        }

        .doc-title h3 {
            font-size: 1.05rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
        }

        .doc-title p {
            font-size: 0.85rem;
            color: #475569;
            margin-top: 4px;
        }

        /* Identitas Pegawai */
        .bio-table {
            width: 100%;
            margin-bottom: 24px;
            border-collapse: collapse;
        }

        .bio-table td {
            padding: 4px 8px;
            font-size: 0.85rem;
            border: none;
            color: #334155;
        }

        .bio-table td.bio-label {
            width: 180px;
            font-weight: 600;
            color: #0f172a;
        }

        /* Tabel CKH */
        .ckh-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 32px;
        }

        .ckh-table th, .ckh-table td {
            border: 1px solid #cbd5e1;
            padding: 8px 10px;
            font-size: 0.82rem;
            vertical-align: top;
        }

        .ckh-table th {
            background-color: #f8fafc;
            color: #0f172a;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .activity-item {
            margin-bottom: 6px;
            line-height: 1.35;
        }

        .activity-time {
            font-weight: 600;
            color: #2563eb;
            display: inline-block;
            min-width: 110px;
        }

        /* Lembar Tanda Tangan */
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .signature-box {
            width: 320px;
            text-align: center;
            font-size: 0.85rem;
        }

        .signature-box .role-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .signature-space {
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signature-space img {
            max-height: 80px;
            max-width: 180px;
            object-fit: contain;
        }

        .signature-name {
            font-weight: 700;
            color: #0f172a;
            text-decoration: underline;
        }

        .signature-nip {
            font-size: 0.78rem;
            color: #64748b;
            font-family: monospace;
            margin-top: 2px;
        }

        /* Lampiran Dokumentasi Foto */
        .photo-gallery-print {
            margin-top: 48px;
            page-break-before: always;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 16px;
        }

        .gallery-card {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 10px;
            background: #fafafa;
            page-break-inside: avoid;
        }

        .gallery-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }

        .gallery-caption {
            font-size: 0.78rem;
            color: #334155;
            margin-top: 8px;
            font-weight: 500;
        }

        .gallery-meta {
            font-size: 0.72rem;
            color: #64748b;
            margin-top: 4px;
        }

        /* Print Mode */
        @media print {
            body { background: white; padding: 0; }
            .toolbar { display: none !important; }
            .paper-sheet {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                max-width: 100% !important;
            }
        }
    </style>
</head>
<body>

    <!-- Toolbar Atas (Disembunyikan saat dicetak) -->
    <div class="toolbar">
        <div class="toolbar-left">
            <a href="{{ route('pegawai.portal') }}" class="btn-back">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Portal
            </a>
            
            <form action="{{ route('pegawai.cetak') }}" method="GET" class="filter-form">
                <input type="month" name="bulan" value="{{ $bulan }}" class="filter-input" onchange="this.form.submit()">
                
                <select name="pejabat_id" class="filter-input" onchange="this.form.submit()">
                    @foreach($pejabatList as $pj)
                        <option value="{{ $pj->id }}" {{ $selectedPejabat && $selectedPejabat->id === $pj->id ? 'selected' : '' }}>
                            Penilai: {{ $pj->name }} ({{ $pj->jabatan ?? 'Atasan' }})
                        </option>
                    @endforeach
                </select>

                <label style="font-size: 0.8rem; color: #475569; display: flex; align-items: center; gap: 6px; cursor: pointer;">
                    <input type="checkbox" name="sertakan_foto" value="1" {{ $sertakanFoto ? 'checked' : '' }} onchange="this.form.submit()">
                    Lampirkan Foto
                </label>
            </form>
        </div>

        <button onclick="window.print()" class="btn-print">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.656h10.5Z" />
            </svg>
            Cetak / Simpan PDF
        </button>
    </div>

    <!-- Lembar Kertas Dokumen Dinas CKH -->
    <div class="paper-sheet">
        <!-- Kop Surat Resmi -->
        <div class="kop-surat">
            <img src="{{ asset('images/logo.webp') }}" alt="Logo BPS" class="kop-logo" onerror="this.src='{{ asset('images/logo-bps.png') }}'">
            <div class="kop-text">
                <h2>BADAN PUSAT STATISTIK</h2>
                <h1>KOTA SUKABUMI</h1>
                <p>Jl. Selabintana No. 24, Selabatu, Kec. Cikole, Kota Sukabumi, Jawa Barat 43114</p>
                <p>Laman: sukabumikota.bps.go.id | Email: bps3272@bps.go.id</p>
            </div>
        </div>

        <div class="doc-title">
            <h3>CATATAN KINERJA HARIAN (CKH) PEGAWAI</h3>
            <p>Periode Aktivitas: <strong>{{ $periodeFormat }}</strong></p>
        </div>

        <!-- Identitas Pegawai -->
        <table class="bio-table">
            <tr>
                <td class="bio-label">Nama Pegawai</td>
                <td>: <strong>{{ $user->name }}</strong></td>
                <td class="bio-label">Unit Kerja</td>
                <td>: BPS Kota Sukabumi</td>
            </tr>
            <tr>
                <td class="bio-label">NIP</td>
                <td>: {{ $user->nip ?? '-' }}</td>
                <td class="bio-label">Jabatan</td>
                <td>: {{ $user->jabatan ?? 'Staf Pelaksana' }}</td>
            </tr>
        </table>

        <!-- Tabel Aktivitas Kinerja Harian -->
        <table class="ckh-table">
            <thead>
                <tr>
                    <th style="width: 35px;">No</th>
                    <th style="width: 95px;">Hari / Tgl</th>
                    <th>Rincian Waktu & Aktivitas Kerja</th>
                    <th style="width: 140px;">Bukti Kehadiran / Lokasi</th>
                    <th style="width: 85px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporans as $i => $lap)
                <tr>
                    <td style="text-align: center;">{{ $i + 1 }}</td>
                    <td style="font-weight: 600;">
                        <div>{{ $lap->tanggal->translatedFormat('l') }}</div>
                        <div style="font-size: 0.75rem; color: #64748b; font-weight: normal;">{{ $lap->tanggal->format('d/m/Y') }}</div>
                    </td>
                    <td>
                        <div class="activity-item">
                            <span class="activity-time">{{ $lap->waktu_1 }}:</span>
                            <span>{{ $lap->kegiatan_1 }}</span>
                        </div>
                        @if($lap->kegiatan_2)
                        <div class="activity-item">
                            <span class="activity-time">{{ $lap->waktu_2 }}:</span>
                            <span>{{ $lap->kegiatan_2 }}</span>
                        </div>
                        @endif
                        @if($lap->kegiatan_3)
                        <div class="activity-item">
                            <span class="activity-time">{{ $lap->waktu_3 }}:</span>
                            <span>{{ $lap->kegiatan_3 }}</span>
                        </div>
                        @endif
                        @if($lap->kegiatan_4)
                        <div class="activity-item">
                            <span class="activity-time">{{ $lap->waktu_4 }}:</span>
                            <span>{{ $lap->kegiatan_4 }}</span>
                        </div>
                        @endif
                        @if($lap->kegiatan_5)
                        <div class="activity-item">
                            <span class="activity-time">{{ $lap->waktu_5 }}:</span>
                            <span>{{ $lap->kegiatan_5 }}</span>
                        </div>
                        @endif
                        @if($lap->kegiatan_6)
                        <div class="activity-item">
                            <span class="activity-time">{{ $lap->waktu_6 }}:</span>
                            <span>{{ $lap->kegiatan_6 }}</span>
                        </div>
                        @endif
                    </td>
                    <td style="font-size: 0.75rem;">
                        @if($lap->latitude && $lap->longitude)
                            <div style="font-weight: 600; color: #0f172a;">GPS Terverifikasi</div>
                            <div style="color: #64748b; font-family: monospace;">{{ number_format($lap->latitude, 4) }}, {{ number_format($lap->longitude, 4) }}</div>
                        @else
                            <div style="color: #94a3b8;">Presensi Kantor</div>
                        @endif
                        @if($lap->foto_bukti_1 || $lap->foto_bukti_2)
                            <div style="color: #16a34a; font-weight: 600; margin-top: 4px;">Foto Terlampir</div>
                        @endif
                    </td>
                    <td style="text-align: center; font-size: 0.75rem; font-weight: 600;">
                        @if($lap->status === 'approved')
                            <span style="color: #16a34a;">Disetujui</span>
                        @elseif($lap->status === 'rejected')
                            <span style="color: #ef4444;">Ditolak</span>
                        @else
                            <span style="color: #2563eb;">Diajukan</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 24px; color: #94a3b8;">
                        Tidak ada catatan aktivitas untuk periode {{ $periodeFormat }}.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pengesahan Tanda Tangan -->
        <div class="signature-section">
            <!-- Pihak Penilai / Pimpinan -->
            <div class="signature-box">
                <div class="role-label">Mengetahui,<br>{{ $selectedPejabat->jabatan ?? 'Atasan Langsung' }}</div>
                <div class="signature-space">
                    @if($selectedPejabat && $selectedPejabat->tanda_tangan)
                        <img src="{{ asset($selectedPejabat->tanda_tangan) }}" alt="Tanda Tangan Atasan">
                    @endif
                </div>
                <div class="signature-name">{{ $selectedPejabat->name ?? 'Administrator' }}</div>
                <div class="signature-nip">NIP. {{ $selectedPejabat->nip ?? '197001011995031001' }}</div>
            </div>

            <!-- Pegawai Yang Bersangkutan -->
            <div class="signature-box">
                <div class="role-label">Sukabumi, {{ date('t') }} {{ explode(' ', $periodeFormat)[0] ?? 'Bulan' }} {{ date('Y') }}<br>Pegawai yang Dinilai</div>
                <div class="signature-space">
                    @if($user->tanda_tangan)
                        <img src="{{ asset($user->tanda_tangan) }}" alt="Tanda Tangan Pegawai">
                    @endif
                </div>
                <div class="signature-name">{{ $user->name }}</div>
                <div class="signature-nip">NIP. {{ $user->nip ?? '-' }}</div>
            </div>
        </div>

        <!-- Lampiran Foto Bukti Perjalanan / Kegiatan Lapangan -->
        @if($sertakanFoto)
        @php
            $daftarFoto = [];
            foreach ($laporans as $lap) {
                if ($lap->foto_bukti_1) {
                    $daftarFoto[] = [
                        'url' => $lap->foto_bukti_1,
                        'keterangan' => $lap->keterangan_foto_1 ?? 'Foto Selfie / Presensi',
                        'tanggal' => $lap->tanggal->format('d M Y'),
                        'lokasi' => $lap->latitude ? number_format($lap->latitude, 4) . ', ' . number_format($lap->longitude, 4) : 'BPS Sukabumi'
                    ];
                }
                if ($lap->foto_bukti_2) {
                    $daftarFoto[] = [
                        'url' => $lap->foto_bukti_2,
                        'keterangan' => $lap->keterangan_foto_2 ?? 'Dokumentasi Kegiatan Lapangan',
                        'tanggal' => $lap->tanggal->format('d M Y'),
                        'lokasi' => $lap->latitude ? number_format($lap->latitude, 4) . ', ' . number_format($lap->longitude, 4) : 'BPS Sukabumi'
                    ];
                }
            }
        @endphp

        @if(count($daftarFoto) > 0)
        <div class="photo-gallery-print">
            <div style="border-bottom: 2px solid #0f172a; padding-bottom: 8px; margin-bottom: 16px;">
                <h3 style="font-size: 1rem; font-weight: 700; text-transform: uppercase;">
                    LAMPIRAN DOKUMENTASI & FOTO KEGIATAN PERJALANAN DINAS
                </h3>
                <p style="font-size: 0.78rem; color: #64748b;">
                    Dokumentasi otentik selfie presensi dan bukti aktivitas lapangan pegawai BPS Kota Sukabumi
                </p>
            </div>

            <div class="gallery-grid">
                @foreach($daftarFoto as $f)
                <div class="gallery-card">
                    <img src="{{ asset($f['url']) }}" alt="Foto Bukti">
                    <div class="gallery-caption">{{ $f['keterangan'] }}</div>
                    <div class="gallery-meta">Tanggal: {{ $f['tanggal'] }} | Koordinat: {{ $f['lokasi'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endif

    </div>

</body>
</html>
