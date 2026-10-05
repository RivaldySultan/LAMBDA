@extends('layouts.app')

@section('content')
<style>
    /* Styling khusus untuk area dalam konten dashboard */
    .page-title { color: #0f172a; margin-bottom: 24px; font-size: 1.5rem; font-weight: 600; }
    
    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .card {
        background: white; padding: 24px;
        border-radius: 12px; border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .card h3 { color: #64748b; font-size: 0.9rem; font-weight: 500; margin-bottom: 10px; }
    .card .value { font-size: 2rem; font-weight: 700; color: #1e293b; }
</style>

<h2 class="page-title">Ringkasan Dashboard</h2>

<div class="card-container">
    <div class="card">
        <h3>Total Laporan Bulan Ini</h3>
        <div class="value">124</div>
    </div>
    <div class="card">
        <h3>Survei Aktif</h3>
        <div class="value">8</div>
    </div>
    <div class="card">
        <h3>Pengguna Aktif</h3>
        <div class="value">45</div>
    </div>
</div>
@endsection