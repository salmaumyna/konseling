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
            text-align: center;
            margin-top: 20px;
        }

        .back-button a {
            background-color: #624e88;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.5s;
        }

        .back-button a:hover {
            background-color: #7F669D;
        }
    </style>
</head>
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
                <a href="{{ route('index') }}">Kembali ke Halaman Utama</a>
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