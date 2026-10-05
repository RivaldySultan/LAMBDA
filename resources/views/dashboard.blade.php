@extends('layouts.app')

@section('content')
<style>
    .top-cards {
        display: grid;
        grid-template-columns: 320px 1fr 1fr;
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .card {
        background: white; border-radius: 12px; border: 1px solid #e2e8f0;
        padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    /* Calendar Widget Styling */
    .calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .calendar-header h3 { font-size: 1.1rem; color: #1e293b; font-weight: 700; }
    .calendar-header span { font-size: 1.1rem; color: #1e293b; font-weight: 700; }
    
    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; gap: 6px; }
    .calendar-day-name { font-size: 0.72rem; font-weight: 600; color: #ef4444; padding-bottom: 8px; }
    .calendar-date { font-size: 0.82rem; padding: 6px 0; color: #475569; }
    .calendar-date.active { background-color: #22c55e; color: white; border-radius: 50%; font-weight: 600; }
    .calendar-date.muted { color: #cbd5e1; }

    /* Stat Card Styling */
    .stat-card {
        display: flex; flex-direction: column; justify-content: center; align-items: center;
        text-align: center; position: relative; border-left: 4px solid transparent;
    }
    .stat-card.orange { border-left-color: #f97316; }
    .stat-card.blue { border-left-color: #3b82f6; }
    .stat-number { font-size: 3.2rem; font-weight: 700; color: #0f172a; line-height: 1; margin-bottom: 12px; }
    .stat-icon { margin-bottom: 10px; display: flex; align-items: center; justify-content: center; }
    .stat-icon svg { width: 28px; height: 28px; }
    .stat-card.orange .stat-icon { color: #f97316; }
    .stat-card.blue .stat-icon { color: #3b82f6; }
    .stat-label { font-size: 0.92rem; font-weight: 600; color: #64748b; }

    /* History Table Section */
    .table-section {
        background: white; border-radius: 12px; border: 1px solid #e2e8f0;
        padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .table-header-flex {
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;
    }
    .table-title { font-size: 1.1rem; font-weight: 700; color: #0f172a; }
    .meta-status-text {
        font-size: 0.85rem; font-weight: 600; color: #475569;
    }
    .meta-status-text span {
        color: #0f172a; font-weight: 700;
    }

    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 14px 16px; text-align: left; border-bottom: 1px solid #e2e8f0; font-size: 0.88rem; }
    th { background-color: #f8fafc; color: #475569; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; }
    td { color: #334155; }
    tr:hover td { background-color: #f8fafc; }
</style>

<!-- Top Section: Calendar & Stats -->
<div class="top-cards">
    <!-- Calendar Card (Dinamis Bulan & Tahun Berjalan) -->
    <div class="card">
        <div class="calendar-header">
            <h3 id="calMonth">Bulan</h3>
            <span id="calYear">Tahun</span>
        </div>
        <div class="calendar-grid">
            <div class="calendar-day-name">MIN</div>
            <div class="calendar-day-name">SEN</div>
            <div class="calendar-day-name">SEL</div>
            <div class="calendar-day-name">RAB</div>
            <div class="calendar-day-name">KAM</div>
            <div class="calendar-day-name">JUM</div>
            <div class="calendar-day-name">SAB</div>

            <!-- Di-generate otomatis oleh script di bawah -->
            <div id="calendarDays" style="display: contents;"></div>
        </div>
    </div>

    <!-- Stat Card 1: Laporan Masuk Hari Ini -->
    <div class="card stat-card orange">
        <div class="stat-number">{{ $jumlahLaporanHariIni }}</div>
        <div class="stat-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
        </div>
        <div class="stat-label">Laporan Masuk Hari Ini</div>
    </div>

    <!-- Stat Card 2: Total Pegawai -->
    <div class="card stat-card blue">
        <div class="stat-number">{{ $totalPegawai }}</div>
        <div class="stat-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
        </div>
        <div class="stat-label">Total Pegawai Terdaftar</div>
    </div>
</div>

<!-- Bottom Section: History Table -->
<div class="table-section">
    <div class="table-header-flex">
        <div class="table-title">Riwayat Log Aktivitas Hari Ini ({{ date('d F Y') }})</div>
        <div class="meta-status-text">
            Belum Melapor: <span>{{ $pegawaiBelumMelapor }} Pegawai</span> &nbsp;•&nbsp; 
            <a href="{{ route('laporan.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 600;">Lihat Semua di Modul Laporan &rarr;</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Waktu 1 (Pagi)</th>
                <th>Waktu 2</th>
                <th>Waktu 3 (Siang)</th>
                <th>Bukti Foto Selfie</th>
                <th>Status Verifikasi</th>
                <th style="text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporansHariIni as $lap)
            <tr>
                <td>
                    <div style="font-weight: 600; color: #0f172a;">{{ $lap->user->name }}</div>
                    <div style="font-size: 0.75rem; color: #64748b; font-family: monospace;">{{ $lap->user->nip ?? '-' }}</div>
                </td>
                <td>{{ $lap->waktu_1 ?? '-' }}</td>
                <td>{{ $lap->waktu_2 ?? '-' }}</td>
                <td>{{ $lap->waktu_3 ?? '-' }}</td>
                <td>
                    @if($lap->foto_bukti_1)
                        <span style="color: #16a34a; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                            <svg style="width: 15px; height: 15px;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            </svg>
                            Foto Terlampir
                        </span>
                    @else
                        <span style="color: #94a3b8;">Tanpa Foto</span>
                    @endif
                </td>
                <td>
                    @if($lap->status === 'approved')
                        <span style="color: #16a34a; font-weight: 600; font-size: 0.82rem;">Disetujui</span>
                    @elseif($lap->status === 'rejected')
                        <span style="color: #ef4444; font-weight: 600; font-size: 0.82rem;">Ditolak</span>
                    @else
                        <span style="color: #2563eb; font-weight: 600; font-size: 0.82rem;">Perlu Verifikasi</span>
                    @endif
                </td>
                <td style="text-align: right;">
                    <a href="{{ route('laporan.index') }}" style="color: #2563eb; font-weight: 600; font-size: 0.85rem; text-decoration: none;">
                        Periksa Bukti
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding: 28px; text-align: center; color: #94a3b8;">
                    Belum ada laporan harian yang masuk untuk tanggal hari ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    // Kalender Dinamis Bulan Berjalan
    (function renderCalendar() {
        const now = new Date();
        const year = now.getFullYear();
        const month = now.getMonth();
        const today = now.getDate();

        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        document.getElementById('calMonth').textContent = monthNames[month];
        document.getElementById('calYear').textContent = year;

        const firstDayIndex = new Date(year, month, 1).getDay();
        const lastDay = new Date(year, month + 1, 0).getDate();

        const container = document.getElementById('calendarDays');
        let html = '';

        for (let i = 0; i < firstDayIndex; i++) {
            html += '<div class="calendar-date muted"></div>';
        }

        for (let day = 1; day <= lastDay; day++) {
            const activeClass = (day === today) ? ' active' : '';
            html += `<div class="calendar-date${activeClass}">${day}</div>`;
        }

        container.innerHTML = html;
    })();
</script>
@endsection