<aside class="sidebar-container">
    <nav class="sidebar-menu">
        <!-- Menu Global (Tampil untuk semua role) -->
        <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="icon-dashboard"></i> Dashboard
        </a>

        <!-- Menu Khusus Admin -->
        @if(auth()->user()->role === 'admin')
            <div class="menu-section">Manajemen Admin</div>
            <a href="{{ route('pengguna.index') }}" class="menu-item">Kelola Pengguna</a>
            <a href="{{ route('teknis.index') }}" class="menu-item">Kelola Teknis</a>
            <a href="{{ route('survei.index') }}" class="menu-item">Kelola Survei</a>
        @endif

        <!-- Menu Khusus User -->
        @if(auth()->user()->role === 'user')
            <div class="menu-section">Menu Utama</div>
            <!-- Mengacu pada LaporanController yang ada di referensi -->
            <a href="{{ route('laporan.index') }}" class="menu-item">Laporan</a>
        @endif

        <!-- Menu Bersama (Admin & User) -->
        <div class="menu-section">Lainnya</div>
        <!-- Mengacu pada InfoBpsController di referensi -->
        <a href="{{ route('info-bps.index') }}" class="menu-item">Info BPS</a>
        <a href="{{ route('cetak.index') }}" class="menu-item">Cetak</a>
    </nav>
</aside>