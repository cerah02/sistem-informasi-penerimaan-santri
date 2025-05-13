@extends('layout_landingpage')

@section('title', 'Fasilitas Pesantren')

@section('content')
    <title>Fasilitas Pesantren - Pondok Modern</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Amiri:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        /* Reset Styles */
        .facility-reset {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Base Styles */
        body.facility-body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #2c3e50;
            line-height: 1.8;
            background-image: url('https://img.freepik.com/free-vector/hand-drawn-islamic-background_23-2149241594.jpg');
            background-size: 500px;
            background-blend-mode: overlay;
            background-color: rgba(245, 247, 250, 0.9);
        }

        /* Container Utama */
        .facility-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .facility-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            padding: 2rem 0;
        }

        .facility-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 3px;
            background: linear-gradient(90deg, #2ecc71, #27ae60);
            border-radius: 3px;
        }

        .facility-title {
            font-family: 'Amiri', serif;
            font-size: 2.8rem;
            color: #27ae60;
            margin-bottom: 1rem;
        }

        .facility-subtitle {
            color: #7f8c8d;
            font-weight: 300;
            font-size: 1.2rem;
        }

        /* Grid Fasilitas */
        .facility-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        /* Card Fasilitas */
        .facility-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .facility-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .facility-img-container {
            height: 300px;
            overflow: hidden;
            position: relative;
        }

        .facility-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .facility-card:hover .facility-img {
            transform: scale(1.05);
        }

        .facility-category {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background-color: rgba(46, 204, 113, 0.9);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .facility-content {
            padding: 1.5rem;
        }

        .facility-type {
            display: inline-block;
            background-color: #e8f6f3;
            color: #2ecc71;
            padding: 0.3rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .facility-desc {
            color: #555;
            margin-bottom: 1.5rem;
        }

        .facility-features {
            border-top: 1px dashed #eee;
            padding-top: 1rem;
        }

        .facility-features h4 {
            color: #27ae60;
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
        }

        .facility-list {
            list-style-type: none;
        }

        .facility-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #f5f5f5;
            display: flex;
            align-items: center;
        }

        .facility-list li:last-child {
            border-bottom: none;
        }

        .facility-list li::before {
            content: '✓';
            color: #2ecc71;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .facility-title {
                font-size: 2rem;
            }

            .facility-grid {
                grid-template-columns: 1fr;
            }

            .facility-img-container {
                height: 250px;
            }
        }

        /* Animasi */
        @keyframes facility-fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .facility-card {
            animation: facility-fadeIn 0.6s ease-out;
            animation-fill-mode: backwards;
        }

        .facility-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .facility-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .facility-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .facility-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .facility-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .facility-card:nth-child(6) {
            animation-delay: 0.6s;
        }
    </style>
    </head>

    <body class="facility-body facility-reset">
        <div class="facility-container">
            <header class="facility-header">
                <h1 class="facility-title">Fasilitas Pesantren</h1>
                <p class="facility-subtitle">Infrastruktur Pendukung Pendidikan Berbasis Islam</p>
            </header>

            <div class="facility-grid">
                <!-- Perpustakaan -->
                <div class="facility-card">
                    <div class="facility-img-container">
                        <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Perpustakaan" class="facility-img">
                        <span class="facility-category">Akademik</span>
                    </div>
                    <div class="facility-content">
                        <span class="facility-type">Perpustakaan</span>
                        <p class="facility-desc">Perpustakaan modern dengan koleksi kitab kuning hingga buku kontemporer.
                        </p>
                        <div class="facility-features">
                            <h4>Fasilitas:</h4>
                            <ul class="facility-list">
                                <li>10.000+ koleksi buku</li>
                                <li>Ruangan ber-AC</li>
                                <li>Wi-Fi kecepatan tinggi</li>
                                <li>Ruang baca 24 jam</li>
                                <li>Katalog digital</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Asrama -->
                <div class="facility-card">
                    <div class="facility-img-container">
                        <img src="https://images.unsplash.com/photo-1604018612517-9f0ccc6d3d4a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Asrama" class="facility-img">
                        <span class="facility-category">Hunian</span>
                    </div>
                    <div class="facility-content">
                        <span class="facility-type">Asrama Santri</span>
                        <p class="facility-desc">Asrama nyaman dengan sistem kamar berkapasitas terbatas.</p>
                        <div class="facility-features">
                            <h4>Fasilitas:</h4>
                            <ul class="facility-list">
                                <li>Kasur springbed</li>
                                <li>Lemari pakaian</li>
                                <li>AC dan ventilasi baik</li>
                                <li>Laundry service</li>
                                <li>Area belajar pribadi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Masjid -->
                <div class="facility-card">
                    <div class="facility-img-container">
                        <img src="https://images.unsplash.com/photo-1580338459050-75f5b0c01a2c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Masjid" class="facility-img">
                        <span class="facility-category">Ibadah</span>
                    </div>
                    <div class="facility-content">
                        <span class="facility-type">Masjid Pusat</span>
                        <p class="facility-desc">Masjid tiga lantai dengan kapasitas 2000 jamaah.</p>
                        <div class="facility-features">
                            <h4>Fasilitas:</h4>
                            <ul class="facility-list">
                                <li>Sound system profesional</li>
                                <li>Karpet khusus shalat</li>
                                <li>Perpustakaan mini</li>
                                <li>Ruang wudhu modern</li>
                                <li>Pendingin udara</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Laboratorium -->
                <div class="facility-card">
                    <div class="facility-img-container">
                        <img src="https://images.unsplash.com/photo-1581094271901-8022df4466f9?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Laboratorium" class="facility-img">
                        <span class="facility-category">Pendidikan</span>
                    </div>
                    <div class="facility-content">
                        <span class="facility-type">Lab Komputer</span>
                        <p class="facility-desc">Laboratorium TI dengan perangkat terkini untuk pembelajaran.</p>
                        <div class="facility-features">
                            <h4>Fasilitas:</h4>
                            <ul class="facility-list">
                                <li>50 PC workstation</li>
                                <li>Internet fiber optik</li>
                                <li>Software lengkap</li>
                                <li>Printer 3D</li>
                                <li>Ruangan ber-AC</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Olahraga -->
                <div class="facility-card">
                    <div class="facility-img-container">
                        <img src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Olahraga" class="facility-img">
                        <span class="facility-category">Rekreasi</span>
                    </div>
                    <div class="facility-content">
                        <span class="facility-type">Lapangan Olahraga</span>
                        <p class="facility-desc">Kompleks olahraga lengkap untuk pengembangan fisik santri.</p>
                        <div class="facility-features">
                            <h4>Fasilitas:</h4>
                            <ul class="facility-list">
                                <li>Lapangan futsal</li>
                                <li>Basket outdoor</li>
                                <li>Jogging track</li>
                                <li>Wall climbing</li>
                                <li>Kolam renang</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Kesehatan -->
                <div class="facility-card">
                    <div class="facility-img-container">
                        <img src="https://images.unsplash.com/photo-1584432810601-6c7f27d2362b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Klinik" class="facility-img">
                        <span class="facility-category">Kesehatan</span>
                    </div>
                    <div class="facility-content">
                        <span class="facility-type">Klinik Santri</span>
                        <p class="facility-desc">Layanan kesehatan 24 jam dengan tenaga medis profesional.</p>
                        <div class="facility-features">
                            <h4>Fasilitas:</h4>
                            <ul class="facility-list">
                                <li>Dokter jaga</li>
                                <li>Ambulans darurat</li>
                                <li>Ruang isolasi</li>
                                <li>Apotek lengkap</li>
                                <li>Medical checkup rutin</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
