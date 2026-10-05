<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Laporan Pegawai - LAMBDA BPS Kota Sukabumi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f1f5f9; color: #1e293b; min-height: 100vh; display: flex; flex-direction: column; }
        
        .header {
            background-color: #1e293b;
            color: white;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #334155;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-brand img {
            width: 42px;
            height: auto;
        }

        .header-brand h1 {
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .header-brand p {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-meta {
            text-align: right;
            margin-right: 6px;
        }

        .user-name { font-size: 0.88rem; font-weight: 600; color: #f8fafc; }
        .user-nip { font-size: 0.75rem; color: #94a3b8; font-family: monospace; }

        .btn-header {
            background-color: #334155;
            color: white;
            border: 1px solid #475569;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-header:hover { background-color: #475569; color: white; }
        .btn-header svg { width: 16px; height: 16px; }

        .btn-logout {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-logout:hover { background-color: #dc2626; }
        .btn-logout svg { width: 16px; height: 16px; }

        .container {
            max-width: 1040px;
            margin: 0 auto;
            padding: 28px 20px;
            width: 100%;
        }

        .alert-flash {
            padding: 14px 18px;
            border-radius: 8px;
            font-size: 0.88rem;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .alert-flash-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        /* Banner Status Harian */
        .status-banner {
            border-radius: 10px;
            padding: 18px 24px;
            margin-bottom: 28px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            border: 1px solid transparent;
        }
        .status-banner-info {
            background-color: #eff6ff;
            border-color: #bfdbfe;
            color: #1e40af;
        }
        .status-banner-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }
        .status-banner-warning {
            background-color: #fefce8;
            border-color: #fef08a;
            color: #854d0e;
        }

        .status-banner svg {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .status-banner-content h4 {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .status-banner-content p {
            font-size: 0.84rem;
            line-height: 1.4;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 32px;
        }

        .section-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .section-subtitle {
            font-size: 0.84rem;
            color: #64748b;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group { margin-bottom: 18px; }
        .form-group label {
            display: block;
            font-size: 0.78rem;
            text-transform: uppercase;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.88rem;
            outline: none;
            background: white;
            transition: border 0.2s;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 64px;
        }

        /* Styling Kotak Bukti Foto */
        .photo-upload-box {
            background-color: #f8fafc;
            border: 1.5px dashed #cbd5e1;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            position: relative;
            transition: all 0.2s;
        }

        .photo-upload-box:hover {
            border-color: #3b82f6;
            background-color: #f0f7ff;
        }

        .preview-img {
            max-width: 100%;
            max-height: 180px;
            border-radius: 8px;
            margin-top: 12px;
            display: none;
            object-fit: cover;
            border: 1px solid #cbd5e1;
        }

        .location-info-bar {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 0.85rem;
        }

        .location-text {
            color: #475569;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .location-text svg { width: 18px; height: 18px; color: #2563eb; }

        .btn-submit {
            background-color: #1e293b;
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-size: 0.92rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-submit:hover { background-color: #334155; }
        .btn-submit svg { width: 18px; height: 18px; }

        /* Tabel Riwayat */
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-size: 0.86rem; }
        th { background-color: #f8fafc; color: #475569; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; }
        td { color: #334155; }
        tr:hover td { background-color: #f8fafc; }

        .btn-detail {
            background: none;
            border: 1px solid #cbd5e1;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #2563eb;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
        }
        .btn-detail:hover {
            background-color: #eff6ff;
            border-color: #bfdbfe;
        }
        .btn-detail svg { width: 14px; height: 14px; }

        /* Modal Base */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(15, 23, 42, 0.6);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(2px);
        }

        .modal.active { display: flex; }

        .modal-content {
            background: white;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            padding: 28px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 14px;
            margin-bottom: 20px;
        }

        .modal-title { font-size: 1.1rem; font-weight: 700; color: #0f172a; }
        .modal-close { background: none; border: none; font-size: 1.4rem; cursor: pointer; color: #94a3b8; }
        .modal-close:hover { color: #0f172a; }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
            border-top: 1px solid #e2e8f0;
            padding-top: 16px;
        }

        .btn-secondary {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
            padding: 9px 18px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-secondary:hover { background-color: #e2e8f0; }

        .btn-primary {
            background-color: #1e293b;
            color: white;
            border: none;
            padding: 9px 20px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-primary:hover { background-color: #334155; }
    </style>
</head>
<body>

    <!-- Header Navigation Portal Pegawai -->
    <header class="header">
        <div class="header-brand">
            <img src="{{ asset('images/logo.webp') }}" alt="Logo BPS" onerror="this.src='{{ asset('images/logo-bps.png') }}'">
            <div>
                <h1>LAMBDA</h1>
                <p>Badan Pusat Statistik Kota Sukabumi</p>
            </div>
        </div>

        <div class="header-actions">
            <div class="user-meta">
                <div class="user-name">{{ $user->name }}</div>
                <div class="user-nip">{{ $user->nip ?? 'Pegawai BPS' }}</div>
            </div>

            <a href="{{ route('pegawai.cetak') }}" class="btn-header" title="Cetak Rekap Kinerja Bulanan Saya">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.656h10.5Z" />
                </svg>
                Cetak CKH Saya
            </a>

            <button type="button" class="btn-header" onclick="openModal('profilModal')" title="Kelola Profil & Tanda Tangan Digital">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                Profil & TTD
            </button>

            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout" title="Keluar">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </header>

    <div class="container">
        @if(session('success'))
            <div class="alert-flash alert-flash-success">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="alert-flash" style="background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b;">
                <ul style="margin-left: 18px;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Banner Status Pelaporan Harian -->
        @if($laporanHariIni)
            @if($laporanHariIni->status === 'approved')
                <div class="status-banner status-banner-success">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div class="status-banner-content">
                        <h4>Laporan Hari Ini ({{ date('d M Y') }}) Sudah Terverifikasi & Disetujui</h4>
                        <p>Catatan kinerja harian Anda telah diverifikasi oleh Administrator. Terima kasih atas dedikasi kerja Anda!</p>
                    </div>
                </div>
            @elseif($laporanHariIni->status === 'rejected')
                <div class="status-banner status-banner-warning">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <div class="status-banner-content">
                        <h4>Laporan Hari Ini Perlu Catatan / Perbaikan</h4>
                        <p>Catatan Verifikator: <em>{{ $laporanHariIni->catatan_verifikasi ?? 'Harap konfirmasi dengan atasan atau lengkapi kembali bukti foto kegiatan lapangan.' }}</em></p>
                    </div>
                </div>
            @else
                <div class="status-banner status-banner-info">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div class="status-banner-content">
                        <h4>Laporan Hari Ini ({{ date('d M Y') }}) Telah Terkirim</h4>
                        <p>Status: Menunggu peninjauan dan persetujuan dari Administrator BPS Kota Sukabumi.</p>
                    </div>
                </div>
            @endif
        @else
            <div class="status-banner status-banner-warning">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <div class="status-banner-content">
                    <h4>Anda Belum Mengirim Laporan Hari Ini ({{ date('d F Y') }})</h4>
                    <p>Mohon isi formulir di bawah ini dengan log aktivitas jam kerja Anda dan lampirkan minimal 1 foto selfie presensi atau foto tugas dinas.</p>
                </div>
            </div>
        @endif

        <!-- Card Form Input Laporan Harian -->
        <div class="card">
            <h2 class="section-title">Input Laporan Aktivitas Harian</h2>
            <p class="section-subtitle">Catat log jam kerja dan lampirkan 1–2 foto selfie / bukti perjalanan dinas lapangan Anda</p>

            <form action="{{ route('pegawai.laporan.store') }}" method="POST" enctype="multipart/form-data" id="laporanForm">
                @csrf
                
                <!-- Hidden Coordinates GPS -->
                <input type="hidden" name="latitude" id="latInput">
                <input type="hidden" name="longitude" id="lngInput">
                <input type="hidden" name="lokasi_keterangan" id="locKeterangan">

                <div class="form-group" style="max-width: 260px;">
                    <label>Tanggal Laporan</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <!-- Bar Status Geotagging GPS -->
                <div class="location-info-bar">
                    <div class="location-text">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span id="locStatus">Mendeteksi koordinat lokasi GPS lapangan Anda...</span>
                    </div>
                    <button type="button" onclick="detectGPS()" style="background: none; border: none; color: #2563eb; font-size: 0.8rem; font-weight: 600; cursor: pointer; text-decoration: underline;">
                        Segarkan Lokasi
                    </button>
                </div>

                <!-- Bagian Log Jam Aktivitas -->
                <h3 style="font-size: 0.95rem; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">
                    Rincian Waktu & Kegiatan Kerja
                </h3>

                <!-- Waktu 1 (Wajib) -->
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Waktu 1 (Pagi)</label>
                        <input type="text" name="waktu_1" class="form-control" placeholder="Contoh: 07:45 - 08:30 WIB" value="07:45 - 08:30 WIB" required>
                    </div>
                    <div class="form-group">
                        <label>Uraian Aktivitas 1</label>
                        <textarea name="kegiatan_1" class="form-control" placeholder="Tuliskan aktivitas kerja Anda..." required>Briefing pagi dan persiapan penugasan survei</textarea>
                    </div>
                </div>

                <!-- Waktu 2 -->
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Waktu 2</label>
                        <input type="text" name="waktu_2" class="form-control" placeholder="Contoh: 08:30 - 10:15 WIB" value="08:30 - 10:15 WIB">
                    </div>
                    <div class="form-group">
                        <label>Uraian Aktivitas 2</label>
                        <textarea name="kegiatan_2" class="form-control" placeholder="Tuliskan aktivitas kerja Anda..."></textarea>
                    </div>
                </div>

                <!-- Waktu 3 -->
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Waktu 3 (Siang)</label>
                        <input type="text" name="waktu_3" class="form-control" placeholder="Contoh: 10:15 - 12:00 WIB">
                    </div>
                    <div class="form-group">
                        <label>Uraian Aktivitas 3</label>
                        <textarea name="kegiatan_3" class="form-control" placeholder="Tuliskan aktivitas kerja Anda..."></textarea>
                    </div>
                </div>

                <!-- Waktu 4 -->
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Waktu 4</label>
                        <input type="text" name="waktu_4" class="form-control" placeholder="Contoh: 13:00 - 14:45 WIB">
                    </div>
                    <div class="form-group">
                        <label>Uraian Aktivitas 4</label>
                        <textarea name="kegiatan_4" class="form-control" placeholder="Tuliskan aktivitas kerja Anda..."></textarea>
                    </div>
                </div>

                <!-- Waktu 5 -->
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Waktu 5 (Sore)</label>
                        <input type="text" name="waktu_5" class="form-control" placeholder="Contoh: 14:45 - 16:30 WIB">
                    </div>
                    <div class="form-group">
                        <label>Uraian Aktivitas 5</label>
                        <textarea name="kegiatan_5" class="form-control" placeholder="Tuliskan aktivitas kerja Anda..."></textarea>
                    </div>
                </div>

                <!-- Waktu 6 (Opsional) -->
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Waktu 6 (Lembur / Tambahan)</label>
                        <input type="text" name="waktu_6" class="form-control" placeholder="Contoh: 16:30 - 17:30 WIB">
                    </div>
                    <div class="form-group">
                        <label>Uraian Aktivitas 6</label>
                        <textarea name="kegiatan_6" class="form-control" placeholder="Tuliskan aktivitas kerja Anda..."></textarea>
                    </div>
                </div>

                <!-- Bagian Bukti Foto Selfie & Lapangan -->
                <h3 style="font-size: 0.95rem; font-weight: 700; color: #0f172a; margin-top: 12px; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">
                    Bukti Perjalanan Dinas & Selfie Lapangan (Maksimal 2 Foto)
                </h3>

                <div class="form-grid-2" style="margin-bottom: 24px;">
                    <!-- Foto 1: Selfie Presensi / Bukti Perjalanan -->
                    <div>
                        <div class="photo-upload-box">
                            <svg style="width: 32px; height: 32px; color: #64748b; margin-bottom: 8px;" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                            <div style="font-size: 0.88rem; font-weight: 600; color: #0f172a; margin-bottom: 4px;">Foto 1: Selfie Presensi Lapangan</div>
                            <div style="font-size: 0.75rem; color: #64748b; margin-bottom: 12px;">Ambil foto langsung kamera HP atau pilih dari galeri</div>
                            <input type="file" name="foto_bukti_1" id="fotoInput1" class="form-control" accept="image/*" onchange="previewImage(this, 'preview1')">
                            <img id="preview1" class="preview-img" alt="Preview Foto 1">
                        </div>
                        <input type="text" name="keterangan_foto_1" class="form-control" style="margin-top: 10px;" placeholder="Keterangan foto 1 (contoh: Presensi pos lapangan)">
                    </div>

                    <!-- Foto 2: Dokumentasi Kegiatan Lapangan -->
                    <div>
                        <div class="photo-upload-box">
                            <svg style="width: 32px; height: 32px; color: #64748b; margin-bottom: 8px;" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <div style="font-size: 0.88rem; font-weight: 600; color: #0f172a; margin-bottom: 4px;">Foto 2: Dokumentasi / Tiket / SPPD (Opsional)</div>
                            <div style="font-size: 0.75rem; color: #64748b; margin-bottom: 12px;">Foto saat wawancara survei, kuitansi, atau Surat Tugas</div>
                            <input type="file" name="foto_bukti_2" id="fotoInput2" class="form-control" accept="image/*" onchange="previewImage(this, 'preview2')">
                            <img id="preview2" class="preview-img" alt="Preview Foto 2">
                        </div>
                        <input type="text" name="keterangan_foto_2" class="form-control" style="margin-top: 10px;" placeholder="Keterangan foto 2 (contoh: Dokumentasi wawancara responden)">
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-submit">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                        Kirim Laporan Harian
                    </button>
                </div>
            </form>
        </div>

        <!-- Card Riwayat Laporan Pegawai -->
        <div class="card">
            <div class="section-header-row">
                <div>
                    <h2 class="section-title">Riwayat Laporan Saya</h2>
                    <p class="section-subtitle">Daftar laporan aktivitas harian yang telah Anda kirimkan ke Administrator</p>
                </div>
                <a href="{{ route('pegawai.cetak') }}" class="btn-header" style="background-color: #f1f5f9; color: #0f172a; border-color: #cbd5e1;">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.656h10.5Z" />
                    </svg>
                    Buka Lembar Cetak CKH
                </a>
            </div>

            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 45px;">No</th>
                        <th>Tanggal</th>
                        <th>Aktivitas Terinput</th>
                        <th>Foto Bukti</th>
                        <th>Koordinat GPS</th>
                        <th>Status</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatLaporan as $idx => $lap)
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        <td style="font-weight: 600; color: #0f172a; white-space: nowrap;">
                            {{ $lap->tanggal->format('d M Y') }}
                        </td>
                        <td>
                            <div style="font-size: 0.84rem; color: #334155; font-weight: 500;">{{ $lap->kegiatan_1 }}</div>
                            @if($lap->kegiatan_2)
                                <div style="font-size: 0.76rem; color: #64748b; margin-top: 2px;">+ {{ $lap->kegiatan_2 }}</div>
                            @endif
                        </td>
                        <td>
                            @if($lap->foto_bukti_1)
                                <a href="{{ asset($lap->foto_bukti_1) }}" target="_blank" style="display: inline-flex; align-items: center; gap: 4px; color: #2563eb; font-size: 0.8rem; text-decoration: none; font-weight: 600;">
                                    <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                    Lihat Foto
                                </a>
                            @else
                                <span style="color: #94a3b8; font-size: 0.8rem;">Tanpa Foto</span>
                            @endif
                        </td>
                        <td>
                            @if($lap->latitude && $lap->longitude)
                                <a href="https://www.google.com/maps?q={{ $lap->latitude }},{{ $lap->longitude }}" target="_blank" style="color: #2563eb; text-decoration: none; font-size: 0.8rem; font-family: monospace;">
                                    {{ number_format($lap->latitude, 4) }}, {{ number_format($lap->longitude, 4) }}
                                </a>
                            @else
                                <span style="color: #94a3b8; font-size: 0.8rem;">-</span>
                            @endif
                        </td>
                        <td>
                            @if($lap->status === 'approved')
                                <span style="color: #16a34a; font-weight: 600; font-size: 0.82rem;">Disetujui</span>
                            @elseif($lap->status === 'rejected')
                                <span style="color: #ef4444; font-weight: 600; font-size: 0.82rem;">Ditolak</span>
                            @else
                                <span style="color: #2563eb; font-weight: 600; font-size: 0.82rem;">Terkirim</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <button type="button" class="btn-detail" onclick='viewDetail({!! json_encode($lap) !!})'>
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                Rincian
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="padding: 24px; text-align: center; color: #94a3b8;">
                            Anda belum pernah mengirimkan laporan aktivitas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Profil & Tanda Tangan Digital Pegawai -->
    <div id="profilModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Profil & Tanda Tangan Digital</h3>
                <button type="button" class="modal-close" onclick="closeModal('profilModal')">&times;</button>
            </div>

            <form action="{{ route('pegawai.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>NIP Pegawai</label>
                        <input type="text" class="form-control" value="{{ $user->nip ?? '-' }}" readonly style="background-color: #f8fafc; color: #64748b;">
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" value="{{ $user->jabatan ?? 'Pegawai' }}" readonly style="background-color: #f8fafc; color: #64748b;">
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label>Ganti Password (Kosongkan jika tetap)</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter">
                </div>

                <!-- Tanda Tangan Digital -->
                <div class="form-group" style="margin-top: 14px;">
                    <label>Unggah Scan Tanda Tangan Digital (PNG/JPG)</label>
                    <div style="font-size: 0.75rem; color: #64748b; margin-bottom: 8px;">
                        Tanda tangan ini akan otomatis dicetak pada lembar Catatan Kinerja Harian (CKH) resmi Anda.
                    </div>
                    
                    @if($user->tanda_tangan)
                        <div style="margin-bottom: 12px; padding: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; text-align: center;">
                            <div style="font-size: 0.72rem; color: #475569; margin-bottom: 4px; font-weight: 600;">Tanda Tangan Saat Ini:</div>
                            <img src="{{ asset($user->tanda_tangan) }}" alt="Tanda Tangan" style="max-height: 70px; object-fit: contain;">
                        </div>
                    @endif

                    <input type="file" name="tanda_tangan" class="form-control" accept="image/*">
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal('profilModal')">Batal</button>
                    <button type="submit" class="btn-primary">Simpan Profil & TTD</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Rincian Laporan -->
    <div id="detailModal" class="modal">
        <div class="modal-content" style="max-width: 680px;">
            <div class="modal-header">
                <div>
                    <h3 class="modal-title" id="detTanggal">Rincian Laporan Aktivitas</h3>
                    <div style="font-size: 0.8rem; color: #64748b; margin-top: 2px;" id="detStatusBadge"></div>
                </div>
                <button type="button" class="modal-close" onclick="closeModal('detailModal')">&times;</button>
            </div>

            <div style="margin-bottom: 18px;">
                <h4 style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; color: #475569; margin-bottom: 10px;">
                    Aktivitas Kerja Terinput
                </h4>
                <div id="detKegiatanList" style="display: flex; flex-direction: column; gap: 8px;"></div>
            </div>

            <div style="margin-bottom: 18px; border-top: 1px solid #f1f5f9; padding-top: 14px;">
                <h4 style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; color: #475569; margin-bottom: 10px;">
                    Dokumentasi & Bukti Lapangan
                </h4>
                <div id="detFotoContainer" style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;"></div>
            </div>

            <div id="detCatatanBox" style="display: none; background: #fefce8; border: 1px solid #fef08a; padding: 12px; border-radius: 6px; font-size: 0.82rem; color: #854d0e; margin-top: 14px;">
                <strong>Catatan Verifikator:</strong> <span id="detCatatanText"></span>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-secondary" onclick="closeModal('detailModal')">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        // Modal Controls
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        // Preview Foto Form
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Deteksi Lokasi GPS Otomatis
        function detectGPS() {
            const locStatus = document.getElementById('locStatus');
            const latInput = document.getElementById('latInput');
            const lngInput = document.getElementById('lngInput');
            const locKeterangan = document.getElementById('locKeterangan');

            if ("geolocation" in navigator) {
                locStatus.textContent = "Mengambil titik koordinat satelit GPS...";
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        latInput.value = lat;
                        lngInput.value = lng;
                        locKeterangan.value = "GPS: " + lat.toFixed(6) + ", " + lng.toFixed(6);
                        locStatus.innerHTML = "Lokasi terdeteksi: <strong>" + lat.toFixed(5) + ", " + lng.toFixed(5) + "</strong> (Akurasi: ±" + Math.round(position.coords.accuracy) + "m)";
                        locStatus.style.color = "#16a34a";
                    },
                    function(error) {
                        latInput.value = "-6.927712";
                        lngInput.value = "106.929944";
                        locKeterangan.value = "Kota Sukabumi (Default BPS)";
                        locStatus.innerHTML = "Koordinat diset: <strong>Kota Sukabumi (-6.9277, 106.9299)</strong>";
                        locStatus.style.color = "#475569";
                    },
                    { enableHighAccuracy: true, timeout: 8000, maximumAge: 0 }
                );
            } else {
                locStatus.textContent = "Browser tidak mendukung GPS. Menggunakan default BPS Sukabumi.";
                latInput.value = "-6.927712";
                lngInput.value = "106.929944";
            }
        }

        // Detail Modal View
        function viewDetail(lap) {
            document.getElementById('detTanggal').textContent = "Laporan Tanggal: " + (lap.tanggal ? lap.tanggal.substring(0, 10) : "");
            
            const badgeEl = document.getElementById('detStatusBadge');
            if (lap.status === 'approved') {
                badgeEl.innerHTML = '<span style="color: #16a34a; font-weight: 600;">Status: Disetujui</span>';
            } else if (lap.status === 'rejected') {
                badgeEl.innerHTML = '<span style="color: #ef4444; font-weight: 600;">Status: Ditolak / Perlu Perbaikan</span>';
            } else {
                badgeEl.innerHTML = '<span style="color: #2563eb; font-weight: 600;">Status: Menunggu Verifikasi</span>';
            }

            // List Kegiatan
            const listEl = document.getElementById('detKegiatanList');
            listEl.innerHTML = '';
            for (let i = 1; i <= 6; i++) {
                if (lap['kegiatan_' + i]) {
                    const div = document.createElement('div');
                    div.style.cssText = "background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 14px; font-size: 0.85rem;";
                    div.innerHTML = "<strong style='color: #2563eb;'>" + (lap['waktu_' + i] || 'Waktu ' + i) + ":</strong> " + lap['kegiatan_' + i];
                    listEl.appendChild(div);
                }
            }

            // Foto
            const fotoBox = document.getElementById('detFotoContainer');
            fotoBox.innerHTML = '';
            let hasFoto = false;

            if (lap.foto_bukti_1) {
                hasFoto = true;
                fotoBox.innerHTML += `
                    <div style="border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px; text-align: center;">
                        <img src="/${lap.foto_bukti_1}" style="width: 100%; height: 160px; object-fit: cover; border-radius: 4px;" alt="Foto 1">
                        <div style="font-size: 0.75rem; color: #475569; margin-top: 6px; font-weight: 500;">${lap.keterangan_foto_1 || 'Selfie Presensi'}</div>
                    </div>
                `;
            }

            if (lap.foto_bukti_2) {
                hasFoto = true;
                fotoBox.innerHTML += `
                    <div style="border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px; text-align: center;">
                        <img src="/${lap.foto_bukti_2}" style="width: 100%; height: 160px; object-fit: cover; border-radius: 4px;" alt="Foto 2">
                        <div style="font-size: 0.75rem; color: #475569; margin-top: 6px; font-weight: 500;">${lap.keterangan_foto_2 || 'Dokumentasi Kegiatan'}</div>
                    </div>
                `;
            }

            if (!hasFoto) {
                fotoBox.innerHTML = '<div style="color: #94a3b8; font-size: 0.82rem; grid-column: 1 / -1;">Tidak ada bukti foto yang dilampirkan.</div>';
            }

            // Catatan
            const catBox = document.getElementById('detCatatanBox');
            if (lap.catatan_verifikasi) {
                catBox.style.display = 'block';
                document.getElementById('detCatatanText').textContent = lap.catatan_verifikasi;
            } else {
                catBox.style.display = 'none';
            }

            openModal('detailModal');
        }

        // Jalankan GPS otomatis saat halaman selesai dimuat
        window.addEventListener('DOMContentLoaded', detectGPS);
    </script>

</body>
</html>
