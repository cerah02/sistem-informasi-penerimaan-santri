<!-- Footer Start -->
<div class="container-fluid footer position-relative text-white-50 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5 py-5">
            <!-- Kolom 1: Logo dan Deskripsi -->
            <div class="col-lg-6 pe-lg-5">
                <div class="heading">
                    <h2 data-text="معهددارالمتقين الإسلامى" class="small-heading">
                        <span class="arabic">معهددارالمتقين الإسلامى</span>
                    </h2>
                    <p>Pondok Pesantren Darul Muttaqien adalah ...</p>
                </div>
            </div>

            <!-- Kolom 2: Quick Links dan Popular Links -->
            <div class="col-lg-6 ps-lg-5">
                <div class="row g-5">
                    <!-- Quick Links -->
                    <div class="footer-container">
                        <div class="agenda-section">
                            <h3>Agenda</h3>

                            @if (isset($agendaFooter) && count($agendaFooter) > 0)
                                @foreach ($agendaFooter as $item)
                                    <div class="agenda-item"
                                        onclick="showAgendaImage('{{ asset($item->foto_agenda) }}')">
                                        <div class="date-box">
                                            <span
                                                class="date">{{ \Carbon\Carbon::parse($item->tanggal_agenda)->format('d') }}</span>
                                            <span
                                                class="month">{{ \Carbon\Carbon::parse($item->tanggal_agenda)->translatedFormat('M Y') }}</span>
                                        </div>
                                        <div class="agenda-info">
                                            <span class="time">Waktu:
                                                {{ \Carbon\Carbon::parse($item->jam_agenda)->format('H:i') }}</span>
                                            <p>{{ $item->nama_agenda }}</p>
                                            @if (\Carbon\Carbon::parse($item->tanggal_agenda)->isPast())
                                                <span class="status">Agenda telah lewat</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Tidak ada agenda terbaru.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popup Modal untuk Foto Agenda -->
<div id="agendaModal" class="modal">
    <span class="close" onclick="closeAgendaImage()">&times;</span>
    <img class="modal-content" id="agendaImage" src="">
</div>

<!-- CSS Footer -->
<style>
    /* ======== Footer Styles ======== */
    .footer {
        position: relative;
        background: url('/landing_assets/img/footer_pondok.jpg') no-repeat center center;
        background-size: cover;
        /* Bisa diganti 'contain' jika ingin seluruh gambar terlihat */
        background-position: center;
        background-attachment: fixed;
        /* Agar efek paralaks saat scroll */
        min-height: 300px;
        /* Sesuaikan tinggi minimum */
        color: white;
        padding: 50px 0;
    }

    /* Overlay untuk transparansi */
    .footer::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Overlay hitam transparan */
        z-index: 1;
    }

    /* Pastikan konten ada di atas overlay */
    .footer .container {
        position: relative;
        z-index: 2;
    }

    /* Responsif agar gambar footer terlihat lebih baik */
    @media (max-width: 768px) {
        .footer {
            background-size: cover;
            /* Bisa ganti 'contain' jika ingin seluruh gambar terlihat */
            min-height: 250px;
            /* Sesuaikan untuk layar kecil */
        }
    }
</style>

<!-- JavaScript untuk Modal -->
<script>
    function showAgendaImage(imageUrl) {
        let modal = document.getElementById("agendaModal");
        let img = document.getElementById("agendaImage");

        if (imageUrl && imageUrl.trim() !== "") { // Pastikan URL gambar tidak kosong
            img.src = imageUrl; // Set gambar modal sesuai agenda yang diklik
            modal.style.display = "flex"; // Tampilkan modal
            document.body.classList.add("modal-open"); // Hentikan scroll
        }
    }

    function closeAgendaImage() {
        let modal = document.getElementById("agendaModal");
        let img = document.getElementById("agendaImage");

        modal.style.display = "none"; // Sembunyikan modal
        img.src = ""; // Hapus gambar agar tidak muncul otomatis lagi
        document.body.classList.remove("modal-open"); // Kembalikan scroll halaman
    }

    // Pastikan modal tidak muncul otomatis saat halaman dimuat
    window.onload = function() {
        document.getElementById("agendaModal").style.display = "none";
    };
</script>
