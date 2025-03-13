<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pon-Pes Darul Muttaqien</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Pondok Pesantren Darul Muttaqien, Pendidikan Islam, Generasi Qur'ani" name="keywords">
    <meta
        content="Pondok Pesantren Darul Muttaqien adalah lembaga pendidikan Islam yang berkomitmen mencetak generasi Qur'ani."
        name="description">

    <!-- Favicon -->
    <img href="/landing_assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="icon" type="image/png" href="/assets/img/logo_pondok.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="/landing_assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/landing_assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/landing_assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/landing_assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid bg-dark text-white py-2 shadow-lg">
        <div class="d-flex justify-content-between align-items-center flex-wrap position-relative w-100">
            <!-- Jam (Kiri) -->
            <div id="liveClock" class="fw-bold date-time"></div>

            <!-- Teks Berjalan (Tengah) -->
            <div class="scrolling-container">
                <div class="scrolling-text">
                    <span class="char">P</span>
                    <span class="char">o</span>
                    <span class="char">n</span>
                    <span class="char">d</span>
                    <span class="char">o</span>
                    <span class="char">k</span>
                    <span class="char">&nbsp;</span>
                    <span class="char">P</span>
                    <span class="char">e</span>
                    <span class="char">s</span>
                    <span class="char">a</span>
                    <span class="char">n</span>
                    <span class="char">t</span>
                    <span class="char">r</span>
                    <span class="char">e</span>
                    <span class="char">n</span>
                    <span class="char">&nbsp;</span>
                    <span class="char">D</span>
                    <span class="char">a</span>
                    <span class="char">r</span>
                    <span class="char">u</span>
                    <span class="char">l</span>
                    <span class="char">&nbsp;</span>
                    <span class="char">M</span>
                    <span class="char">u</span>
                    <span class="char">t</span>
                    <span class="char">t</span>
                    <span class="char">a</span>
                    <span class="char">q</span>
                    <span class="char">i</span>
                    <span class="char">e</span>
                    <span class="char">n</span>
                    <span class="char">&nbsp;</span>
                    <span class="char">-</span>
                    <span class="char">&nbsp;</span>
                    <span class="char">M</span>
                    <span class="char">e</span>
                    <span class="char">n</span>
                    <span class="char">c</span>
                    <span class="char">e</span>
                    <span class="char">t</span>
                    <span class="char">a</span>
                    <span class="char">k</span>
                    <span class="char">&nbsp;</span>
                    <span class="char">G</span>
                    <span class="char">e</span>
                    <span class="char">n</span>
                    <span class="char">e</span>
                    <span class="char">r</span>
                    <span class="char">a</span>
                    <span class="char">s</span>
                    <span class="char">i</span>
                    <span class="char">&nbsp;</span>
                    <span class="char">Q</span>
                    <span class="char">u</span>
                    <span class="char">r</span>
                    <span class="char">'</span>
                    <span class="char">a</span>
                    <span class="char">n</span>
                    <span class="char">i</span>
                </div>
            </div>

            <!-- Tanggal (Kanan) -->
            <div id="liveDate" class="fw-bold date-time"></div>
        </div>
    </div>

    <script>
        function updateClockAndDate() {
            const now = new Date();

            // Format Waktu (24 jam)
            let hours = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            let seconds = now.getSeconds().toString().padStart(2, '0');

            let timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById("liveClock").textContent = timeString;

            // Format Hari dan Tanggal
            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                "Oktober", "November", "Desember"
            ];

            let day = days[now.getDay()];
            let date = now.getDate();
            let month = months[now.getMonth()];
            let year = now.getFullYear();

            let dateString = `${day}, ${date} ${month} ${year}`;
            document.getElementById("liveDate").textContent = dateString;
        }

        // Perbarui setiap detik
        setInterval(updateClockAndDate, 1000);
        updateClockAndDate();
    </script>

    <style>
        /* Efek Spinner */
        #spinner {
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
        }

        /* Teks Jam dan Tanggal */
        .date-time {
            background: linear-gradient(45deg, #ffcc00, #d4af37, #b8860b);
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 1rem;
            color: #fff;
            text-shadow: 0 0 8px rgba(255, 204, 0, 0.8);
        }

        /* Efek Scrolling Teks */
        .scrolling-container {
            width: 80%;
            overflow: hidden;
            position: relative;
        }

        .scrolling-text {
            display: inline-block;
            white-space: nowrap;
            animation: scrollText 10s linear infinite;
        }

        .scrolling-text .char {
            display: inline-block;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            opacity: 0;
            animation: fadeInOut 0.5s forwards;
        }

        @keyframes scrollText {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateX(20px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Bayangan lembut untuk header */
        .container-fluid {
            font-size: 16px;
            box-shadow: 0 2px 10px rgba(255, 204, 0, 0.4);
        }
    </style>

    <!-- Header -->
    @include('header')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=Poppins:wght@600&display=swap');

        /* Ukuran dan Efek Logo */
        .logo-img {
            width: 80px;
            height: auto;
            transition: transform 0.3s ease-in-out;
        }

        .logo-img:hover {
            filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.8));
            transform: scale(1.1);
        }

        /* Container untuk Heading */
        .heading {
            position: relative;
            width: fit-content;
        }

        /* Efek pada teks utama */
        .small-heading {
            position: relative;
            font-size: clamp(1rem, 5vw, 2.5rem);
            text-transform: uppercase;
            color: #d4af37;
            background: linear-gradient(90deg, #ffcc00, #d4af37, #b8860b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
        }

        /* Efek Reveal pada Teks Arab */
        .small-heading .arabic {
            font-family: 'Amiri', serif;
            font-size: 1.2em;
            display: block;
            position: relative;
        }

        .small-heading .arabic::before {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 20%;
            height: 100%;
            color: #ffcc00;
            -webkit-text-stroke: 0.8px #ffcc00;
            border-right: 2px solid #ffcc00;
            overflow: hidden;
            white-space: nowrap;
            animation: reveal 4s alternate ease-in-out infinite;
        }

        /* Efek Reveal pada Teks Latin */
        .small-heading .latin {
            font-family: 'Poppins', sans-serif;
            font-size: 0.7em;
            color: white;
            display: block;
            position: relative;
        }

        .small-heading .latin::before {
            content: attr(data-span);
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            color: #ffcc00;
            -webkit-text-stroke: 0.6px #ffcc00;
            overflow: hidden;
            white-space: nowrap;
            animation: reveal 4s alternate ease-in-out infinite;
        }

        /* Animasi Reveal */
        @keyframes reveal {
            0% {
                width: 0%;
            }

            100% {
                width: 50%;
            }
        }

        /* style tombol css */
        button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0 10px;
            color: white;
            text-shadow: 2px 2px rgb(116, 116, 116);
            text-transform: uppercase;
            cursor: pointer;
            border: solid 2px black;
            letter-spacing: 1px;
            font-weight: 600;
            font-size: 17px;
            background-color: hsl(49deg 98% 60%);
            border-radius: 50px;
            position: relative;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        button:active {
            transform: scale(0.9);
            transition: all 100ms ease;
        }

        button png {
            transition: all 0.5s ease;
            z-index: 2;
        }

        .play {
            transition: all 0.5s ease;
            transition-delay: 300ms;
        }

        button:hover png {
            transform: scale(3) translate(50%);
        }

        .now {
            position: absolute;
            left: 0;
            transform: translateX(-100%);
            transition: all 0.5s ease;
            z-index: 2;
        }

        button:hover .now {
            transform: translateX(10px);
            transition-delay: 300ms;
        }

        button:hover .play {
            transform: translateX(200%);
            transition-delay: 300ms;
        }

        button img {
            width: 36px;
            height: 36px;
            transition: all 0.5s ease;
        }

        button:hover img {
            transform: scale(1.2);
        }
    </style>

    <!-- Brand End -->


    <!-- Navbar Start -->

    @include('navbar')
    
    <style>
        .card img {
            height: 25px;
            width: 25px;
            transition: transform 0.25s;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: row;
            /* Pastikan ikon berjajar horizontal */
            align-items: center;
            justify-content: center;
            background: #e7e7e7;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
            height: 50px;
            width: auto;
            /* Sesuaikan lebar otomatis */
            padding: 0 10px;
            /* Tambahkan padding */
        }

        .card::before,
        .card::after {
            position: absolute;
            display: flex;
            align-items: center;
            width: 50%;
            height: 100%;
            transition: 0.25s linear;
            z-index: 1;
        }

        .card::before {
            content: "";
            left: 0;
            justify-content: flex-end;
            background-color: #4CAF50;
            /* Hijau Soft */
        }

        .card::after {
            content: "";
            right: 0;
            justify-content: flex-start;
            background-color: #45a049;
            /* Hijau Soft Lebih Gelap */
        }

        .card:hover {
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        .card:hover span {
            opacity: 0;
            z-index: -3;
        }

        .card:hover::before {
            opacity: 0.5;
            transform: translateY(-100%);
        }

        .card:hover::after {
            opacity: 0.5;
            transform: translateY(100%);
        }

        .card span {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            color: whitesmoke;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            /* Ukuran font diperkecil */
            font-weight: 700;
            opacity: 1;
            transition: opacity 0.25s;
            z-index: 2;
        }

        .card .social-link {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: auto;
            /* Lebar otomatis */
            height: 100%;
            color: whitesmoke;
            font-size: 24px;
            text-decoration: none;
            transition: 0.25s;
            margin: 0 5px;
            /* Jarak antar ikon */
        }

        .card .social-link:hover {
            background-color: rgba(249, 244, 255, 0.774);
            animation: bounce_613 0.4s linear;
        }

        @keyframes bounce_613 {
            40% {
                transform: scale(1.4);
            }

            60% {
                transform: scale(0.8);
            }

            80% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid header-carousel px-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Carousel Item 1 -->
                <div class="carousel-item active">
                    <img class="w-100" src="/landing_assets/img/pondok_4.jpg" alt="Pondok Pesantren">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                {{-- <div class="col-lg-7 text-start">
                                    <h1 class="display-1 text-white animated slideInRight mb-3">Pondok Pesantren Modern
                                    </h1>
                                    <p class="mb-5 animated slideInRight">Mendidik generasi muda dengan ilmu agama dan
                                        ilmu umum yang seimbang. Kami berkomitmen untuk menciptakan lingkungan belajar
                                        yang kondusif dan inspiratif.</p>
                                    <a href=""
                                        class="btn btn-primary py-3 px-5 animated slideInRight">Selengkapnya</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Item 2 -->
                <div class="carousel-item">
                    <img class="w-100" src="/landing_assets/img/pondok_2.jpg" alt="Kegiatan Santri">
                    <div class="carousel-caption">
                        <div class="container">
                            {{-- <div class="row justify-content-end">
                                <div class="col-lg-7 text-end">
                                    <h1 class="display-1 text-white animated slideInLeft mb-3">Kegiatan Santri</h1>
                                    <p class="mb-5 animated slideInLeft">Santri kami terlibat dalam berbagai kegiatan
                                        yang mendukung perkembangan spiritual, intelektual, dan fisik. Mulai dari kajian
                                        kitab kuning, olahraga, hingga kegiatan seni.</p>
                                    <a href=""
                                        class="btn btn-primary py-3 px-5 animated slideInLeft">Selengkapnya</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-0">
                        <div class="col-6">
                            <img class="img-fluid" src="/landing_assets/img/about-1.jpg">
                        </div>
                        <div class="col-6">
                            <img class="img-fluid" src="/landing_assets/img/about-2.jpg">
                        </div>
                        <div class="col-6">
                            <img class="img-fluid" src="/landing_assets/img/about-3.jpg">
                        </div>
                        <div class="col-6">
                            <div
                                class="bg-primary w-100 h-100 mt-n5 ms-n5 d-flex flex-column align-items-center justify-content-center">
                                <div class="icon-box-light">
                                    <i class="bi bi-award text-dark"></i>
                                </div>
                                <h1 class="display-1 text-white mb-0" data-toggle="counter-up">25</h1>
                                <small class="fs-5 text-white">Years Experience</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-6 mb-4">Trusted Lab Experts and Latest Lab Technologies</h1>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus augue,
                        iaculis id elit eget, ultrices pulvinar tortor. Quisque vel lorem porttitor, malesuada arcu
                        quis, fringilla risus. Pellentesque eu consequat augue.</p>
                    <div class="row g-4 g-sm-5 justify-content-center">
                        <div class="col-sm-6">
                            <div class="about-fact btn-square flex-column rounded-circle bg-primary ms-sm-auto">
                                <p class="text-white mb-0">Awards Winning</p>
                                <h1 class="text-white mb-0" data-toggle="counter-up">9999</h1>
                            </div>
                        </div>
                        <div class="col-sm-6 text-start">
                            <div class="about-fact btn-square flex-column rounded-circle bg-secondary me-sm-auto">
                                <p class="text-white mb-0">Complete Cases</p>
                                <h1 class="text-white mb-0" data-toggle="counter-up">9999</h1>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="about-fact mt-n130 btn-square flex-column rounded-circle bg-dark mx-sm-auto">
                                <p class="text-white mb-0">Happy Clients</p>
                                <h1 class="text-white mb-0" data-toggle="counter-up">9999</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Features Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-0 feature-row">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="feature-item border h-100 p-5">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-award text-dark"></i>
                        </div>
                        <h5 class="mb-3">Award Winning</h5>
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                            augue.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <div class="feature-item border h-100 p-5">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-people text-dark"></i>
                        </div>
                        <h5 class="mb-3">Expet Doctors</h5>
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                            augue.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <div class="feature-item border h-100 p-5">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-cash-coin text-dark"></i>
                        </div>
                        <h5 class="mb-3">Fair Prices</h5>
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                            augue.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <div class="feature-item border h-100 p-5">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-headphones text-dark"></i>
                        </div>
                        <h5 class="mb-3">24/7 Support</h5>
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                            augue.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Features Start -->
    <div class="container-fluid feature mt-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-6 pt-lg-5">
                    <div class="bg-white p-5 mt-lg-5">
                        <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.3s">The Best Medical Test & Laboratory
                            Solution</h1>
                        <p class="mb-4 wow fadeIn" data-wow-delay="0.4s">Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Curabitur tellus augue, iaculis id elit eget, ultrices pulvinar tortor.
                            Quisque vel lorem porttitor, malesuada arcu quis, fringilla risus. Pellentesque eu consequat
                            augue.</p>
                        <div class="row g-5 pt-2 mb-5">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="icon-box-primary mb-4">
                                    <i class="bi bi-person-plus text-dark"></i>
                                </div>
                                <h5 class="mb-3">Experience Doctors</h5>
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                                <div class="icon-box-primary mb-4">
                                    <i class="bi bi-check-all text-dark"></i>
                                </div>
                                <h5 class="mb-3">Advanced Microscopy</h5>
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                            </div>
                        </div>
                        <a class="btn btn-primary py-3 px-5 wow fadeIn" data-wow-delay="0.5s" href="">Explore
                            More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row h-100 align-items-end">
                        <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex align-items-center justify-content-center" style="min-height: 300px;">
                                <button type="button" class="btn-play" data-bs-toggle="modal"
                                    data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                                    <span></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-primary p-5">
                                <div class="experience mb-4 wow fadeIn" data-wow-delay="0.3s">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-white">Sample Preparation</span>
                                        <span class="text-white">90%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-dark" role="progressbar" aria-valuenow="90"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="experience mb-4 wow fadeIn" data-wow-delay="0.4s">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-white">Result Accuracy</span>
                                        <span class="text-white">95%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-dark" role="progressbar" aria-valuenow="95"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="experience mb-0 wow fadeIn" data-wow-delay="0.5s">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-white">Lab Equipments</span>
                                        <span class="text-white">90%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-dark" role="progressbar" aria-valuenow="90"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Video Modal Start -->
    <div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Youtube Video</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                            allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->


    <!-- Service Start -->
    <div class="container-fluid container-service py-5">
        <div class="container pt-5">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-6 mb-3">Reliable & High-Quality Laboratory Service</h1>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus augue,
                    iaculis
                    id elit eget, ultrices pulvinar tortor.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-heart-pulse text-dark"></i>
                        </div>
                        <h5 class="mb-3">Pathology Testing</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                                augue.</p>
                            <a class="btn btn-light px-3" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-lungs text-dark"></i>
                        </div>
                        <h5 class="mb-3">Microbiology Tests</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                                augue.</p>
                            <a class="btn btn-light px-3" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-virus text-dark"></i>
                        </div>
                        <h5 class="mb-3">Biochemistry Tests</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                                augue.</p>
                            <a class="btn btn-light px-3" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-capsule-pill text-dark"></i>
                        </div>
                        <h5 class="mb-3">Histopatology Tests</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                                augue.</p>
                            <a class="btn btn-light px-3" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-capsule text-dark"></i>
                        </div>
                        <h5 class="mb-3">Urine Tests</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                                augue.</p>
                            <a class="btn btn-light px-3" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-prescription2 text-dark"></i>
                        </div>
                        <h5 class="mb-3">Blood Tests</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                                augue.</p>
                            <a class="btn btn-light px-3" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-clipboard2-pulse text-dark"></i>
                        </div>
                        <h5 class="mb-3">Fever Tests</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                                augue.</p>
                            <a class="btn btn-light px-3" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item">
                        <div class="icon-box-primary mb-4">
                            <i class="bi bi-file-medical text-dark"></i>
                        </div>
                        <h5 class="mb-3">Allergy Tests</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                                augue.</p>
                            <a class="btn btn-light px-3" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Appoinment Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="display-6 mb-4">We Ensure You Will Always Get The Best Result</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus augue, iaculis id elit
                        eget, ultrices pulvinar tortor. Quisque vel lorem porttitor, malesuada arcu quis, fringilla
                        risus. Pellentesque eu consequat augue.</p>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus augue,
                        iaculis id elit eget, ultrices pulvinar tortor.</p>
                    <div class="d-flex align-items-start wow fadeIn" data-wow-delay="0.3s">
                        <div class="icon-box-primary">
                            <i class="bi bi-geo-alt text-dark fs-1"></i>
                        </div>
                        <div class="ms-3">
                            <h5>Office Address</h5>
                            <span>123 Street, New York, USA</span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-start wow fadeIn" data-wow-delay="0.4s">
                        <div class="icon-box-primary">
                            <i class="bi bi-clock text-dark fs-1"></i>
                        </div>
                        <div class="ms-3">
                            <h5>Office Time</h5>
                            <span>Mon-Sat 09am-5pm, Sun Closed</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <h2 class="mb-4">Online Appoinment</h2>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="Your Name">
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="mail" placeholder="Your Email">
                                <label for="mail">Your Email</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="mobile" placeholder="Your Mobile">
                                <label for="mobile">Your Mobile</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <select class="form-select" id="service">
                                    <option selected>Pathology Testing</option>
                                    <option value="">Microbiology Tests</option>
                                    <option value="">Biochemistry Tests</option>
                                    <option value="">Histopatology Tests</option>
                                </select>
                                <label for="service">Choose A Service</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 130px"></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary w-100 py-3" type="submit">Submit Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appoinment Start -->


    <!-- Team Start -->
    <div class="container-fluid container-team py-5">
        <div class="container pb-5">
            <div class="row g-5 align-items-center mb-5">
                <div class="col-md-6 wow fadeIn" data-wow-delay="0.3s">
                    <img class="img-fluid w-100" src="/landing_assets/img/team-1.jpg" alt="">
                </div>
                <div class="col-md-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-6 mb-3">Dr. John Martin</h1>
                    <p class="mb-1">CEO & Founder</p>
                    <p class="mb-5">Labsky, New York, USA</p>
                    <h3 class="mb-3">Biography</h3>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus augue,
                        iaculis id elit eget, ultrices pulvinar tortor. Quisque vel lorem porttitor, malesuada arcu
                        quis, fringilla risus. Pellentesque eu consequat augue.</p>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus augue,
                        iaculis id elit eget, ultrices pulvinar tortor. Quisque vel lorem porttitor, malesuada arcu
                        quis, fringilla risus. Pellentesque eu consequat augue.</p>
                    <div class="d-flex">
                        <a class="btn btn-lg-square btn-primary me-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href=""><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="/landing_assets/img/team-2.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-1">Alex Robin</h5>
                            <span>Lab Assistant</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="/landing_assets/img/team-3.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-1">Andrew Bon</h5>
                            <span>Lab Assistant</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="/landing_assets/img/team-4.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-1">Martin Tompson</h5>
                            <span>Lab Assistant</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="/landing_assets/img/team-5.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-square btn-light mx-1" href=""><i
                                        class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-1">Clarabelle Samber</h5>
                            <span>Lab Assistant</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container pt-5">
            <div class="row gy-5 gx-0">
                <div class="col-lg-6 pe-lg-5 wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="display-6 text-white mb-4">What Clients Say About Our Lab Services!</h1>
                    <p class="text-white mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
                        tellus
                        augue, iaculis id elit eget, ultrices pulvinar tortor.</p>
                    <a href="" class="btn btn-primary py-3 px-5">More Testimonials</a>
                </div>
                <div class="col-lg-6 mb-n5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white p-5">
                        <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.1s">
                            <div class="testimonial-item">
                                <div class="icon-box-primary mb-4">
                                    <i class="bi bi-chat-left-quote text-dark"></i>
                                </div>
                                <p class="fs-5 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
                                    tellus augue, iaculis id elit eget, ultrices pulvinar tortor. Quisque vel lorem
                                    porttitor, malesuada arcu quis, fringilla risus. Pellentesque eu consequat augue.
                                </p>
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0" src="/landing_assets/img/testimonial-1.jpg"
                                        alt="">
                                    <div class="ps-3">
                                        <h5 class="mb-1">Client Name</h5>
                                        <span class="text-primary">Profession</span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <div class="icon-box-primary mb-4">
                                    <i class="bi bi-chat-left-quote text-dark"></i>
                                </div>
                                <p class="fs-5 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
                                    tellus augue, iaculis id elit eget, ultrices pulvinar tortor. Quisque vel lorem
                                    porttitor, malesuada arcu quis, fringilla risus. Pellentesque eu consequat augue.
                                </p>
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0" src="/landing_assets/img/testimonial-2.jpg"
                                        alt="">
                                    <div class="ps-3">
                                        <h5 class="mb-1">Client Name</h5>
                                        <span class="text-primary">Profession</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid footer position-relative bg-primary text-white-50 py-5 wow fadeIn"
        data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5 py-5">
                <!-- Kolom 1: Logo dan Deskripsi -->
                <div class="col-lg-6 pe-lg-5">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="h1 text-white mb-0">Lab<span class="text-light">sky</span></h1>
                    </a>
                    <p class="fs-5 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus
                        augue, iaculis id elit eget, ultrices pulvinar tortor.</p>
                    <p><i class="fa fa-map-marker-alt me-2"></i>123 Street, New York, USA</p>
                    <p><i class="fa fa-phone-alt me-2"></i>+012 345 67890</p>
                    <p><i class="fa fa-envelope me-2"></i>info@example.com</p>
                    <div class="d-flex mt-4">
                        <a class="btn btn-lg-square btn-light me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg-square btn-light me-2" href="#"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg-square btn-light me-2" href="#"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg-square btn-light me-2" href="#"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Kolom 2: Quick Links dan Popular Links -->
                <div class="col-lg-6 ps-lg-5">
                    <div class="row g-5">
                        <!-- Quick Links -->
                        <div class="col-sm-6">
                            <h4 class="text-light mb-4">Quick Links</h4>
                            <a class="btn btn-link text-white-50 text-decoration-none d-block mb-2"
                                href="#">About Us</a>
                            <a class="btn btn-link text-white-50 text-decoration-none d-block mb-2"
                                href="#">Contact Us</a>
                            <a class="btn btn-link text-white-50 text-decoration-none d-block mb-2" href="#">Our
                                Services</a>
                            <a class="btn btn-link text-white-50 text-decoration-none d-block mb-2"
                                href="#">Terms & Condition</a>
                            <a class="btn btn-link text-white-50 text-decoration-none d-block mb-2"
                                href="#">Support</a>
                        </div>

                        <!-- Popular Links -->
                        <div class="col-sm-6">
                            <h4 class="text-light mb-4">Popular Links</h4>
                            <a class="btn btn-link text-white-50 text-decoration-none d-block mb-2"
                                href="#">About Us</a>
                            <a class="btn btn-link text-white-50 text-decoration-none d-block mb-2"
                                href="#">Contact Us</a>
                            <a class="btn btn-link text-white-50 text-decoration-none d-block mb-2" href="#">Our
                                Services</a>
                            <a class="btn btn-link text-white-50 text-decoration-none d-block mb-2"
                                href="#">Terms & Condition</a>
                            <a class="btn btn-link text-white-50 text-decoration-none d-block mb-2"
                                href="#">Support</a>
                        </div>

                        <!-- Newsletter -->
                        <div class="col-sm-12">
                            <h4 class="text-light mb-4">Newsletter</h4>
                            <div class="w-100">
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 py-3 px-4"
                                        style="background: rgba(255, 255, 255, .1);" placeholder="Your Email Address">
                                    <button class="btn btn-light px-4">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark text-white-50 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <a href="#">Your Site Name</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    <p class="mb-0">Designed by <a href="https://htmlcodex.com">HTML Codex</a><br>Distributed by <a
                            href="https://themewagon.com">ThemeWagon</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/landing_assets/lib/wow/wow.min.js"></script>
    <script src="/landing_assets/lib/easing/easing.min.js"></script>
    <script src="/landing_assets/lib/waypoints/waypoints.min.js"></script>
    <script src="/landing_assets/lib/counterup/counterup.min.js"></script>
    <script src="/landing_assets/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/landing_assets/js/main.js"></script>
</body>

</html>
