@extends('layout_landingpage')

@section('title', 'Daftar Fasilitas')

@section('content')

    <title>Sejarah Pondok Pesantren Al-Ihsan</title>
    <style>
        /* Unique CSS Variables */
        :root {
            --pesantren-primary: #1a5f7a;
            --pesantren-secondary: #159895;
            --pesantren-accent: #ffc900;
            --pesantren-light: #f9f9f9;
            --pesantren-dark: #002b36;
        }

        /* Reset with Unique Prefix */
        .pesantren-reset {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Nunito Sans', sans-serif;
        }

        /* Body Styles */
        .pesantren-body {
            background-color: var(--pesantren-light);
            color: var(--pesantren-dark);
            line-height: 1.7;
            scroll-behavior: smooth;
        }

        /* Header with Parallax Effect */
        .pesantren-header {
            background: linear-gradient(rgba(0, 68, 69, 0.8), rgba(0, 68, 69, 0.8)),
                url('/landing_assets/img/header-pondok.jpg');
            background-size: cover;
            background-position: center;
            height: 75vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 2rem;
            position: relative;
            overflow: hidden;
        }

        .pesantren-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            /* background: linear-gradient(to top, var(--pesantren-light), transparent); */
        }

        .pesantren-logo {
            width: 150px;
            margin-bottom: 2rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
            animation: pesantren-float 3s ease-in-out infinite;
        }

        @keyframes pesantren-float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .pesantren-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            margin-bottom: 1.5rem;
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
            font-weight: 800;
            letter-spacing: 1px;
        }

        .pesantren-subtitle {
            font-size: clamp(1rem, 2vw, 1.5rem);
            max-width: 800px;
            margin-bottom: 3rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 300;
        }

        /* Navigation */
        .pesantren-navbar {
            background-color: var(--pesantren-dark);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .pesantren-nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.2rem 2rem;
        }

        .pesantren-nav-logo {
            height: 50px;
        }

        .pesantren-nav-menu {
            display: flex;
            list-style: none;
        }

        .pesantren-nav-item {
            margin-left: 2.5rem;
            position: relative;
        }

        .pesantren-nav-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
        }

        .pesantren-nav-link:hover {
            color: var(--pesantren-accent);
        }

        .pesantren-nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--pesantren-accent);
            transition: width 0.3s ease;
        }

        .pesantren-nav-link:hover::after {
            width: 100%;
        }

        /* Main Content */
        .pesantren-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 5rem 2rem;
        }

        .pesantren-section {
            margin-bottom: 6rem;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .pesantren-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .pesantren-section-title {
            font-size: 2.8rem;
            color: var(--pesantren-primary);
            margin-bottom: 3rem;
            position: relative;
            display: inline-block;
            font-weight: 700;
        }

        .pesantren-section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            width: 70px;
            height: 5px;
            background-color: var(--pesantren-accent);
            border-radius: 3px;
        }

        /* Timeline */
        .pesantren-timeline {
            position: relative;
            max-width: 1000px;
            margin: 4rem auto;
            padding-left: 50px;
        }

        .pesantren-timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 30px;
            width: 4px;
            background: linear-gradient(to bottom,
                    var(--pesantren-secondary),
                    var(--pesantren-accent));
            border-radius: 2px;
        }

        .pesantren-timeline-item {
            position: relative;
            margin-bottom: 3rem;
            padding-left: 60px;
        }

        .pesantren-timeline-year {
            position: absolute;
            left: 0;
            top: 0;
            width: 60px;
            height: 60px;
            background-color: var(--pesantren-secondary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .pesantren-timeline-content {
            background-color: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .pesantren-timeline-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .pesantren-timeline-content::before {
            content: '';
            position: absolute;
            top: 24px;
            left: -15px;
            width: 30px;
            height: 30px;
            background-color: white;
            transform: rotate(45deg);
            box-shadow: -5px 5px 10px rgba(0, 0, 0, 0.05);
        }

        .pesantren-timeline-title {
            font-size: 1.5rem;
            color: var(--pesantren-primary);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        /* Founder Section */
        .pesantren-founder {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 4rem;
            align-items: center;
            margin-top: 4rem;
        }

        .pesantren-founder-img {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            aspect-ratio: 1/1;
        }

        .pesantren-founder-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .pesantren-founder-img:hover img {
            transform: scale(1.05);
        }

        .pesantren-founder-quote {
            font-style: italic;
            font-size: 1.2rem;
            color: var(--pesantren-secondary);
            padding: 1.5rem;
            border-left: 4px solid var(--pesantren-accent);
            background-color: rgba(255, 201, 0, 0.1);
            border-radius: 0 8px 8px 0;
            margin: 2rem 0;
        }

        /* Gallery */
        .pesantren-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 3rem;
        }

        .pesantren-gallery-item {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            aspect-ratio: 4/3;
        }

        .pesantren-gallery-item:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .pesantren-gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .pesantren-gallery-item:hover .pesantren-gallery-img {
            transform: scale(1.1);
        }

        .pesantren-gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            color: white;
            padding: 2rem 1.5rem 1.5rem;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .pesantren-gallery-item:hover .pesantren-gallery-caption {
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .pesantren-founder {
                grid-template-columns: 1fr;
            }

            .pesantren-founder-img {
                max-width: 400px;
                margin: 0 auto;
            }
        }

        @media (max-width: 768px) {
            .pesantren-nav-menu {
                display: none;
            }

            .pesantren-timeline {
                padding-left: 30px;
            }

            .pesantren-timeline::before {
                left: 15px;
            }

            .pesantren-timeline-item {
                padding-left: 45px;
            }

            .pesantren-timeline-year {
                width: 50px;
                height: 50px;
                font-size: 1rem;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>

    <body class="pesantren-body pesantren-reset">
        <header class="pesantren-header">
            <img src="/landing_assets/img/logo_pondok.png" alt="Logo Pondok" class="pesantren-logo">
            <h1 class="pesantren-title">Sejarah Pondok Pesantren Darul Muttaqien</h1>
            <p class="pesantren-subtitle">Mencetak Kader Bangsa Yang Berlandaskan Wawasan Dan Pengetahuan Ke-Islaman</p>
        </header>

        <main class="pesantren-container">
            <section id="sejarah" class="pesantren-section">
                <h2 class="pesantren-section-title">Kilas Sejarah</h2>
                <p>Pondok Pesantren Darul Muttaqien telah menjadi bagian penting dalam perjalanan pendidikan Islam di
                    Kabupaten Ogan Komering Ilir,
                    yang secara konsisten membentuk karakter santri melalui pendidikan berbasis nilai keislaman,
                    kecendekiaan, dan kepemimpinan. Dengan pengalaman panjang dan dedikasi yang tinggi,
                    Darul Muttaqien hadir sebagai pilar dalam melahirkan generasi penerus yang berilmu, berintegritas, serta
                    siap menghadapi tantangan modern.</p>

                <div class="pesantren-timeline">
                    <div class="pesantren-timeline-item">
                        <div class="pesantren-timeline-year">1988</div>
                        <div class="pesantren-timeline-content">
                            <h3 class="pesantren-timeline-title">Masa Pendirian</h3>
                            <p>Didirikan oleh KH. Muhammad Daud Denin, BA. pada tahun 1988 diawali pengajian dan majlis
                                ta'lim yang seiring berjalannya waktu memeiliki banyak santri dan mengundang minat
                                masyarakat luas untuk memperdalam ilmu agama,
                                maka oleh karena itulah menjadi pondasi awal berdirinya Pondok Pesantren Darul Muttaqien
                                ini.</p>
                        </div>
                    </div>

                    <div class="pesantren-timeline-item">
                        <div class="pesantren-timeline-year">1989</div>
                        <div class="pesantren-timeline-content">
                            <h3 class="pesantren-timeline-title">Ekspansi Pertama</h3>
                            <p>Pembangunan gedung madrasah pertama diatas tanah wakaf seluas 1.468 m2 yang dihibahkan orang
                                tua beliau
                                yakni H.Denin sebagai sarana dalam menjalankan proses
                                belajar mengajar.</p>
                        </div>
                    </div>

                    <div class="pesantren-timeline-item">
                        <div class="pesantren-timeline-year">1994</div>
                        <div class="pesantren-timeline-content">
                            <h3 class="pesantren-timeline-title">Transformasi Pendidikan</h3>
                            <p>Dari pengajian dan majlis ta'lim menjadi pendidikan yang terstruktur dengan terbentuknya
                                Madrasah Tsanawiyah pada tahun 1994, dan membuka TK/TPA pada tahun 1996, Madrasah Aliyah
                                pada tahun 1997, dan Madrasah Diniyah pada tahun 1997.
                            </p>
                        </div>
                    </div>

                    <div class="pesantren-timeline-item">
                        <div class="pesantren-timeline-year">2018</div>
                        <div class="pesantren-timeline-content">
                            <h3 class="pesantren-timeline-title">Perluasan Jenjang</h3>
                            <p>Penambahan jenjang baru yakni trbentuknya SD Islam Darul Muttaqien pada tahun 2018.
                            </p>
                        </div>
                    </div>

                    <div class="pesantren-timeline-item">
                        <div class="pesantren-timeline-year">2023</div>
                        <div class="pesantren-timeline-content">
                            <h3 class="pesantren-timeline-title">Generasi Kedua</h3>
                            <p>KH. Muhammad Daud Denin, BA. wafat pada tanggal 21 Oktober 2023 M / 6 Rabiul Akhir 1444 H.
                                dan
                                kepemimpinan diteruskan oleh putra keduanya, yakni Kiayi Husni Moebarok Al-hafidz S.Pd yang
                                lebih mendalam menekankan untuk para santri menjadi penghapal Al-Qur'an.</p>
                        </div>
                    </div>

            </section>

            <section id="pendiri" class="pesantren-section">
                <h2 class="pesantren-section-title">Sang Pendiri</h2>
                <p>KH. Muhammad Daud Denin, BA. (1950-2023) adalah tokoh besar yang telah memberikan dedikasinya secara
                    penuh dalam dunia pendidikan dan dakwah, di Kabupaten OKI khususnya di lingkungan Pondok Pesantren Darul
                    Muttaqien.</p>

                <div class="pesantren-founder">
                    <div class="pesantren-founder-img">
                        <img src="/landing_assets/img/foto_ustd.jpg" alt="KH. Muhammad Daud Denin, BA.">
                    </div>
                    <div>
                        <h3 style="font-size: 1.8rem; color: var(--pesantren-primary); margin-bottom: 1.5rem;">Biografi
                            Singkat</h3>
                        <p>Lahir di Desa Muara Baru, KH. Muhammad Daud Denin, BA. menimba ilmu di berbagai pesantren ternama
                            di Sumatera dan
                            Jawa sebelum mendirikan Pondok Pesantren Darul Muttaqien. Beliau dikenal dengan pendekatan
                            tasawuf dalam pendidikan
                            dan kedalaman ilmunya dalam bidang fiqh dan tafsir.</p>

                        <div class="pesantren-founder-quote">
                            "Pendidikan yang hakiki adalah yang mampu menyentuh hati, mencerahkan akal, dan menggerakkan
                            tangan untuk beramal."
                        </div>

                        <h3 style="font-size: 1.5rem; color: var(--pesantren-primary); margin: 2rem 0 1rem;">Visi Pendidikan
                        </h3>
                        <p>KH. Muhammad Daud Denin, BA. meletakkan tiga pilar pendidikan: <strong>Iman yang Kokoh</strong>,
                            <strong>Ilmu
                                yang Bermanffat</strong>, dan <strong>Akhlak yang Mulia</strong>. Beliau percaya bahwa
                            pendidikan harus membentuk manusia yang bermanfaat bagi agama dan bangsa.
                        </p>
                    </div>
                </div>
            </section>

            {{-- <section id="galeri" class="pesantren-section">
                <h2 class="pesantren-section-title">Galeri Pesantren</h2>
                <p>Dokumentasi visual perjalanan panjang Pondok Pesantren Al-Ihsan dari masa ke masa.</p>

                <div class="pesantren-gallery">
                    <div class="pesantren-gallery-item">
                        <img src=".jpg" alt="Pondok Tahun 1950an" class="pesantren-gallery-img">
                        <div class="pesantren-gallery-caption">Bangunan pertama tahun 1955</div>
                    </div>

                    <div class="pesantren-gallery-item">
                        <img src="kegiatan-santri.jpg" alt="Kegiatan Santri" class="pesantren-gallery-img">
                        <div class="pesantren-gallery-caption">Belajar di serambi masjid (1960)</div>
                    </div>

                    <div class="pesantren-gallery-item">
                        <img src="masjid-pondok.jpg" alt="Masjid Pesantren" class="pesantren-gallery-img">
                        <div class="pesantren-gallery-caption">Masjid Jami' Al-Ihsan (1975)</div>
                    </div>

                    <div class="pesantren-gallery-item">
                        <img src="perpus-pondok.jpg" alt="Perpustakaan" class="pesantren-gallery-img">
                        <div class="pesantren-gallery-caption">Perpustakaan modern (2005)</div>
                    </div>

                    <div class="pesantren-gallery-item">
                        <img src="asrama-baru.jpg" alt="Asrama Baru" class="pesantren-gallery-img">
                        <div class="pesantren-gallery-caption">Asrama baru (2018)</div>
                    </div>

                    <div class="pesantren-gallery-item">
                        <img src="kegiatan-ekstra.jpg" alt="Kegiatan Ekstrakurikuler" class="pesantren-gallery-img">
                        <div class="pesantren-gallery-caption">Kegiatan ekstrakurikuler santri</div>
                    </div>
                </div>
            </section> --}}
        </main>

        <script>
            // Animation for scroll reveal
            document.addEventListener('DOMContentLoaded', function() {
                const sections = document.querySelectorAll('.pesantren-section');

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                }, {
                    threshold: 0.1
                });

                sections.forEach(section => {
                    observer.observe(section);
                });

                // Smooth scrolling for navigation
                document.querySelectorAll('.pesantren-nav-link').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        e.preventDefault();

                        const targetId = this.getAttribute('href');
                        const targetElement = document.querySelector(targetId);

                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    });
                });
            });
        </script>
    </body>
@endsection
