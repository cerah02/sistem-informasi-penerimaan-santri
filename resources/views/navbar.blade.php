<!-- Navbar Start -->
<div class="container-fluid sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-lg-0 px-lg-3">
            <a href="index.html" class="navbar-brand d-lg-none">
                <h1 class="text-primary m-0">Darul<span class="text-dark">Muttaqien</span></h1>
            </a>
            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="/beranda" class="nav-item nav-link active">Beranda</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profile
                            Pesantren</a>
                        <div class="dropdown-menu bg-light m-0">
                            <a href="/sejarah" class="dropdown-item">Sejarah Pesantren</a>
                            <a href="/visi-misi" class="dropdown-item">Visi & Misi</a>
                            <a href="/jenjang" class="dropdown-item">Jenjang Pendidikan</a>
                            <a href="{{ route('tampilan_fasilitas') }}" class="dropdown-item">Fasilitas</a>
                            <a href="{{ route('guru.tampilan') }}" class="dropdown-item">Tenaga Pengajar</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Contoh
                            Pakaian</a>
                        <div class="dropdown-menu bg-light m-0">
                            <a href="/pakaian-putra" class="dropdown-item">Pakaian Putra</a>
                            <a href="/pakaian-putri" class="dropdown-item">Pakaian Putri</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Kegiatan</a>
                        <div class="dropdown-menu bg-light m-0">
                            <a href="/kegiatan-harian" class="dropdown-item">Kegiatan Harian</a>
                            <a href="team.html" class="dropdown-item">Bulanan</a>
                            <a href="team.html" class="dropdown-item">Tahunan</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pendaftaran
                            Santri Baru</a>
                        <div class="dropdown-menu bg-light m-0">
                            <a href="feature.html" class="dropdown-item">Pendaftaran Santri Baru</a>
                            <a href="team.html" class="dropdown-item">Brosur Pendaftaran</a>
                            <a href="login" class="dropdown-item">Pendaftaran Online</a>
                            <a href="{{ route('login') }}" class="dropdown-item">Pengumuman</a>
                        </div>
                    </div>
                    <a href="{{ route('login') }}" class="nav-item nav-link">Pengumuman</a>
                </div>
                <div class="ms-auto d-none d-lg-flex">
                    <div class="card">
                        <span>Hubungi Kami</span>
                        <a class="social-link" href="https://wa.me/6285609566926" target="_blank">
                            <img src="https://img.icons8.com/fluency/48/whatsapp.png" alt="WhatsApp" />
                        </a>
                        <a class="social-link" href="https://www.facebook.com/profile.php?id=100026084807336"
                            target="_blank">
                            <img src="https://img.icons8.com/fluency/48/facebook-new.png" alt="Facebook" />
                        </a>
                        <a class="social-link" href="https://www.instagram.com/ppdm_muarabaru?igsh=OG9jeGZsYm5vMG5j"
                            target="_blank">
                            <img src="https://img.icons8.com/fluency/48/instagram-new.png" alt="Instagram" />
                        </a>
                        <a class="social-link"
                            href="https://youtube.com/@santridarulmuttaqienmuarab2001?si=2POThxOSokpPSXIK"
                            target="_blank">
                            <img src="https://img.icons8.com/fluency/48/youtube-play.png" alt="YouTube" />
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
