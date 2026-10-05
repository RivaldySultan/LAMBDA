<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LAMBDA BPS Kota Sukabumi</title>
    <!-- Font & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f1f5f9; overflow: hidden; }
        
        /* Sidebar Styling (Gelap) */
        .sidebar {
            width: 260px; background-color: #1e293b; color: #cbd5e1;
            display: flex; flex-direction: column; justify-content: space-between;
            height: 100vh;
        }
        .sidebar-top { overflow-y: auto; flex: 1; }
        .sidebar-brand {
            padding: 24px; border-bottom: 1px solid #334155;
        }
        .sidebar-brand h2 { color: white; font-size: 1.5rem; font-weight: 700; letter-spacing: 1px; }
        .sidebar-brand p { color: #94a3b8; font-size: 0.75rem; margin-top: 4px; }
        
        .sidebar-menu { padding: 20px 0; }
        .menu-item {
            display: flex; align-items: center; gap: 12px; padding: 12px 24px; color: #cbd5e1;
            text-decoration: none; font-size: 0.9rem; transition: background 0.2s;
        }
        .menu-item i { width: 20px; text-align: center; }
        .menu-item:hover, .menu-item.active { background-color: #334155; color: white; border-left: 4px solid #3b82f6; }
        
        /* Footer Sidebar (Logo BPS) */
        .sidebar-footer {
            padding: 20px; border-top: 1px solid #334155; text-align: center;
        }
        .sidebar-footer img { width: 45px; height: auto; margin-bottom: 8px; }
        .sidebar-footer p { font-size: 0.7rem; color: #94a3b8; font-weight: 600; line-height: 1.2; }

        /* Main Wrapper */
        .main-wrapper { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        
        /* Header Styling */
        .header {
            height: 70px; background-color: #1e293b; border-bottom: 1px solid #334155;
            display: flex; align-items: center; justify-content: space-between; padding: 0 30px;
            color: white;
        }
        .header-title { font-size: 1.2rem; font-weight: 600; }
        .btn-logout {
            background-color: #ef4444; color: white; border: none; padding: 8px 16px;
            border-radius: 6px; font-weight: 600; font-size: 0.85rem; cursor: pointer; text-decoration: none;
            transition: background 0.2s;
        }
        .btn-logout:hover { background-color: #dc2626; }
        
        .content { padding: 30px; overflow-y: auto; flex: 1; background-color: #f8fafc; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-top">
            <div class="sidebar-brand">
                <h2>LAMBDA</h2>
                <p>Aplikasi Pelaporan Harian</p>
            </div>
            <nav class="sidebar-menu">
                <!-- Menu Dashboard -->
                <a href="/dashboard" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                
                <!-- Menu Kelola Pengguna -->
                <a href="{{ route('pengguna.index') }}" class="menu-item {{ request()->routeIs('pengguna.index') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Kelola Pengguna
                </a>

                <a href="#" class="menu-item"><i class="fas fa-tools"></i> Kelola Teknis</a>
                <a href="#" class="menu-item"><i class="fas fa-poll"></i> Kelola Survei</a>
                <a href="#" class="menu-item"><i class="fas fa-file-alt"></i> Laporan</a>
                <a href="#" class="menu-item"><i class="fas fa-print"></i> Cetak</a>
                <a href="#" class="menu-item"><i class="fas fa-info-circle"></i> Info BPS</a>
            </nav>
        </div>
        
        <div class="sidebar-footer">
            <img src="{{ asset('images/logo.webp') }}" alt="Logo BPS" onerror="this.src='{{ asset('images/logo-bps.png') }}'">
            <p>BADAN PUSAT STATISTIK<br>KOTA SUKABUMI</p>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <header class="header">
            <div class="header-title">Dashboard Admin</div>
            <a href="/" class="btn-logout">Logout</a>
        </header>
        
        <main class="content">
            @yield('content')
        </main>
    </div>

</body>
</html>