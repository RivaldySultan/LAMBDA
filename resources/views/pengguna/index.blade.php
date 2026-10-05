@extends('layouts.app')

@section('content')
<style>
    .content-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }
    .search-box-container {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .search-input {
        padding: 10px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        width: 300px;
        font-size: 0.88rem;
        outline: none;
        background-color: white;
        transition: border 0.2s;
    }
    .search-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .btn-search {
        background-color: #1e293b;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s;
    }
    .btn-search:hover { background-color: #334155; }
    .btn-search svg { width: 16px; height: 16px; }

    .btn-reset {
        color: #64748b;
        font-size: 0.85rem;
        text-decoration: none;
        padding: 8px 12px;
    }
    .btn-reset:hover { color: #0f172a; text-decoration: underline; }

    .btn-add {
        background-color: #1e293b;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }
    .btn-add:hover { background-color: #334155; }
    .btn-add svg { width: 18px; height: 18px; }

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
        padding: 14px 18px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 0.88rem;
    }
    th {
        background-color: #1e293b;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    tr:hover td {
        background-color: #f8fafc;
    }
    td {
        color: #334155;
    }
    .text-muted {
        color: #94a3b8;
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: white;
        transition: opacity 0.2s;
    }
    .btn-action svg { width: 15px; height: 15px; }
    .btn-action:hover { opacity: 0.85; }
    .btn-edit { background-color: #3b82f6; }
    .btn-delete { background-color: #ef4444; }

    /* Modal Backdrop & Dialog */
    .modal-backdrop {
        position: fixed;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.6);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 999;
        padding: 20px;
    }
    .modal-backdrop.show { display: flex; }
    .modal-card {
        background: white;
        border-radius: 14px;
        width: 100%;
        max-width: 540px;
        padding: 28px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        max-height: 90vh;
        overflow-y: auto;
    }
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 12px;
    }
    .modal-title { font-size: 1.15rem; font-weight: 700; color: #0f172a; }
    .modal-close {
        background: transparent;
        border: none;
        cursor: pointer;
        color: #94a3b8;
        display: flex;
        align-items: center;
    }
    .modal-close:hover { color: #0f172a; }
    .modal-close svg { width: 20px; height: 20px; }

    .form-group { margin-bottom: 16px; }
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
    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
        border-top: 1px solid #f1f5f9;
        padding-top: 16px;
    }
    .btn-secondary {
        background: #f1f5f9;
        color: #475569;
        border: none;
        padding: 9px 18px;
        border-radius: 8px;
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
    }
    .btn-primary {
        background: #1e293b;
        color: white;
        border: none;
        padding: 9px 20px;
        border-radius: 8px;
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
    }
    .btn-primary:hover { background: #334155; }
</style>

<!-- Header Judul -->
<div style="margin-bottom: 24px;">
    <h2 style="font-size: 1.4rem; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Kelola Pengguna</h2>
    <p style="font-size: 0.88rem; color: #64748b;">Daftar seluruh aparatur sipil negara dan staf BPS Kota Sukabumi</p>
</div>

<!-- Pencarian & Tombol Tambah -->
<div class="content-header-flex">
    <form action="{{ route('pengguna.index') }}" method="GET" class="search-box-container">
        <input type="text" name="search" class="search-input" placeholder="Cari nama, NIP, atau jabatan..." value="{{ $search ?? '' }}">
        <button type="submit" class="btn-search">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            Cari
        </button>
        @if($search)
            <a href="{{ route('pengguna.index') }}" class="btn-reset">Reset Pencarian</a>
        @endif
    </form>

    <button type="button" class="btn-add" onclick="openModalTambah()">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Tambah Pengguna
    </button>
</div>

<!-- Tabel Pengguna -->
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
                <th style="width: 110px; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengguna as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="font-weight: 600; color: #0f172a;">{{ $item->name }}</td>
                <td>{{ $item->username }}</td>
                <td style="font-family: monospace;">{{ $item->nip ?? '-' }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->jabatan ?? '-' }}</td>
                <td>
                    <span style="font-weight: 600; font-size: 0.8rem; color: {{ $item->role === 'admin' ? '#2563eb' : '#475569' }};">
                        {{ strtoupper($item->role) }}
                    </span>
                </td>
                <td>
                    @if($item->tanda_tangan)
                        <span style="color: #16a34a; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                            <svg style="width: 15px; height: 15px;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Tersedia
                        </span>
                    @else
                        <span class="text-muted">Belum ada</span>
                    @endif
                </td>
                <td style="text-align: right;">
                    <div class="action-buttons" style="justify-content: flex-end;">
                        <button type="button" class="btn-action btn-edit" title="Edit Pengguna" 
                            onclick='openModalEdit(@json($item))'>
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </button>

                        <form action="{{ route('pengguna.destroy', $item->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $item->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" title="Hapus Pengguna">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="padding: 32px; text-align: center; color: #94a3b8;">
                    Tidak ada data pengguna yang ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Tambah Pengguna -->
<div id="modalTambah" class="modal-backdrop">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Pengguna Baru</h3>
            <button type="button" class="modal-close" onclick="closeModal('modalTambah')">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('pengguna.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Wishnu Eka Saputra" required>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="wishnu" required>
                </div>
                <div class="form-group">
                    <label>NIP (18 Digit)</label>
                    <input type="text" name="nip" class="form-control" placeholder="197205181999031001">
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label>Email Dinas</label>
                    <input type="email" name="email" class="form-control" placeholder="user@bps.go.id" required>
                </div>
                <div class="form-group">
                    <label>Password Awal</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" placeholder="Statistisi Ahli Muda">
                </div>
                <div class="form-group">
                    <label>Role Akses</label>
                    <select name="role" class="form-control" required>
                        <option value="pegawai">Pegawai</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>File Tanda Tangan Digital (PNG/SVG, Maks 2MB)</label>
                <input type="file" name="tanda_tangan" class="form-control" accept="image/*,.svg">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('modalTambah')">Batal</button>
                <button type="submit" class="btn-primary">Simpan Pengguna</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Pengguna -->
<div id="modalEdit" class="modal-backdrop">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Pengguna</h3>
            <button type="button" class="modal-close" onclick="closeModal('modalEdit')">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="formEditPengguna" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" id="edit_name" name="name" class="form-control" required>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="edit_username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" id="edit_nip" name="nip" class="form-control">
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="edit_email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control" placeholder="Password baru">
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" id="edit_jabatan" name="jabatan" class="form-control">
                </div>
                <div class="form-group">
                    <label>Role Akses</label>
                    <select id="edit_role" name="role" class="form-control" required>
                        <option value="pegawai">Pegawai</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Ganti Tanda Tangan Digital (Opsional)</label>
                <input type="file" name="tanda_tangan" class="form-control" accept="image/*,.svg">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('modalEdit')">Batal</button>
                <button type="submit" class="btn-primary">Perbarui Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModalTambah() {
        document.getElementById('modalTambah').classList.add('show');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('show');
    }

    function openModalEdit(item) {
        document.getElementById('formEditPengguna').action = '{{ url("kelola-pengguna") }}/' + item.id;
        document.getElementById('edit_name').value = item.name;
        document.getElementById('edit_username').value = item.username;
        document.getElementById('edit_nip').value = item.nip || '';
        document.getElementById('edit_email').value = item.email;
        document.getElementById('edit_jabatan').value = item.jabatan || '';
        document.getElementById('edit_role').value = item.role;
        document.getElementById('modalEdit').classList.add('show');
    }

    // Tutup modal jika klik di luar card
    window.onclick = function(event) {
        const modalTambah = document.getElementById('modalTambah');
        const modalEdit = document.getElementById('modalEdit');
        if (event.target === modalTambah) modalTambah.classList.remove('show');
        if (event.target === modalEdit) modalEdit.classList.remove('show');
    }
</script>
@endsection