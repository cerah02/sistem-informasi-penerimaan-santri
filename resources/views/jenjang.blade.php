@extends('layout_landingpage')

@section('title', 'Daftar Fasilitas')

@section('content')
    <title>EduPath - Jenjang Pendidikan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset dan Base Styles */
        .edupath-reset {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body.edupath-body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        /* Container Utama */
        .edupath-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .edupath-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .edupath-title {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .edupath-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #9b59b6);
            border-radius: 2px;
        }

        .edupath-subtitle {
            color: #7f8c8d;
            font-weight: 300;
            font-size: 1.2rem;
        }

        /* Timeline Pendidikan */
        .edupath-timeline {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
        }

        .edupath-timeline::after {
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

        /* Item Pendidikan */
        .edupath-item {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            margin-bottom: 2rem;
        }

        .edupath-item::after {
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

        .edupath-item-left {
            left: 0;
        }

        .edupath-item-right {
            left: 50%;
        }

        .edupath-item-left::after {
            right: -17px;
        }

        .edupath-item-right::after {
            left: -17px;
            border-color: #9b59b6;
        }

        /* Konten Item */
        .edupath-content {
            padding: 20px 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .edupath-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .edupath-level {
            font-weight: 600;
            color: #3498db;
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .edupath-item-right .edupath-level {
            color: #9b59b6;
        }

        .edupath-duration {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .edupath-desc {
            color: #555;
        }

        /* Responsive */
        @media screen and (max-width: 768px) {
            .edupath-timeline::after {
                left: 31px;
            }

            .edupath-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .edupath-item-right {
                left: 0;
            }

            .edupath-item-left::after,
            .edupath-item-right::after {
                left: 18px;
            }
        }

        /* Dekorasi Khusus */
        .edupath-decoration {
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(52, 152, 219, 0.1);
            z-index: -1;
        }

        .edupath-dec-1 {
            top: 10%;
            left: 5%;
        }

        .edupath-dec-2 {
            bottom: 15%;
            right: 5%;
            background: rgba(155, 89, 182, 0.1);
        }
    </style>
    </head>

    <body class="edupath-body edupath-reset">
        <div class="edupath-decoration edupath-dec-1"></div>
        <div class="edupath-decoration edupath-dec-2"></div>

        <div class="edupath-container">
            <header class="edupath-header">
                <h1 class="edupath-title">Jenjang Pendidikan</h1>
                <p class="edupath-subtitle">Perjalanan belajar dari dasar hingga tinggi</p>
            </header>

            <div class="edupath-timeline">
                <!-- Pendidikan Anak Usia Dini -->
                <div class="edupath-item edupath-item-left">
                    <div class="edupath-content">
                        <h3 class="edupath-level">Sekolah Dasar Islam Darul Muttaqien (SD I())</h3>
                        <p class="edupath-duration">Usia 2-6 tahun</p>
                        <p class="edupath-desc">Fase pengenalan dasar-dasar belajar melalui bermain, pengembangan motorik,
                            dan sosialisasi awal.</p>
                    </div>
                </div>

                <!-- Sekolah Dasar -->
                <div class="edupath-item edupath-item-right">
                    <div class="edupath-content">
                        <h3 class="edupath-level">Sekolah Dasar (SD)</h3>
                        <p class="edupath-duration">Kelas 1-6 (Usia 6-12 tahun)</p>
                        <p class="edupath-desc">Pendidikan dasar yang mencakup membaca, menulis, berhitung, dan pengetahuan
                            umum.</p>
                    </div>
                </div>

                <!-- Sekolah Menengah Pertama -->
                <div class="edupath-item edupath-item-left">
                    <div class="edupath-content">
                        <h3 class="edupath-level">Sekolah Menengah Pertama (SMP)</h3>
                        <p class="edupath-duration">Kelas 7-9 (Usia 12-15 tahun)</p>
                        <p class="edupath-desc">Pendidikan menengah pertama dengan pengenalan berbagai disiplin ilmu secara
                            lebih mendalam.</p>
                    </div>
                </div>

                <!-- Sekolah Menengah Atas -->
                <div class="edupath-item edupath-item-right">
                    <div class="edupath-content">
                        <h3 class="edupath-level">Sekolah Menengah Atas (SMA)</h3>
                        <p class="edupath-duration">Kelas 10-12 (Usia 15-18 tahun)</p>
                        <p class="edupath-desc">Pendidikan menengah atas dengan peminatan jurusan (IPA, IPS, Bahasa) sebagai
                            persiapan ke perguruan tinggi.</p>
                    </div>
                </div>

                <!-- Perguruan Tinggi -->
                <div class="edupath-item edupath-item-left">
                    <div class="edupath-content">
                        <h3 class="edupath-level">Perguruan Tinggi</h3>
                        <p class="edupath-duration">Diploma/Sarjana (3-4 tahun)</p>
                        <p class="edupath-desc">Pendidikan tinggi dengan spesialisasi bidang tertentu, mencakup program
                            diploma, sarjana, magister, dan doktoral.</p>
                    </div>
                </div>

                <!-- Pendidikan Non Formal -->
                <div class="edupath-item edupath-item-right">
                    <div class="edupath-content">
                        <h3 class="edupath-level">Pendidikan Non Formal</h3>
                        <p class="edupath-duration">Fleksibel</p>
                        <p class="edupath-desc">Kursus, pelatihan, atau program sertifikasi untuk pengembangan keterampilan
                            khusus di luar jalur formal.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
