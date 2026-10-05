<aside class="sidebar-container">
    <nav class="sidebar-menu">
    <a href="/dashboard" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a>
    <a href="{{ route('pengguna.index') }}" class="menu-item {{ request()->routeIs('pengguna.index') ? 'active' : '' }}"><i class="fas fa-users"></i> Kelola Pengguna</a>
    <a href="#" class="menu-item"><i class="fas fa-tools"></i> Kelola Teknis</a>
    <a href="#" class="menu-item"><i class="fas fa-poll"></i> Kelola Survei</a>
    <a href="#" class="menu-item"><i class="fas fa-file-alt"></i> Laporan</a>
    <a href="#" class="menu-item"><i class="fas fa-print"></i> Cetak</a>
    <a href="#" class="menu-item"><i class="fas fa-info-circle"></i> Info BPS</a>
</nav>

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