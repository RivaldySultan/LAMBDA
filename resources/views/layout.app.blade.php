<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Lambda</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f1f5f9; overflow: hidden; }
        
        /* Sidebar Styling */
        .sidebar {
            width: 260px; background-color: #0f172a; color: #cbd5e1;
            display: flex; flex-direction: column;
        }
        .sidebar-brand {
            padding: 24px; font-size: 1.5rem; font-weight: 700;
            color: white; border-bottom: 1px solid #1e293b;
        }
        .sidebar-menu { padding: 20px 0; overflow-y: auto; flex: 1; }
        .menu-label {
            padding: 0 24px; margin-bottom: 10px; margin-top: 15px;
            font-size: 0.75rem; text-transform: uppercase;
            letter-spacing: 1px; color: #64748b; font-weight: 600;
        }
        .menu-item {
            display: block; padding: 12px 24px; color: #cbd5e1;
            text-decoration: none; font-size: 0.95rem; transition: background 0.2s;
        }
        .menu-item:hover, .menu-item.active { background-color: #1e293b; color: white; border-left: 4px solid #3b82f6; }
        
        /* Main Content Styling */
        .main-wrapper { flex: 1; display: flex; flex-direction: column; }
        .header {
            height: 70px; background-color: white; border-bottom: 1px solid #e2e8f0;
            display: flex; align-items: center; justify-content: flex-end; padding: 0 30px;
        }
        .user-profile { font-weight: 500; color: #334155; cursor: pointer; }
        
        .content { padding: 30px; overflow-y: auto; flex: 1; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">LAMBDA</div>
        <nav class="sidebar-menu">
            
            <a href="#" class="menu-item active">Dashboard</a>

            <!-- Simulasi Tampilan Menu Admin -->
            <div class="menu-label">Menu Admin</div>
            <a href="#" class="menu-item">Kelola Pengguna</a>
            <a href="#" class="menu-item">Kelola Teknis</a>
            <a href="#" class="menu-item">Kelola Survei</a>

            <!-- Simulasi Tampilan Menu User -->
            <div class="menu-label">Menu User</div>
            <a href="#" class="menu-item">Laporan</a>

            <!-- Menu Gabungan (Admin & User) -->
            <div class="menu-label">Lainnya</div>
            <a href="#" class="menu-item">Cetak</a>
            <a href="#" class="menu-item">Info BPS</a>
            
        </nav>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <header class="header">
            <div class="user-profile">Halo, Rivaldy (Preview Mode)</div>
        </header>
        
        <main class="content">
            <!-- Ini area yang akan berubah-ubah (Slot) -->
            @yield('content')
        </main>
    </div>

</body>
</html>