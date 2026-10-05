<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Monitoring Perjalanan Dinas</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; height: 100vh; background-color: #f8fafc; }
        
        /* Bagian Kiri - Branding */
        .login-banner {
            flex: 1;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px;
        }
        .login-banner h1 { font-size: 2.5rem; margin-bottom: 15px; }
        .login-banner p { font-size: 1.1rem; opacity: 0.9; line-height: 1.6; }
        
        /* Bagian Kanan - Form */
        .login-form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
        }
        .login-box { width: 100%; max-width: 400px; padding: 40px; }
        .login-box h2 { color: #0f172a; margin-bottom: 8px; font-size: 1.8rem; }
        .login-box p.subtitle { color: #64748b; margin-bottom: 30px; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #334155; font-weight: 500; font-size: 0.9rem; }
        .form-control {
            width: 100%; padding: 12px 16px;
            border: 1px solid #cbd5e1; border-radius: 8px;
            font-size: 1rem; transition: all 0.2s;
        }
        .form-control:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        
        .btn-primary {
            width: 100%; padding: 12px;
            background-color: #2563eb; color: white;
            border: none; border-radius: 8px;
            font-size: 1rem; font-weight: 600;
            cursor: pointer; transition: background 0.2s;
            margin-top: 10px;
        }
        .btn-primary:hover { background-color: #1d4ed8; }
    </style>
</head>
<body>
    <div class="login-banner">
        <h1>LAMBDA</h1>
        <p>Sistem Monitoring Berbasis Data Perjalanan Dinas.<br>Kelola laporan, survei, dan data teknis secara efisien.</p>
    </div>
    <div class="login-form-container">
        <div class="login-box">
            <h2>Selamat Datang</h2>
            <p class="subtitle">Silakan masuk ke akun Anda</p>
            
            <!-- Form statis (tanpa backend) -->
            <form action="/dashboard">
                <div class="form-group">
                    <label>Email Instansi</label>
                    <input type="email" class="form-control" placeholder="nama@instansi.go.id" required>
                </div>
                <div class="form-group">
                    <label>Kata Sandi</label>
                    <input type="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-primary">Masuk ke Dashboard</button>
            </form>
        </div>
    </div>
</body>
</html>