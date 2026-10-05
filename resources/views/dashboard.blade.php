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
        padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    /* Calendar Widget Styling */
    .calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .calendar-header h3 { font-size: 1.1rem; color: #1e293b; font-weight: 700; }
    .calendar-header span { font-size: 1.1rem; color: #1e293b; font-weight: 700; }
    
    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; gap: 6px; }
    .calendar-day-name { font-size: 0.75rem; font-weight: 600; color: #ef4444; padding-bottom: 8px; }
    .calendar-date { font-size: 0.85rem; padding: 6px 0; color: #475569; }
    .calendar-date.active { background-color: #22c55e; color: white; border-radius: 50%; font-weight: 600; }
    .calendar-date.muted { color: #cbd5e1; }

    /* Stat Card Styling */
    .stat-card {
        display: flex; flex-direction: column; justify-content: center; align-items: center;
        text-align: center; position: relative; border-left: 4px solid transparent;
    }
    .stat-card.orange { border-left-color: #f97316; }
    .stat-card.blue { border-left-color: #3b82f6; }
    .stat-number { font-size: 3rem; font-weight: 700; color: #1e293b; margin-bottom: 5px; }
    .stat-icon { font-size: 1.5rem; margin-bottom: 8px; }
    .stat-card.orange .stat-icon { color: #f97316; }
    .stat-card.blue .stat-icon { color: #3b82f6; }
    .stat-label { font-size: 0.95rem; font-weight: 500; color: #64748b; }

    /* History Table Section */
    .table-section {
        background: white; border-radius: 12px; border: 1px solid #e2e8f0;
        padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .table-header-flex {
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;
    }
    .table-title { font-size: 1.1rem; font-weight: 700; color: #1e293b; }
    .badge-group { display: flex; gap: 12px; }
    .badge {
        background-color: #f1f5f9; padding: 8px 16px; border-radius: 8px;
        font-size: 0.85rem; font-weight: 600; color: #334155; border: 1px solid #e2e8f0;
    }
    .badge span { color: #0f172a; font-weight: 700; margin-left: 4px; }

    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 12px 16px; text-align: left; border-bottom: 1px solid #e2e8f0; font-size: 0.9rem; }
    th { background-color: #f8fafc; color: #475569; font-weight: 600; }
    td { color: #334155; }
</style>

<!-- Top Section: Calendar & Stats -->
<div class="top-cards">
    <!-- Calendar Card (Oktober 2026) -->
    <div class="card">
        <div class="calendar-header">
            <h3>October</h3>
            <span>2026</span>
        </div>
        <div class="calendar-grid">
            <div class="calendar-day-name">SUN</div>
            <div class="calendar-day-name">MON</div>
            <div class="calendar-day-name">TUE</div>
            <div class="calendar-day-name">WED</div>
            <div class="calendar-day-name">THU</div>
            <div class="calendar-day-name">FRI</div>
            <div class="calendar-day-name">SAT</div>

            <div class="calendar-date muted"></div>
            <div class="calendar-date muted"></div>
            <div class="calendar-date muted"></div>
            <div class="calendar-date muted"></div>
            <div class="calendar-date">1</div>
            <div class="calendar-date">2</div>
            <div class="calendar-date">3</div>

            <div class="calendar-date">4</div>
            <div class="calendar-date active">5</div>
            <div class="calendar-date">6</div>
            <div class="calendar-date">7</div>
            <div class="calendar-date">8</div>
            <div class="calendar-date">9</div>
            <div class="calendar-date">10</div>

            <div class="calendar-date">11</div>
            <div class="calendar-date">12</div>
            <div class="calendar-date">13</div>
            <div class="calendar-date">14</div>
            <div class="calendar-date">15</div>
            <div class="calendar-date">16</div>
            <div class="calendar-date">17</div>

            <div class="calendar-date">18</div>
            <div class="calendar-date">19</div>
            <div class="calendar-date">20</div>
            <div class="calendar-date">21</div>
            <div class="calendar-date">22</div>
            <div class="calendar-date">23</div>
            <div class="calendar-date">24</div>

            <div class="calendar-date">25</div>
            <div class="calendar-date">26</div>
            <div class="calendar-date">27</div>
            <div class="calendar-date">28</div>
            <div class="calendar-date">29</div>
            <div class="calendar-date">30</div>
            <div class="calendar-date">31</div>
        </div>
    </div>

    <!-- Stat Card 1 -->
    <div class="card stat-card orange">
        <div class="stat-number">2</div>
        <div class="stat-icon"><i class="fas fa-file-invoice"></i></div>
        <div class="stat-label">Pengguna Aktif Harian</div>
    </div>

    <!-- Stat Card 2 -->
    <div class="card stat-card blue">
        <div class="stat-number">23</div>
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-label">Total pengguna</div>
    </div>
</div>

<!-- Bottom Section: History Table -->
<div class="table-section">
    <div class="table-header-flex">
        <div class="table-title">Riwayat Laporan Hari Ini</div>
        <div class="badge-group">
            <div class="badge">Jumlah Laporan Harian <span>7</span></div>
            <div class="badge">Pengguna Belum Melapor <span>21</span></div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Waktu 1</th>
                <th>Waktu 2</th>
                <th>Waktu 3</th>
                <th>Waktu 4</th>
                <th>Waktu 5</th>
                <th>Waktu 6</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Muhidin</td>
                <td>07:48 - 08:11 WIB</td>
                <td>08:15 - 10:17 WIB</td>
                <td>10:17 - 10:58 WIB</td>
                <td>10:59 - 11:45 WIB</td>
                <td>13:06 - 14:32 WIB</td>
                <td>14:43 - Sedang Berjalan</td>
            </tr>
            <tr>
                <td>Wishnu Eka Saputra</td>
                <td>08:04 - 08:04 WIB</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection