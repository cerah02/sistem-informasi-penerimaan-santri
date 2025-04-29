@extends('layout_landingpage')

@section('title', 'Daftar Fasilitas')

@section('content')
    <title>Jadwal Kegiatan Harian Santri</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Amiri:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        /* Reset Styles dengan Prefix Unik */
        .santri-schedule-reset {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Base Styles */
        body.santri-schedule-body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #2c3e50;
            line-height: 1.8;
            background-image: url('https://example.com/subtle-islamic-pattern.png');
            background-size: 300px;
            background-blend-mode: overlay;
            background-color: rgba(248, 249, 250, 0.95);
        }

        /* Container Utama */
        .santri-schedule-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .santri-schedule-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            padding: 2rem 0;
        }

        .santri-schedule-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 3px;
            background: linear-gradient(90deg, #3498db, #2980b9);
            border-radius: 3px;
        }

        .santri-schedule-title {
            font-family: 'Amiri', serif;
            font-size: 2.8rem;
            color: #2980b9;
            margin-bottom: 1rem;
        }

        .santri-schedule-subtitle {
            color: #7f8c8d;
            font-weight: 300;
            font-size: 1.2rem;
        }

        /* Jadwal Harian */
        .santri-schedule-timeline {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
        }

        .santri-schedule-timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background: linear-gradient(to bottom, #3498db, #9b59b6);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
            border-radius: 10px;
        }

        /* Item Kegiatan */
        .santri-schedule-item {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            margin-bottom: 1.5rem;
        }

        .santri-schedule-item::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            background-color: white;
            border: 4px solid #3498db;
            border-radius: 50%;
            top: 15px;
            z-index: 1;
        }

        .santri-schedule-item-left {
            left: 0;
        }

        .santri-schedule-item-right {
            left: 50%;
        }

        .santri-schedule-item-left::after {
            right: -17px;
        }

        .santri-schedule-item-right::after {
            left: -17px;
            border-color: #9b59b6;
        }

        /* Konten Kegiatan */
        .santri-schedule-content {
            padding: 20px 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            position: relative;
            transition: all 0.3s ease;
        }

        .santri-schedule-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .santri-schedule-time {
            font-weight: 600;
            color: #3498db;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }

        .santri-schedule-item-right .santri-schedule-time {
            color: #9b59b6;
        }

        .santri-schedule-time::before {
            content: '';
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: currentColor;
            margin-right: 10px;
        }

        .santri-schedule-activity {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        .santri-schedule-desc {
            color: #555;
            font-size: 0.95rem;
        }

        .santri-schedule-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #7f8c8d;
            font-size: 1.5rem;
        }

        /* Kategori Kegiatan */
        .santri-schedule-category {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 0.8rem;
        }

        .santri-schedule-prayer {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .santri-schedule-study {
            background-color: #e8f5e9;
            color: #388e3c;
        }

        .santri-schedule-meal {
            background-color: #fff3e0;
            color: #e65100;
        }

        .santri-schedule-rest {
            background-color: #f3e5f5;
            color: #8e24aa;
        }

        /* Responsive */
        @media screen and (max-width: 768px) {
            .santri-schedule-timeline::after {
                left: 31px;
            }

            .santri-schedule-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .santri-schedule-item-right {
                left: 0;
            }

            .santri-schedule-item-left::after,
            .santri-schedule-item-right::after {
                left: 18px;
            }

            .santri-schedule-title {
                font-size: 2rem;
            }
        }

        /* Dekorasi */
        .santri-schedule-decoration {
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(52, 152, 219, 0.1);
            z-index: -1;
        }

        .santri-schedule-dec-1 {
            top: 10%;
            left: 5%;
        }

        .santri-schedule-dec-2 {
            bottom: 15%;
            right: 5%;
            background: rgba(155, 89, 182, 0.1);
        }
    </style>
    </head>

    <body class="santri-schedule-body santri-schedule-reset">
        <div class="santri-schedule-decoration santri-schedule-dec-1"></div>
        <div class="santri-schedule-decoration santri-schedule-dec-2"></div>

        <div class="santri-schedule-container">
            <header class="santri-schedule-header">
                <h1 class="santri-schedule-title">Kegiatan Harian Santri</h1>
                <p class="santri-schedule-subtitle">Jadwal rutin pondok pesantren Darul Muttaqien</p>
            </header>

            <div class="santri-schedule-timeline">
                <!-- Subuh -->
                <div class="santri-schedule-item santri-schedule-item-left">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">🕌</span>
                        <p class="santri-schedule-time">03:30 - 04:30 WIB</p>
                        <h3 class="santri-schedule-activity">Shalat Tahajjud & Subuh Berjamaah</h3>
                        <p class="santri-schedule-desc">Diawali dengan shalat tahajjud dan dzikir sambil menunggu waktu
                            Shalat subuh berjamaah di masjid pondok</p>
                        <span class="santri-schedule-category santri-schedule-prayer">Ibadah</span>
                    </div>
                </div>

                <!-- Tahfidz Pagi -->
                <div class="santri-schedule-item santri-schedule-item-right">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">📖</span>
                        <p class="santri-schedule-time">04:30 - 06:00 WIB</p>
                        <h3 class="santri-schedule-activity">Tahfidz Pagi / Tausiyah Kiayi</h3>
                        <span class="santri-schedule-category santri-schedule-study">Belajar</span>
                    </div>
                </div>

                <!-- Sarapan -->
                <div class="santri-schedule-item santri-schedule-item-left">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">🍲</span>
                        <p class="santri-schedule-time">06:00 - 07:00 WIB</p>
                        <h3 class="santri-schedule-activity">Mandi, Sarapan Pagi, dan Persiapan Sekolah</h3>
                        <p class="santri-schedule-desc">Makan pagi bersama di dapur umum pondok dengan menu bergizi</p>
                        <span class="santri-schedule-category santri-schedule-meal">Makan</span>
                    </div>
                </div>

                <!-- Sekolah Formal -->
                <div class="santri-schedule-item santri-schedule-item-right">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">📚</span>
                        <p class="santri-schedule-time">07:00 - 12:30 WIB</p>
                        <h3 class="santri-schedule-activity">Sekolah Formal</h3>
                        <p class="santri-schedule-desc">Kegiatan belajar mengajar kurikulum nasional di sekolah formal
                            pondok</p>
                        <span class="santri-schedule-category santri-schedule-study">Belajar</span>
                    </div>
                </div>

                <!-- Dzuhur -->
                <div class="santri-schedule-item santri-schedule-item-left">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">🕌</span>
                        <p class="santri-schedule-time">12:30 - 13:30 WIB</p>
                        <h3 class="santri-schedule-activity">Shalat Dzuhur Berjamaah</h3>
                        <p class="santri-schedule-desc">Shalat dzuhur berjamaah dilanjutkan dengan makan siang dan istirahat
                        </p>
                        <span class="santri-schedule-category santri-schedule-prayer">Ibadah</span>
                    </div>
                </div>

                <!-- Kajian Kitab -->
                <div class="santri-schedule-item santri-schedule-item-right">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">📜</span>
                        <p class="santri-schedule-time">13:30 - 15:30 WIB</p>
                        <h3 class="santri-schedule-activity">Belajar Siang non-formal</h3>
                        <p class="santri-schedule-desc">Belajar Hadist, Fiqih, Nahu Shorof, Mahfudzot, dan lain-lain</p>
                        <span class="santri-schedule-category santri-schedule-study">Belajar</span>
                    </div>
                </div>

                <!-- Ashar -->
                <div class="santri-schedule-item santri-schedule-item-left">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">🕌</span>
                        <p class="santri-schedule-time">15:30 - 16:30 WIB</p>
                        <h3 class="santri-schedule-activity">Shalat Ashar Berjamaah</h3>
                        <p class="santri-schedule-desc">Shalat ashar berjamaah dilanjutkan dengan Tahfidz Sore
                        </p>
                        <span class="santri-schedule-category santri-schedule-prayer">Ibadah</span>
                    </div>
                </div>

                <!-- Ekstrakurikuler -->
                <div class="santri-schedule-item santri-schedule-item-right">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">⚽</span>
                        <p class="santri-schedule-time">16:30 - 17:30 WIB</p>
                        <h3 class="santri-schedule-activity">Ekstrakurikuler Dan Bermain</h3>
                        <p class="santri-schedule-desc">Kegiatan pengembangan bakat dan minat (olahraga, drumb band, hadroh,
                            pencak silat, dll)
                        </p>
                        <span class="santri-schedule-category santri-schedule-study">Aktivitas</span>
                    </div>
                </div>

                <div class="santri-schedule-item santri-schedule-item-left">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">🍲</span>
                        <p class="santri-schedule-time">17:30 - 18:00 WIB</p>
                        <h3 class="santri-schedule-activity">Mandi dan Makan sore</h3>
                        <p class="santri-schedule-desc">Makan sore bersama di dapur umum pondok dengan menu bergizi</p>
                        <span class="santri-schedule-category santri-schedule-meal">Makan</span>
                    </div>
                </div>

                <!-- Maghrib -->
                <div class="santri-schedule-item santri-schedule-item-right">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">🕌</span>
                        <p class="santri-schedule-time">18:00 - 19:00 WIB</p>
                        <h3 class="santri-schedule-activity">Shalat Maghrib & Tahsinul Qur'an</h3>
                        <p class="santri-schedule-desc">Shalat maghrib berjamaah dilanjutkan dengan Tahsinul Qur'an
                        </p>
                        <span class="santri-schedule-category santri-schedule-prayer">Ibadah</span>
                    </div>
                </div>

                <!-- Isya -->
                <div class="santri-schedule-item santri-schedule-item-left">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">🕌</span>
                        <p class="santri-schedule-time">19:30 - 20:30 WIB</p>
                        <h3 class="santri-schedule-activity">Shalat Isya & Murojaah</h3>
                        <p class="santri-schedule-desc">Shalat isya berjamaah dilanjutkan dengan murojaah hafalan Al-Qur'an
                        </p>
                        <span class="santri-schedule-category santri-schedule-prayer">Ibadah</span>
                    </div>
                </div>

                <!-- Belajar Malam -->
                <div class="santri-schedule-item santri-schedule-item-right">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">💡</span>
                        <p class="santri-schedule-time">20:30 - 21:30 WIB</p>
                        <h3 class="santri-schedule-activity">Belajar Malam</h3>
                        <p class="santri-schedule-desc">Belajar Ceramah, dan lain-lain
                        </p>
                        <span class="santri-schedule-category santri-schedule-study">Belajar</span>
                    </div>
                </div>

                <!-- Istirahat -->
                <div class="santri-schedule-item santri-schedule-item-left">
                    <div class="santri-schedule-content">
                        <span class="santri-schedule-icon">😴</span>
                        <p class="santri-schedule-time">22:00 - 03:30 WIB</p>
                        <h3 class="santri-schedule-activity">Istirahat Malam</h3>
                        <p class="santri-schedule-desc">Waktu tidur dan istirahat untuk memulihkan tenaga</p>
                        <span class="santri-schedule-category santri-schedule-rest">Istirahat</span>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
