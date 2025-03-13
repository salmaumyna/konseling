<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Bimbingan Konseling SMKN 1 Cirebon</title>
    <meta
      name="description"
      content="Sistem Akademik PPLG SMKN 1 Cirebon - Platform manajemen akademik yang dilengkapi dengan fitur pengajuan izin dan absensi siswa secara digital untuk memudahkan pencatatan kehadiran dan perizinan siswa"
    />
    <meta
      name="keywords"
      content="Sistem Akademik, PPLG, SMKN 1 Cirebon, Manajemen Akademik, Absensi, Izin, Digital, Pencatatan, Kehadiran, Perizinan"
    />

    <!-- Favicons -->
    <link href="{{ asset('landing-page/img/logo.png') }}" rel="icon" />
    <link href="{{ asset('landing-page/img/logo.png') }}" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @include('layout.partials.head')
    @stack('styles')

    <style>
    html, body {
        background-color: #f8fafc;
        text-align: center;
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }

    /* Header */
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 50px;
        background-color: #F5EFFF;
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .logo {
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .logo img {
        height: 40px;
        margin-right: 10px;
    }

    .logo h1 {
        font-size: 22px;
        font-weight: 600;
        color: #624e88;
        margin: 0;
    }

    /* Login Button */
    .btn-login {
        background-color: #624e88;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        cursor: pointer;
        font-weight: 500;
        text-decoration: none;
        transition: 0.5s;
    }

    .btn-login:hover {
        background-color: #7F669D;
    }

    .link-about {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        font-size: 16px;
        position: relative;
        transition: color 0.3s ease-in-out;
        padding: 5px 0;
        display: inline-block;
        overflow: hidden;
    }

    .link-about::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 0;
        height: 2px;
        background: #624e88;
        transition: all 0.3s ease-in-out;
        transform: translateX(-50%);
    }

    .link-about:hover {
        color: #624e88;
    }

    .link-about:hover::after {
        width: 100%;
    }

    /* Hero Section */
    .hero {
        margin-top: 120px;
    }

    .hero h1 {
        font-size: 36px;
        font-weight: bold;
        color: #333;
    }

    .hero span {
        color: #624e88;
    }

    .hero p {
        font-size: 18px;
        color: #666;
    }

    /* Card Container */
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 80px;
        margin: 40px auto;
        max-width: 800px;
    }

    .card {
        background: #F4EEFF;
        border-radius: 10px;
        padding: 20px;
        width: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;

    }

    .card i {
        font-size: 40px;
        color: #624e88;
        margin-bottom: 10px;
    }

    .card h3 {
        font-size: 18px;
        font-weight: 600;
    }

    .card p {
        font-size: 14px;
        color: #666;
    }

    .card a {
        color: #624e88;
        font-weight: 500;
        text-decoration: none;
        display: block;
        margin-top: 10px;
    }

    .card a:hover {
        text-decoration: underline;
    }

    .card .card-header {
        width: 70px;
        border: 2px solid #624e88;
        border-radius: 5px;
        margin-bottom: 20px;
        background-color: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Footer */
    .footer {
        text-align: center;
        padding: 20px 20px 0px 20px;
        font-size: 14px;
        color: #666;
        width: 100%;
    }

    .footer .sitename {
        font-weight: bold;
    }

    @media (max-width: 430px) {
        .header {
            padding: 20px 20px;
        }
        .logo img {
            height: 30px;
        }
        .logo h1 {
            font-size: 16px;
        }
        .btn-login {
            padding: 5px 10px;
            font-size: 13px;
        }
        .card-container {
            gap: 30px;
        }
        .hero h1 {
            font-size: 25px;
        }
        .hero p {
            font-size: 15px;
        }
    }
    @media (max-width: 1200px) {
        .header {
            padding: 24px 50px;
        }
        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hero {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
            margin-top: 20px;
        }  
    }

    </style>
  </head>

    <header id="header" class="header">
        <div class="container">
            <a href="index.html" class="logo">
                <img src="{{ url('assets/img/logo-saja.png') }}" alt="Logo" />
                <h1 class="sitename">Bimbingan Konseling</h1>
            </a>
        </div>
        <div class="about">
            <a class="link-about me-4" href="{{ route('about') }}">About</a> 
        </div>
        <div class="login">
            <a class="btn-login" href="{{ route('login') }}">Login</a>
        </div>
        
        
    </header>

    <!-- Hero Section -->
    <main class="main">
        <section id="hero" class="hero">
            <div class="container text-center">
                <h1>Selamat Datang di <br><span>Bimbingan Konseling</span></h1>
                <p>SMKN 1 Cirebon</p>
            </div>
        </section>

        <!-- Card Container -->
        <section class="card-container">
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-2x fa-clipboard-list"></i></div>
                <h3>Pengajuan Izin</h3>
                <p>Form pengajuan jadwal bimbingan konseling</p>
                <a href="{{ route('counseling.nis') }}">Lakukan Pengajuan →</a>
            </div>

            <div class="card">
                <div class="card-header"><i class="fa-solid fa-2x fa-clipboard-check"></i></div>
                <h3>Cek Status Izin</h3>
                <p>Form untuk mengecek status pengajuan izin</p>
                <a href="{{ route('counseling.status.form') }}">Cek Status Pengajuan →</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer id="footer" class="footer">
        <div class="container">
            <p>© Copyright <strong class="sitename">Bimbingan Konseling</strong> All Rights Reserved</p>
        </div>
    </footer>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    @include('layout.partials.footer-scripts')
    @stack('scripts')

  </body>
</html>