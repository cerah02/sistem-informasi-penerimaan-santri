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
<div class="container-fluid bg-dark text-white py-4 d-none d-lg-flex">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <!-- Logo Pondok -->
            <div class="d-flex align-items-center">
                <img class="logo-img me-3" src="/landing_assets/img/logo_pondok.png" alt="Logo Pondok">
                <!-- Nama Pondok dengan Animasi -->
                <div class="heading">
                    <h2 data-text="معهددارالمتقين الإسلامى" class="small-heading">
                        <span class="arabic">معهددارالمتقين الإسلامى</span>
                        <span class="latin" data-span="Pondok Pesantren Darul Muttaqien Al-Islami">
                            Pondok Pesantren Darul Muttaqien Al-Islami
                        </span>
                    </h2>
                </div>
            </div>
            <!-- Tombol Login -->
            <form action="{{ route('login') }}" method="get">
                @csrf
                <button type="submit">
                    <img src="/landing_assets/img/ikon_santri.png" alt="Ikon Masuk">
                    <span class="now">Sekarang!</span>
                    <span class="play">Daftar</span>
                </button>
            </form>
        </div>
    </div>
</div>
