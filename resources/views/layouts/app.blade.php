<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAMBDA - BPS Kota Sukabumi</title>
    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f1f5f9; overflow: hidden; }
        
        /* Sidebar Styling (Navy Slate Dark) */
        .sidebar {
            width: 260px;
            background-color: #1e293b;
            color: #cbd5e1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
            border-right: 1px solid #334155;
            flex-shrink: 0;
        }
        .sidebar-top { overflow-y: auto; flex: 1; }
        .sidebar-brand {
            padding: 24px;
            border-bottom: 1px solid #334155;
        }
        .sidebar-brand h2 { color: white; font-size: 1.4rem; font-weight: 700; letter-spacing: 1px; }
        .sidebar-brand p { color: #94a3b8; font-size: 0.75rem; margin-top: 4px; }
        
        .sidebar-menu { padding: 18px 0; }
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .menu-item svg { width: 18px; height: 18px; flex-shrink: 0; }
        .menu-item:hover {
            background-color: #334155;
            color: white;
        }
        .menu-item.active {
            background-color: #334155;
            color: white;
            border-left-color: #3b82f6;
            font-weight: 600;
        }
        
        /* Footer Sidebar (Logo BPS) */
        .sidebar-footer {
            padding: 18px;
            border-top: 1px solid #334155;
            text-align: center;
        }
        .sidebar-footer img { width: 44px; height: auto; margin-bottom: 8px; display: inline-block; }
        .sidebar-footer p { font-size: 0.7rem; color: #94a3b8; font-weight: 600; line-height: 1.3; }

        /* Main Wrapper */
        .main-wrapper { flex: 1; display: flex; flex-direction: column; overflow: hidden; min-width: 0; }
        
        /* Header Styling */
        .header {
            height: 68px;
            background-color: #1e293b;
            border-bottom: 1px solid #334155;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            color: white;
            flex-shrink: 0;
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-title { font-size: 1.15rem; font-weight: 600; letter-spacing: 0.3px; }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .user-tag {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            text-align: right;
        }
        .user-name { font-size: 0.88rem; font-weight: 600; color: #f8fafc; }
        .user-role { font-size: 0.72rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; }

        .btn-logout {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.82rem;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .btn-logout:hover { background-color: #dc2626; }
        .btn-logout svg { width: 15px; height: 15px; }
        
        .content { padding: 32px; overflow-y: auto; flex: 1; background-color: #f8fafc; }

        /* Flash Message Alerts */
        .alert-flash {
            padding: 12px 18px;
            border-radius: 8px;
            font-size: 0.88rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .alert-flash-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }
        .alert-flash-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }
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
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dashboard
                </a>
                
                <!-- Kelola Pengguna -->
                <a href="{{ route('pengguna.index') }}" class="menu-item {{ request()->routeIs('pengguna.index') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Kelola Pengguna
                </a>

                <!-- Kelola Teknis -->
                <a href="{{ route('teknis.index') }}" class="menu-item {{ request()->routeIs('teknis.index') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.223.492-.492a2.652 2.652 0 1 0-3.75-3.75l-.492.492m3.75 3.75-3.75-3.75" />
                    </svg>
                    Kelola Teknis
                </a>

                <!-- Kelola Survei -->
                <a href="{{ route('survei.index') }}" class="menu-item {{ request()->routeIs('survei.index') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    Kelola Survei
                </a>

                <!-- Laporan -->
                <a href="{{ route('laporan.index') }}" class="menu-item {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Laporan
                </a>

                <!-- Cetak -->
                <a href="{{ route('cetak.index') }}" class="menu-item {{ request()->routeIs('cetak.index') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.656h10.5Z" />
                    </svg>
                    Cetak
                </a>

                <!-- Info BPS -->
                <a href="{{ route('info.index') }}" class="menu-item {{ request()->routeIs('info.index') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    Info BPS
                </a>
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
            <div class="header-left">
                <div class="header-title">Dashboard Admin</div>
            </div>
            
            <div class="header-right">
                <div class="user-tag">
                    <span class="user-name">{{ Auth::user()->name ?? 'Admin BPS' }}</span>
                    <span class="user-role">{{ Auth::user()->jabatan ?? 'Administrator' }}</span>
                </div>

                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout" title="Keluar dari sistem">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </header>
        
        <main class="content">
            @if(session('success'))
                <div class="alert-flash alert-flash-success">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-flash alert-flash-error">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>