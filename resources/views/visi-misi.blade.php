@extends('layout_landingpage')

@section('title', 'Visi & Misi')

@section('content')
    <div class="ppvm-container ppvm-root">
        <style>
            /* Prefix semua class dengan 'ppvm-' (Pondok Pesantren Visi Misi) */
            .ppvm-root {
                --ppvm-primary-color: #2c786c;
                --ppvm-secondary-color: #004445;
                --ppvm-accent-color: #f8b400;
                --ppvm-light-color: #faf5e4;
            }

            .ppvm-container {
                font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #333;
                /* Warna teks utama lebih gelap */
            }

            .ppvm-header {
                background: linear-gradient(135deg, var(--ppvm-primary-color), var(--ppvm-secondary-color));
                color: white;
                text-align: center;
                padding: 2rem 0;
                position: relative;
                overflow: hidden;
            }

            .ppvm-header::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url('islamic-pattern.png') repeat;
                opacity: 0.1;
                z-index: 0;
            }

            .ppvm-header-content {
                position: relative;
                z-index: 1;
            }

            .ppvm-logo {
                width: 100px;
                height: auto;
                margin-bottom: 1rem;
            }

            .ppvm-title {
                font-size: 2.5rem;
                margin-bottom: 0.5rem;
                font-weight: 700;
                color: white;
            }

            .ppvm-subtitle {
                font-size: 1.2rem;
                opacity: 0.9;
                color: white;
            }

            .ppvm-main-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 2rem;
                background-color: var(--ppvm-light-color);
            }

            .ppvm-section {
                margin-bottom: 3rem;
                background: white;
                border-radius: 10px;
                padding: 2rem;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                position: relative;
                overflow: hidden;
            }

            .ppvm-section::after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 5px;
                height: 100%;
                background: var(--ppvm-accent-color);
            }

            .ppvm-section-title {
                color: var(--ppvm-primary-color);
                margin-bottom: 1.5rem;
                font-size: 2rem;
                position: relative;
                display: inline-block;
            }

            .ppvm-section-title::after {
                content: "";
                position: absolute;
                bottom: -10px;
                left: 0;
                width: 50px;
                height: 3px;
                background: var(--ppvm-accent-color);
            }

            .ppvm-visi-content {
                font-size: 1.5rem;
                font-weight: 500;
                line-height: 1.8;
                color: var(--ppvm-secondary-color);
                text-align: center;
                padding: 1.5rem;
                border: 2px dashed var(--ppvm-primary-color);
                border-radius: 5px;
                margin: 1rem 0;
                background-color: rgba(44, 120, 108, 0.05);
            }

            .ppvm-misi-list {
                list-style-type: none;
            }

            .ppvm-misi-list li {
                padding: 1rem 1rem 1rem 3rem;
                margin-bottom: 1rem;
                background-color: rgba(44, 120, 108, 0.05);
                border-left: 3px solid var(--ppvm-accent-color);
                position: relative;
                transition: transform 0.3s ease;
                color: #222;
                /* Warna teks lebih gelap */
                font-size: 1.1rem;
                /* Ukuran font lebih besar */
                font-weight: 400;
                /* Ketebalan normal */
                line-height: 1.7;
                /* Jarak baris lebih longgar */
            }

            .ppvm-misi-list li:hover {
                transform: translateX(10px);
            }

            .ppvm-misi-list li::before {
                content: "✓";
                position: absolute;
                left: 1rem;
                top: 1rem;
                color: var(--ppvm-accent-color);
                font-weight: bold;
            }

            .ppvm-quote {
                font-style: italic;
                text-align: center;
                padding: 2rem;
                margin: 2rem 0;
                background: linear-gradient(135deg, rgba(44, 120, 108, 0.1), rgba(0, 68, 69, 0.1));
                border-radius: 10px;
                position: relative;
                color: #333;
                /* Warna teks lebih gelap */
            }

            .ppvm-quote::before,
            .ppvm-quote::after {
                content: '"';
                font-size: 3rem;
                color: var(--ppvm-accent-color);
                opacity: 0.3;
                position: absolute;
            }

            .ppvm-quote::before {
                top: 0;
                left: 1rem;
            }

            .ppvm-quote::after {
                bottom: -1.5rem;
                right: 1rem;
            }

            .ppvm-value-card-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }

            .ppvm-value-card {
                background: rgba(44, 120, 108, 0.1);
                padding: 1.5rem;
                border-radius: 8px;
                text-align: center;
                flex: 1 1 200px;
            }

            .ppvm-value-icon {
                font-size: 2rem;
                color: var(--ppvm-primary-color);
                margin-bottom: 1rem;
            }

            .ppvm-value-title {
                color: var(--ppvm-primary-color);
                margin-bottom: 0.5rem;
            }

            .ppvm-value-card p {
                color: #222;
                /* Warna teks lebih gelap */
                font-size: 1rem;
                font-weight: 400;
                /* Ketebalan normal */
                line-height: 1.6;
                /* Jarak baris lebih longgar */
            }

            @media (max-width: 768px) {
                .ppvm-title {
                    font-size: 2rem;
                }

                .ppvm-visi-content {
                    font-size: 1.2rem;
                    padding: 1rem;
                }

                .ppvm-main-container {
                    padding: 1rem;
                }

                .ppvm-section {
                    padding: 1.5rem;
                }

                .ppvm-misi-list li {
                    font-size: 1rem;
                    /* Ukuran font mobile */
                }
            }
        </style>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <div class="ppvm-main-container">
            <section class="ppvm-section">
                <h2 class="ppvm-section-title"><i class="fas fa-binoculars"></i> Visi Pesantren</h2>
                <div class="ppvm-visi-content">
                    "Mencetak Kader Bangsa Yang Berlandaskan Wawasan Dan Pengetahuan Ke-islaman"
                </div>
                <div class="ppvm-quote">
                    "Sebaik-baik kalian adalah yang mempelajari Al-Qur'an dan mengajarkannya" <br>
                    <strong>(HR. Bukhari)</strong>
                </div>
            </section>

            <section class="ppvm-section">
                <h2 class="ppvm-section-title"><i class="fas fa-bullseye"></i> Misi Pesantren</h2>
                <ul class="ppvm-misi-list">
                    <li>Membentuk pribadi muslim yang berbekal ilmu pengetahuan dan teknologi yang disertai dengan iman dan
                        takwa.</li>
                    <li>Mengimplementasikan serta mengamalkan nilai-nilai yang terkandung dalam kitab suci Al-Qur'an dan
                        sunnah-sunnah Rasulullah SAW.</li>
                </ul>
            </section>

            <section class="ppvm-section">
                <h2 class="ppvm-section-title"><i class="fas fa-star"></i> Nilai-nilai Pesantren</h2>
                <div class="ppvm-value-card-container">
                    <div class="ppvm-value-card">
                        <i class="fas fa-quran ppvm-value-icon"></i>
                        <h3 class="ppvm-value-title">Qur'ani</h3>
                        <p>Al-Qur'an sebagai pedoman utama dalam kehidupan</p>
                    </div>

                    <div class="ppvm-value-card">
                        <i class="fas fa-hands-helping ppvm-value-icon"></i>
                        <h3 class="ppvm-value-title">Akhlak Mulia</h3>
                        <p>Meneladani akhlak Rasulullah SAW dalam kehidupan sehari-hari</p>
                    </div>

                    <div class="ppvm-value-card">
                        <i class="fas fa-lightbulb ppvm-value-icon"></i>
                        <h3 class="ppvm-value-title">Ilmu Bermanfaat</h3>
                        <p>Mencari ilmu yang bermanfaat untuk dunia dan akhirat</p>
                    </div>

                    <div class="ppvm-value-card">
                        <i class="fas fa-users ppvm-value-icon"></i>
                        <h3 class="ppvm-value-title">Ukhuwah Islamiyah</h3>
                        <p>Mempererat persaudaraan sesama muslim</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
