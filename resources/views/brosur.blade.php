@extends('layout_landingpage')

@section('title', 'Brosur Pondok Pesantren Darul Muttaqien')

@section('content')
    <title>Brosur Pendaftaran Santri Pondok Pesantren Darul Muttaqien</title>
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Scheherazade+New:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f7e9 0%, #e6f3ff 100%);
            color: #333;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            text-align: center;
            padding: 30px 0;
            background: linear-gradient(to right, #1a5d1a 0%, #2e7d32 100%);
            border-radius: 15px 15px 0 0;
            color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 L0,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.3;
        }

        .logo {
            font-size: 70px;
            margin-bottom: 15px;
            color: #ffd700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-family: 'Scheherazade New', serif;
            font-size: 3.5rem;
            margin-bottom: 10px;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 20px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .tagline {
            font-size: 1.1rem;
            font-style: italic;
            background: rgba(0, 0, 0, 0.2);
            display: inline-block;
            padding: 10px 25px;
            border-radius: 30px;
            margin-top: 15px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 30px;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h2 {
            font-family: 'Scheherazade New', serif;
            color: #1a5d1a;
            font-size: 2.2rem;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #e0f7e0;
        }

        .info-section {
            background: linear-gradient(to bottom right, #ffffff, #f0f7e9);
        }

        .features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .feature {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .feature i {
            font-size: 1.8rem;
            color: #2e7d32;
            margin-right: 15px;
            min-width: 40px;
        }

        .feature h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
            color: #1a5d1a;
        }

        .feature p {
            font-size: 0.95rem;
            color: #555;
        }

        .form-section {
            background: linear-gradient(to bottom right, #ffffff, #e6f3ff);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #1a5d1a;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
            font-family: 'Poppins', sans-serif;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #2e7d32;
            outline: none;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.2);
        }

        button {
            background: linear-gradient(to right, #1a5d1a 0%, #2e7d32 100%);
            color: white;
            border: none;
            padding: 16px 35px;
            font-size: 1.1rem;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            background: linear-gradient(to right, #2e7d32 0%, #1a5d1a 100%);
        }

        .testimonials {
            grid-column: 1 / -1;
            margin-top: 30px;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .testimonial {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #2e7d32;
        }

        .testimonial p {
            font-style: italic;
            margin-bottom: 15px;
            color: #444;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
        }

        .testimonial-author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            background: #e0f7e0;
            padding: 5px;
        }

        .author-info h4 {
            color: #1a5d1a;
            font-size: 1.1rem;
        }

        .author-info p {
            font-style: normal;
            font-size: 0.9rem;
            color: #777;
            margin: 0;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
            margin-top: 30px;
            padding: 30px;
            background: #2e7d32;
            border-radius: 0 0 15px 15px;
            color: white;
        }

        .contact-item {
            display: flex;
            align-items: center;
            font-size: 1.1rem;
        }

        .contact-item i {
            font-size: 1.8rem;
            margin-right: 15px;
            color: #ffd700;
        }

        .map {
            grid-column: 1 / -1;
            height: 350px;
            background: #e9e9e9;
            border-radius: 15px;
            overflow: hidden;
            margin-top: 30px;
            position: relative;
        }

        .map-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(30, 87, 34, 0.7), rgba(30, 87, 34, 0.9));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .map-overlay h3 {
            font-size: 2.2rem;
            margin-bottom: 15px;
            font-family: 'Scheherazade New', serif;
        }

        .map-overlay p {
            max-width: 600px;
            font-size: 1.1rem;
        }

        footer {
            text-align: center;
            padding: 30px 0;
            color: #666;
            font-size: 0.9rem;
        }

        .highlight {
            color: #2e7d32;
            font-weight: 600;
        }

        .pendaftaran-info {
            background: #fff8e1;
            padding: 20px;
            border-radius: 10px;
            margin: 25px 0;
            border-left: 4px solid #ffd700;
        }

        .pendaftaran-info h3 {
            color: #1a5d1a;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .pendaftaran-info h3 i {
            margin-right: 10px;
            color: #2e7d32;
        }

        @media (max-width: 900px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .features {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 2.8rem;
            }

            .subtitle {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 600px) {
            header {
                padding: 20px 15px;
            }

            h1 {
                font-size: 2.2rem;
            }

            .logo {
                font-size: 50px;
            }

            .contact-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
        }
    </style> --}}
    </head>

    <body>
        <div class="container">
            <header>
                <div class="logo">
                    <i class="fas fa-mosque"></i>
                </div>
                <h1>Pondok Pesantren Darul Muttaqien</h1>
                <div class="subtitle">Membentuk Generasi Qur'ani yang Berakhlak Mulia dan Berwawasan Global</div>
                <div class="tagline">"Sebaik-baik kalian adalah yang mempelajari Al-Qur'an dan mengajarkannya" (HR. Bukhari)
                </div>
            </header>

            <div class="pendaftaran-info">
                <h3><i class="fas fa-calendar-check"></i> Pendaftaran Santri Baru Tahun Ajaran 2024/2025</h3>
                <p><span class="highlight">Periode Pendaftaran:</span> 1 Juli 2024 - 30 September 2024</p>
                <p><span class="highlight">Tes Seleksi:</span> 5 Oktober 2024</p>
                <p><span class="highlight">Pengumuman:</span> 12 Oktober 2024</p>
                <p><span class="highlight">Awal Masuk:</span> 1 November 2024</p>
            </div>

            {{-- <div class="main-content">
                <div class="card info-section">
                    <h2><i class="fas fa-star-and-crescent"></i> Keunggulan Pesantren</h2>
                    <p>Pondok Pesantren Darul Muttaqien telah berdiri sejak 1985 dengan komitmen mencetak generasi Qur'ani
                        yang berakhlak mulia, berwawasan luas, dan mandiri.</p>

                    <div class="features">
                        <div class="feature">
                            <i class="fas fa-book-quran"></i>
                            <div>
                                <h3>Pendidikan Al-Qur'an</h3>
                                <p>Program tahfidz dengan metode terbaik dan bimbingan ustadz/ustadzah berpengalaman.</p>
                            </div>
                        </div>

                        <div class="feature">
                            <i class="fas fa-graduation-cap"></i>
                            <div>
                                <h3>Kurikulum Terpadu</h3>
                                <p>Kurikulum nasional dipadukan dengan pendidikan agama dan pembinaan karakter.</p>
                            </div>
                        </div>

                        <div class="feature">
                            <i class="fas fa-users"></i>
                            <div>
                                <h3>Pengasuhan Intensif</h3>
                                <p>Sistem asrama dengan bimbingan ustadz/ustadzah 24 jam dan rasio 1:10.</p>
                            </div>
                        </div>

                        <div class="feature">
                            <i class="fas fa-laptop"></i>
                            <div>
                                <h3>Teknologi Pendidikan</h3>
                                <p>Fasilitas modern dan pembelajaran berbasis teknologi untuk persiapan masa depan.</p>
                            </div>
                        </div>
                    </div>

                    <h2 style="margin-top: 30px;"><i class="fas fa-medal"></i> Fasilitas Pesantren</h2>
                    <ul style="padding-left: 25px; margin-top: 15px;">
                        <li>Asrama nyaman dengan kapasitas terbatas</li>
                        <li>Perpustakaan dengan koleksi >10.000 buku</li>
                        <li>Laboratorium sains, bahasa, dan komputer</li>
                        <li>Lapangan olahraga multifungsi</li>
                        <li>Klinik kesehatan 24 jam</li>
                        <li>Kantin dengan makanan sehat dan halal</li>
                        <li>Area Wi-Fi terkendali untuk pembelajaran</li>
                    </ul>
                </div>

                <div class="card form-section">
                    <h2><i class="fas fa-edit"></i> Formulir Pendaftaran</h2>
                    <p>Isi formulir berikut untuk mendaftar sebagai santri baru Pondok Pesantren Darul Muttaqien:</p>

                    <form>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap Santri</label>
                            <input type="text" id="nama" placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="form-group">
                            <label for="ttl">Tempat, Tanggal Lahir</label>
                            <input type="text" id="ttl" placeholder="Contoh: Jakarta, 15 Januari 2010">
                        </div>

                        <div class="form-group">
                            <label for="asal-sekolah">Asal Sekolah</label>
                            <input type="text" id="asal-sekolah" placeholder="Nama sekolah sebelumnya">
                        </div>

                        <div class="form-group">
                            <label for="jenjang">Jenjang yang Dipilih</label>
                            <select id="jenjang">
                                <option value="">Pilih Jenjang Pendidikan</option>
                                <option value="smp">SMP Islam Darul Muttaqien</option>
                                <option value="sma">SMA Islam Darul Muttaqien</option>
                                <option value="tahfidz">Program Tahfidz Al-Qur'an</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="orangtua">Nama Orang Tua/Wali</label>
                            <input type="text" id="orangtua" placeholder="Nama lengkap orang tua/wali">
                        </div>

                        <div class="form-group">
                            <label for="telepon">No. Telepon/WhatsApp</label>
                            <input type="tel" id="telepon" placeholder="Contoh: 081234567890">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea id="alamat" rows="3" placeholder="Alamat tempat tinggal"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="motivasi">Motivasi Masuk Pesantren</label>
                            <textarea id="motivasi" rows="3" placeholder="Jelaskan motivasi masuk pesantren"></textarea>
                        </div>

                        <button type="submit"><i class="fas fa-paper-plane"></i> Kirim Pendaftaran</button>
                    </form>
                </div>

                <div class="card testimonials">
                    <h2><i class="fas fa-comments"></i> Testimoni Alumni</h2>
                    <div class="testimonial-grid">
                        <div class="testimonial">
                            <p>"Pendidikan di Darul Muttaqien tidak hanya mengajarkan ilmu agama, tapi juga membentuk
                                karakter disiplin dan mandiri. Saya sangat berterima kasih pada para ustadz dan ustadzah."
                            </p>
                            <div class="testimonial-author">
                                <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 24 24' fill='%232e7d32'><circle cx='12' cy='8' r='4'/><path d='M20 19v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-1a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6z'/></svg>"
                                    alt="Alumni">
                                <div class="author-info">
                                    <h4>Ahmad Fauzi</h4>
                                    <p>Alumni 2018, Mahasiswa UIN Jakarta</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial">
                            <p>"Metode menghafal Al-Qur'an di Darul Muttaqien sangat efektif. Saya bisa menyelesaikan
                                hafalan 30 juz selama 3 tahun dengan mutqin berkat bimbingan ustadz yang sabar dan
                                profesional."</p>
                            <div class="testimonial-author">
                                <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 24 24' fill='%232e7d32'><circle cx='12' cy='8' r='4'/><path d='M20 19v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-1a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6z'/></svg>"
                                    alt="Alumni">
                                <div class="author-info">
                                    <h4>Siti Aisyah</h4>
                                    <p>Alumni 2020, Tahfidzah dan Guru</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial">
                            <p>"Saya bangga menjadi bagian dari Darul Muttaqien. Selain ilmu agama, saya juga mendapat bekal
                                keterampilan dan wawasan global yang sangat membantu dalam kuliah dan karir saya sekarang."
                            </p>
                            <div class="testimonial-author">
                                <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 24 24' fill='%232e7d32'><circle cx='12' cy='8' r='4'/><path d='M20 19v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-1a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6z'/></svg>"
                                    alt="Alumni">
                                <div class="author-info">
                                    <h4>Rudi Hermawan</h4>
                                    <p>Alumni 2015, Software Engineer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="map">
                <div class="map-overlay">
                    <h3><i class="fas fa-map-marker-alt"></i> Lokasi Pesantren</h3>
                    <p>Jl. Pendidikan No. 123, Desa Ilmu Makmur, Kec. Cendekia, Kab. Bijak Bestari, Jawa Barat 40123</p>
                    <p style="margin-top: 15px;">Lingkungan asri di area seluas 5 hektar dengan fasilitas pendidikan
                        lengkap dan lingkungan yang kondusif untuk belajar dan mengembangkan diri.</p>
                </div>
            </div>

            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <p>(022) 1234-5678</p>
                        <p>0812-3456-7890</p>
                    </div>
                </div>

                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <p>info@darulmuttaqien.sch.id</p>
                        <p>ppdarulmuttaqien@gmail.com</p>
                    </div>
                </div>

                <div class="contact-item">
                    <i class="fab fa-instagram"></i>
                    <div>
                        <p>@darulmuttaqien_pp</p>
                        <p>@ppdarulmuttaqien</p>
                    </div>
                </div>
            </div>

            <footer>
                <p>&copy; 2024 Pondok Pesantren Darul Muttaqien. Semua Hak Dilindungi.</p>
                <p>Mencetak Generasi Qur'ani, Berakhlak Mulia, dan Berwawasan Global</p>
            </footer>
        </div> --}}

        <script>
            // Animasi sederhana untuk formulir
            document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Terima kasih! Pendaftaran Anda telah berhasil dikirim. Tim kami akan segera menghubungi Anda.');
                this.reset();
            });

            // Animasi hover untuk fitur
            const features = document.querySelectorAll('.feature');
            features.forEach(feature => {
                feature.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(10px)';
                });

                feature.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        </script>
    </body>
@endsection
