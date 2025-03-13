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