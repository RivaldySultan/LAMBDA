<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LAMBDA BPS Kota Sukabumi</title>
    
    <!-- Menggunakan Font Montserrat untuk tampilan yang lebih mirip dengan BPS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Memanggil FontAwesome untuk icon user dan gembok -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            /* Mengatur background menggunakan gambar gedung BPS */
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('images/kantor-bps-kota-sukabumi_169.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background-color: white;
            border-radius: 15px;
            padding: 40px 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .logo-container {
            margin-bottom: 15px;
        }

        .logo-container img {
            width: 80px; /* Sesuaikan ukuran logo BPS */
            height: auto;
        }

        .card-header h2 {
            font-size: 14px;
            color: #555;
            font-weight: 600;
            text-transform: uppercase;
            line-height: 1.4;
            margin-bottom: 5px;
        }

        .card-header h1 {
            font-size: 22px;
            color: #2c3e50; /* Warna biru gelap / abu-abu gelap */
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .card-header p {
            font-size: 12px;
            color: #777;
            margin-bottom: 30px;
        }

        /* Styling untuk grup input dengan icon */
        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 14px;
        }

        /* Styling input Username (Border outline) */
        .input-outline {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid #4cd137; /* Warna hijau outline */
            border-radius: 8px;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: all 0.3s;
        }
        
        .input-outline:focus {
            box-shadow: 0 0 0 2px rgba(76, 209, 55, 0.2);
        }

        /* Styling input Password (Background solid) */
        .input-solid {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: none;
            background-color: #f1f2f6; /* Warna abu-abu terang */
            border-radius: 8px;
            font-size: 14px;
            color: #333;
            outline: none;
        }

        .input-solid:focus {
            background-color: #e8e9ed;
        }

        /* Styling Tombol Login */
        .btn-login {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background-color: #4cd137; /* Warna hijau cerah */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #44bd32;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('images/logo.webp')}}"alt="Logo BPS">
        </div>
        
        <div class="card-header">
            <h2>BADAN PUSAT STATISTIK<br>KOTA SUKABUMI</h2>
            <h1>LAMBDA</h1>
            <p>Aplikasi Pelaporan Harian</p>
        </div>

        <form action="/dashboard">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" class="input-outline" placeholder="Username/NIP" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" class="input-solid" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

</body>
</html>