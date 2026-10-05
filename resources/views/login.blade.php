<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LAMBDA BPS Kota Sukabumi</title>
    
    <!-- Menggunakan Font Montserrat untuk tampilan resmi BPS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-image: linear-gradient(rgba(15, 23, 42, 0.72), rgba(15, 23, 42, 0.72)), url('{{ asset('images/kantor-bps-kota-sukabumi_169.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-card {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 40px 32px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        .logo-container {
            margin-bottom: 16px;
        }

        .logo-container img {
            width: 76px;
            height: auto;
            display: inline-block;
        }

        .card-header h2 {
            font-size: 13px;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            line-height: 1.5;
            margin-bottom: 6px;
        }

        .card-header h1 {
            font-size: 24px;
            color: #0f172a;
            font-weight: 700;
            margin-bottom: 4px;
            letter-spacing: 1.5px;
        }

        .card-header p {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 24px;
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            margin-bottom: 18px;
            text-align: left;
            line-height: 1.4;
        }

        .alert-status {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            margin-bottom: 18px;
            text-align: left;
            line-height: 1.4;
        }

        /* Styling untuk grup input dengan icon SVG */
        .input-group {
            position: relative;
            margin-bottom: 16px;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            pointer-events: none;
        }

        .input-icon svg {
            width: 18px;
            height: 18px;
        }

        /* Styling input Username (Border outline) */
        .input-outline {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid #22c55e;
            border-radius: 8px;
            font-size: 14px;
            color: #0f172a;
            background-color: #ffffff;
            outline: none;
            transition: all 0.2s;
        }
        
        .input-outline:focus {
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
            border-color: #16a34a;
        }

        /* Styling input Password (Background solid) */
        .input-solid {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid #e2e8f0;
            background-color: #f8fafc;
            border-radius: 8px;
            font-size: 14px;
            color: #0f172a;
            outline: none;
            transition: all 0.2s;
        }

        .input-solid:focus {
            background-color: #ffffff;
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.15);
        }

        /* Styling Tombol Login */
        .btn-login {
            width: 100%;
            padding: 13px;
            margin-top: 8px;
            background-color: #22c55e;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }

        .btn-login:hover {
            background-color: #16a34a;
        }

        .btn-login:active {
            transform: translateY(1px);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('images/logo.webp') }}" alt="Logo BPS" onerror="this.src='{{ asset('images/logo-bps.png') }}'">
        </div>
        
        <div class="card-header">
            <h2>BADAN PUSAT STATISTIK<br>KOTA SUKABUMI</h2>
            <h1>LAMBDA</h1>
            <p>Aplikasi Pelaporan Harian</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert-status">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="input-group">
                <span class="input-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </span>
                <input type="text" name="login" class="input-outline" placeholder="Username / NIP" value="{{ old('login') }}" required autofocus>
            </div>

            <div class="input-group">
                <span class="input-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </span>
                <input type="password" name="password" class="input-solid" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

</body>
</html>