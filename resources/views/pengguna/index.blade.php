@extends('layouts.app')

@section('content')
<style>
    .content-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .search-box-container {
        display: flex;
        gap: 10px;
    }
    .search-input {
        padding: 10px 15px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        width: 280px;
        font-size: 0.9rem;
        outline: none;
        background-color: white;
    }
    .search-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .btn-search {
        background-color: #1e293b;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-search:hover {
        background-color: #334155;
    }
    .btn-add {
        background-color: #1e293b;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-add:hover {
        background-color: #334155;
    }

    /* Table Styling */
    .table-container {
        background: white;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    th, td {
        padding: 14px 16px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 0.9rem;
    }
    th {
        background-color: #1e293b;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    tr:hover {
        background-color: #f8fafc;
    }
    td {
        color: #334155;
    }
    .text-muted {
        color: #94a3b8;
        font-style: italic;
    }
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    .btn-action {
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: white;
        transition: opacity 0.2s;
    }
    .btn-action:hover { opacity: 0.85; }
    .btn-edit { background-color: #3b82f6; }
    .btn-delete { background-color: #ef4444; }
</style>

<!-- Judul Halaman di dalam Konten -->
<div style="margin-bottom: 20px;">
    <h2 style="font-size: 1.4rem; font-weight: 700; color: #1e293b;">Kelola Pengguna</h2>
</div>

<!-- Bagian Atas: Kotak Pencarian & Tombol Tambah -->
<div class="content-header-flex">
    <div class="search-box-container">
        <input type="text" class="search-input" placeholder="Cari pengguna...">
        <button class="btn-search">Cari</button>
    </div>
    <a href="#" class="btn-add"><i class="fas fa-plus"></i> Tambah pengguna</a>
</div>

<!-- Tabel Daftar Pengguna -->
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>NIP</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>Role</th>
                <th>Tanda Tangan</th>
                <th style="width: 100px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>admin_bps</td>
                <td>Admin</td>
                <td>199001012024011001</td>
                <td>admin@bps.go.id</td>
                <td>Pranata Komputer</td>
                <td>Super_admin</td>
                <td><span class="text-muted">Belum ada</span></td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action btn-edit" title="Edit"><i class="fas fa-pen"></i></button>
                        <button class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Wishnu Eka Saputra</td>
                <td>Wishnu</td>
                <td>197205181999031001</td>
                <td>wishnu_eka@bps.go.id</td>
                <td>Kepala Sub Bagian Umum</td>
                <td>Pegawai</td>
                <td><i class="fas fa-signature" style="color: #3b82f6; font-size: 1.2rem;" title="Ada"></i></td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action btn-edit" title="Edit"><i class="fas fa-pen"></i></button>
                        <button class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Taufik Januar</td>
                <td>Taufik</td>
                <td>198101232001121002</td>
                <td>taufikjanuar@bps.go.id</td>
                <td>Asisten Statistisi Terampil</td>
                <td>Pegawai</td>
                <td><span class="text-muted">Belum ada</span></td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action btn-edit" title="Edit"><i class="fas fa-pen"></i></button>
                        <button class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Dani Jaelani</td>
                <td>Dani</td>
                <td>196912101991121001</td>
                <td>dani@bps.go.id</td>
                <td>Kepala Kantor</td>
                <td>Pegawai</td>
                <td><i class="fas fa-signature" style="color: #3b82f6; font-size: 1.2rem;" title="Ada"></i></td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action btn-edit" title="Edit"><i class="fas fa-pen"></i></button>
                        <button class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>Anita Rahminingrum</td>
                <td>Anita</td>
                <td>197806041999122002</td>
                <td>anita@bps.go.id</td>
                <td>Statistisi Ahli Muda</td>
                <td>Pegawai</td>
                <td><span class="text-muted">Belum ada</span></td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action btn-edit" title="Edit"><i class="fas fa-pen"></i></button>
                        <button class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection