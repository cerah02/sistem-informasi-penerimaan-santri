@extends('layout_landingpage')

@section('title', 'Daftar Fasilitas')

@section('content')
    <title>Pakaian Santri - Contoh Per Hari</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Amiri:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        /* Reset Styles dengan Prefix Unik */
        .santri-outfit-reset {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Base Styles */
        body.santri-outfit-body {
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
        .santri-outfit-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .santri-outfit-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            padding: 2rem 0;
        }

        .santri-outfit-header::before {
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

        .santri-outfit-title {
            font-family: 'Amiri', serif;
            font-size: 2.8rem;
            color: #2980b9;
            margin-bottom: 1rem;
        }

        .santri-outfit-subtitle {
            color: #7f8c8d;
            font-weight: 300;
            font-size: 1.2rem;
        }

        /* Grid Pakaian */
        .santri-outfit-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        /* Card Pakaian */
        .santri-outfit-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .santri-outfit-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .santri-outfit-img-container {
            height: 300px;
            overflow: hidden;
            position: relative;
        }

        .santri-outfit-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .santri-outfit-card:hover .santri-outfit-img {
            transform: scale(1.05);
        }

        .santri-outfit-day {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background-color: rgba(41, 128, 185, 0.9);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .santri-outfit-content {
            padding: 1.5rem;
        }

        .santri-outfit-type {
            display: inline-block;
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 0.3rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .santri-outfit-desc {
            color: #555;
            margin-bottom: 1.5rem;
        }

        .santri-outfit-details {
            border-top: 1px dashed #eee;
            padding-top: 1rem;
        }

        .santri-outfit-details h4 {
            color: #2980b9;
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
        }

        .santri-outfit-list {
            list-style-type: none;
        }

        .santri-outfit-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #f5f5f5;
            display: flex;
            align-items: center;
        }

        .santri-outfit-list li:last-child {
            border-bottom: none;
        }

        .santri-outfit-list li::before {
            content: '•';
            color: #2980b9;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .santri-outfit-title {
                font-size: 2rem;
            }

            .santri-outfit-grid {
                grid-template-columns: 1fr;
            }

            .santri-outfit-img-container {
                height: 250px;
            }
        }

        /* Animasi */
        @keyframes santri-outfit-fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .santri-outfit-card {
            animation: santri-outfit-fadeIn 0.6s ease-out;
            animation-fill-mode: backwards;
        }

        .santri-outfit-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .santri-outfit-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .santri-outfit-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .santri-outfit-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .santri-outfit-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .santri-outfit-card:nth-child(6) {
            animation-delay: 0.6s;
        }
    </style>
    </head>

    <body class="santri-outfit-body santri-outfit-reset">
        <div class="santri-outfit-container">
            <header class="santri-outfit-header">
                <h1 class="santri-outfit-title">Pakaian Santri</h1>
                <p class="santri-outfit-subtitle">Contoh Pakaian Harian Pondok Pesantren</p>
            </header>

            <div class="santri-outfit-grid">
                <!-- Senin -->
                <div class="santri-outfit-card">
                    <div class="santri-outfit-img-container">
                        <img src="https://images.unsplash.com/photo-1560421683-2587f1591a8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Pakaian Santri Hari Senin" class="santri-outfit-img">
                        <span class="santri-outfit-day">Senin</span>
                    </div>
                    <div class="santri-outfit-content">
                        <span class="santri-outfit-type">Formal Lengkap</span>
                        <p class="santri-outfit-desc">Pakaian formal untuk upacara pembukaan mingguan dan kegiatan resmi
                            pondok.</p>
                        <div class="santri-outfit-details">
                            <h4>Komponen Pakaian:</h4>
                            <ul class="santri-outfit-list">
                                <li>Baju koko putih lengan panjang</li>
                                <li>Celana panjang hitam bahan</li>
                                <li>Peci hitam polos</li>
                                <li>Sarung kotak-kotak hitam putih</li>
                                <li>Sabuk kulit hitam</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Selasa -->
                <div class="santri-outfit-card">
                    <div class="santri-outfit-img-container">
                        <img src="https://images.unsplash.com/photo-1560421683-6854b8c553b2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Pakaian Santri Hari Selasa" class="santri-outfit-img">
                        <span class="santri-outfit-day">Selasa</span>
                    </div>
                    <div class="santri-outfit-content">
                        <span class="santri-outfit-type">Praktikum</span>
                        <p class="santri-outfit-desc">Pakaian praktikum untuk kegiatan keterampilan dan kerja lapangan.</p>
                        <div class="santri-outfit-details">
                            <h4>Komponen Pakaian:</h4>
                            <ul class="santri-outfit-list">
                                <li>Kaos oblong putih lengan pendek</li>
                                <li>Celana training abu-abu</li>
                                <li>Jas lab putih (jika diperlukan)</li>
                                <li>Sepatu kets</li>
                                <li>Topi lapangan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Rabu -->
                <div class="santri-outfit-card">
                    <div class="santri-outfit-img-container">
                        <img src="https://images.unsplash.com/photo-1560421683-2587f1591a8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Pakaian Santri Hari Rabu" class="santri-outfit-img">
                        <span class="santri-outfit-day">Rabu</span>
                    </div>
                    <div class="santri-outfit-content">
                        <span class="santri-outfit-type">Tradisional</span>
                        <p class="santri-outfit-desc">Pakaian tradisional untuk kajian kitab kuning dan kegiatan keagamaan.
                        </p>
                        <div class="santri-outfit-details">
                            <h4>Komponent Pakaian:</h4>
                            <ul class="santri-outfit-list">
                                <li>Jubah putih panjang</li>
                                <li>Serban putih sederhana</li>
                                <li>Sarung batik</li>
                                <li>Gamis panjang (opsional)</li>
                                <li>Sandali kulit</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Kamis -->
                <div class="santri-outfit-card">
                    <div class="santri-outfit-img-container">
                        <img src="https://images.unsplash.com/photo-1560421683-5e5e00b5a0d9?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Pakaian Santri Hari Kamis" class="santri-outfit-img">
                        <span class="santri-outfit-day">Kamis</span>
                    </div>
                    <div class="santri-outfit-content">
                        <span class="santri-outfit-type">Khusus</span>
                        <p class="santri-outfit-desc">Pakaian khusus persiapan Jumat dengan warna khas pesantren.</p>
                        <div class="santri-outfit-details">
                            <h4>Komponen Pakaian:</h4>
                            <ul class="santri-outfit-list">
                                <li>Baju koko hijau muda</li>
                                <li>Celana panjang putih</li>
                                <li>Peci putih</li>
                                <li>Sarung kotak-kotak hijau</li>
                                <li>Minyak wangi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Jumat -->
                <div class="santri-outfit-card">
                    <div class="santri-outfit-img-container">
                        <img src="https://images.unsplash.com/photo-1560421683-5e5e00b5a0d9?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Pakaian Santri Hari Jumat" class="santri-outfit-img">
                        <span class="santri-outfit-day">Jumat</span>
                    </div>
                    <div class="santri-outfit-content">
                        <span class="santri-outfit-type">Ibadah</span>
                        <p class="santri-outfit-desc">Pakaian terbaik untuk shalat Jumat dan kegiatan ibadah khusus.</p>
                        <div class="santri-outfit-details">
                            <h4>Komponen Pakaian:</h4>
                            <ul class="santri-outfit-list">
                                <li>Baju koko putih bersih</li>
                                <li>Celana panjang hitam bahan</li>
                                <li>Peci hitam bordir</li>
                                <li>Sarung tenun mewah</li>
                                <li>Minyak wangi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Sabtu -->
                <div class="santri-outfit-card">
                    <div class="santri-outfit-img-container">
                        <img src="https://images.unsplash.com/photo-1560421683-5e5e00b5a0d9?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                            alt="Pakaian Santri Hari Sabtu" class="santri-outfit-img">
                        <span class="santri-outfit-day">Sabtu</span>
                    </div>
                    <div class="santri-outfit-content">
                        <span class="santri-outfit-type">Santai</span>
                        <p class="santri-outfit-desc">Pakaian santai untuk kegiatan ekstrakurikuler dan kerja bakti.</p>
                        <div class="santri-outfit-details">
                            <h4>Komponen Pakaian:</h4>
                            <ul class="santri-outfit-list">
                                <li>Kaos santri lengan pendek</li>
                                <li>Celana training panjang</li>
                                <li>Jaket santri (opsional)</li>
                                <li>Sepatu kets</li>
                                <li>Topi lapangan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
