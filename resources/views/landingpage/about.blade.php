<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>About - Bimbingan Konseling SMKN 1 Cirebon</title>
    <meta name="description" content="Tentang Sistem Bimbingan Konseling SMKN 1 Cirebon" />
    <meta name="keywords" content="About, Bimbingan Konseling, SMKN 1 Cirebon" />

    <link href="{{ asset('landing-page/img/logo.png') }}" rel="icon" />
    <link href="{{ asset('landing-page/img/logo.png') }}" rel="apple-touch-icon" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('layout.partials.head')
    @stack('styles')

    <style>
        body {
            background: url('/assets/img/bg-nis.png') no-repeat center center fixed;
            background-size: cover;
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
        .about-content {
            margin: 150px auto 50px;
            max-width: 900px;
            padding: 60px;
            text-align: left;
            background-color: #f9f9f9;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .about-content h2 {
            font-size: 32px;
            font-weight: 700;
            color: #4a4a4a;
            margin-bottom: 30px;
            text-align: center;
        }

        .about-content p {
            font-size: 17px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .about-content ul {
            list-style-type: disc;
            margin-left: 30px;
            margin-bottom: 20px;
        }

        .about-content li {
            font-size: 17px;
            color: #555;
            line-height: 1.8;
        }

        .about-content .team-member {
            text-align: center;
            margin-top: 40px;
        }

        .about-content .team-member img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .about-content .team-member h3 {
            font-size: 22px;
            font-weight: 600;
            color: #4a4a4a;
            margin-bottom: 8px;
        }

        .about-content .team-member p {
            font-size: 16px;
            color: #777;
        }

        .about-content .features {
            margin-top: 30px;
        }

        .about-content .features h3 {
            font-size: 24px;
            font-weight: 600;
            color: #4a4a4a;
            margin-bottom: 15px;
        }

        .about-content .features ul {
            margin-left: 30px;
        }

        .about-content .features li {
            font-size: 17px;
            color: #555;
            line-height: 1.8;
        }

        .back-button {
            text-align: right;
            margin-top: 30px;
        }

        .back-button a {
            background-color: #bfa2db;
            color: white;
            padding: 10px 20px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.5s;
        }

        .back-button a:hover {
            background-color: #624e88;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #666;
            background-color: #FBFBFB;
            width: 100%;
        }

        .footer .sitename {
            font-weight: bold;
        }

        @media(max-width: 480px) {
            main {
                padding: 20px;
            }
            .logo h1 {
                font-size: 15px;
            }
            .logo img {
                height: 25px;
            }
            .header {
                padding: 20px 20px;
            }
            .link-about {
                font-size: 14px;
            }
            .btn-login{
                font-size: 12px;
                padding: 8px 10px;
            }
            .about-content {
                padding: 42px;
            }
            .about-content h2 {
                font-size: 20px;
            }
            .about-content p {
                font-size: 15px;
            }
            .about-content .features h3 {
                font-size: 17px;
            }
            .about-content .features li {
                font-size: 15px;
            }
            .back-button a {
                font-size: 12px;
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
            <a class="link-about me-4" href="{{ route('index') }}">Home</a> 
        </div>
        <div class="login">
            <a class="btn-login" href="{{ route('login') }}">Login</a>
        </div>
        
        
    </header>
<body>
    <main class="main">
        <section class="about-content">
            <h2>Tentang Bimbingan Konseling SMKN 1 Cirebon</h2>
            <p>
                Sistem Bimbingan Konseling SMKN 1 Cirebon hadir sebagai solusi digital untuk mempermudah siswa dalam mengakses layanan bimbingan konseling. Kami memahami pentingnya dukungan dan bimbingan dalam perkembangan akademik dan pribadi siswa, oleh karena itu kami menciptakan platform ini agar proses pengajuan dan pemantauan jadwal konseling menjadi lebih efisien dan transparan.
            </p>

            <div class="features">
                <h3>Fitur Utama</h3>
                <ul>
                    <li><strong>Pengajuan Jadwal Online:</strong> Siswa dapat mengajukan jadwal bimbingan konseling kapan saja dan di mana saja melalui platform ini.</li>
                    <li><strong>Pengecekan Status Real-time:</strong> Pantau status pengajuan Anda dengan mudah dan dapatkan informasi terkini.</li>
                    <li><strong>Informasi Terstruktur:</strong> Akses informasi penting mengenai layanan bimbingan konseling dan sumber daya yang tersedia.</li>
                    <li><strong>Komunikasi Efektif:</strong> Platform ini memfasilitasi komunikasi yang lebih baik antara siswa dan guru BK.</li>
                </ul>
            </div>

            <p>
                Kami berkomitmen untuk menyediakan lingkungan yang mendukung dan membantu siswa dalam mencapai potensi maksimal mereka. Dengan sistem ini, kami berharap dapat meningkatkan efektivitas layanan bimbingan konseling dan memberikan dampak positif bagi seluruh siswa SMKN 1 Cirebon.
            </p>

            <div class="back-button">
                <a href="{{ route('index') }}"><i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Utama</a>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer">
        <div class="container">
            <p>© Copyright <strong class="sitename">Bimbingan Konseling</strong> All Rights Reserved</p>
        </div>
    </footer>

    <div id="preloader"></div>
    @include('layout.partials.footer-scripts')
    @stack('scripts')
</body>
</html>