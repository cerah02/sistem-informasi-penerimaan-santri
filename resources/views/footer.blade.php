<!-- Footer Start -->
<div class="container-fluid footer position-relative bg-primary text-white-50 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5 py-5">
            <!-- Kolom 1: Logo dan Deskripsi -->
            <div class="col-lg-6 pe-lg-5">
                <div class="heading">
                    <h2 data-text="معهددارالمتقين الإسلامى" class="small-heading">
                        <span class="arabic">معهددارالمتقين الإسلامى</span>
                    </h2>
                    <p>pondok pesantren darul muttaqien adalah </p>
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

            <!-- Popup Modal untuk Foto Agenda -->
            <div id="agendaModal" class="modal">
                <span class="close" onclick="closeAgendaImage()">&times;</span>
                <img class="modal-content" id="agendaImage" src="">
            </div>

            <!-- CSS untuk Modal (DIPERBAIKI) -->
            <style>
                /* Modal full screen */
                .modal {
                    display: none;
                    /* Pastikan modal disembunyikan awalnya */
                    position: fixed;
                    z-index: 1050;
                    /* Pastikan modal berada di atas navbar */
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.9);
                    justify-content: center;
                    align-items: center;
                }

                /* Gambar modal */
                .modal-content {
                    max-width: 80%;
                    max-height: 80%;
                    border-radius: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                }

                /* Tombol close */
                .close {
                    position: absolute;
                    top: 15px;
                    right: 25px;
                    color: white;
                    font-size: 35px;
                    font-weight: bold;
                    cursor: pointer;
                }

                /* Agar navbar tersembunyi saat modal muncul */
                body.modal-open {
                    overflow: hidden;
                }

                /* Navbar tidak menghalangi modal */
                .navbar {
                    z-index: 100;
                    /* Supaya navbar tidak di atas modal */
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

            <!-- Footer End -->

{{-- 
            <!-- Copyright Start -->
            <div class="container-fluid copyright bg-dark text-white-50 py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start">
                            <p class="mb-0">&copy; <a href="#">Your Site Name</a>. All Rights Reserved.</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            <p class="mb-0">Designed by <a href="https://htmlcodex.com">HTML Codex</a><br>Distributed
                                by <a href="https://themewagon.com">ThemeWagon</a></p>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Copyright End -->
