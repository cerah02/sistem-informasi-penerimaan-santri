<!-- Footer Start -->
<footer id="kontak" class="pesantren-footer">
    <div class="pesantren-footer-content">
        <div>
            <h4>Pon-Pes Darul Muttaqien</h4>
            <p>Mencetak Kader Bangsa Yang Berlandaskan Wawasan Dan Pengetahuan Ke-Islaman</p>
        </div>

        <div>
            <h4 class="pesantren-footer-title">Kontak Kami</h4>
            <p><i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i> Jl. Pratu Abraham No.17 Desa Muara
                Baru, Kec. Kayuagung Kab.OKI, Sum-Sel 30618
            </p>
            <p><i class="fas fa-phone" style="margin-right: 10px;"></i> 0819 5141 115</p>
            <p><i class="fas fa-envelope" style="margin-right: 10px;"></i> ppdm2019@gmail.com</p>

            <div class="pesantren-social-links">
                <a href="https://www.facebook.com/profile.php?id=100026084807336" target="_blank"
                    class="pesantren-social-link"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/ppdm_muarabaru?igsh=OG9jeGZsYm5vMG5j" target="_blank"
                    class="pesantren-social-link"><i class="fab fa-instagram"></i></a>
                <a href="https://youtube.com/@santridarulmuttaqienmuarab2001?si=2POThxOSokpPSXIK" target="_blank"
                    class="pesantren-social-link"><i class="fab fa-youtube"></i></a>
                <a href="https://wa.me/6285609566926" target="_blank" class="pesantren-social-link"><i
                        class="fab fa-whatsapp"></i></a>
            </div>
        </div>

        <div class="agenda-section">
            <h4>Agenda</h4>

            @if (isset($agendaFooter) && count($agendaFooter) > 0)
                @foreach ($agendaFooter as $item)
                    <div class="agenda-item" onclick="showAgendaImage('{{ asset($item->foto_agenda) }}')">
                        <div class="date-box">
                            <span class="date">{{ \Carbon\Carbon::parse($item->tanggal_agenda)->format('d') }}</span>
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

    <div class="pesantren-copyright">
        <p>&copy; 2025 Pondok Pesantren Darul Muttaqien. Seluruh hak cipta dilindungi.</p>
    </div>
</footer>

<!-- Popup Modal untuk Foto Agenda -->
<div id="agendaModal" class="modal">
    <span class="close" onclick="closeAgendaImage()">&times;</span>
    <img class="modal-content" id="agendaImage" src="">
</div>

<!-- CSS Footer -->
<style>
    /* ======== Footer Styles ======== */
    /* Footer */
    .pesantren-footer {
        background-color: var(--pesantren-dark);
        color: white;
        padding: 4rem 0 2rem;
        position: relative;
    }

    .pesantren-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 10px;
        background: linear-gradient(to right,
                var(--pesantren-accent),
                var(--pesantren-secondary));
    }

    .pesantren-footer-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 3rem;
    }

    .pesantren-footer-logo {
        width: 180px;
        margin-bottom: 1.5rem;
    }

    .pesantren-footer-title {
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        color: var(--pesantren-accent);
        font-weight: 600;
    }

    .pesantren-social-links {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .pesantren-social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: white;
        transition: all 0.3s ease;
    }

    .pesantren-social-link:hover {
        background-color: var(--pesantren-accent);
        color: var(--pesantren-dark);
        transform: translateY(-3px);
    }

    .pesantren-copyright {
        text-align: center;
        padding-top: 3rem;
        margin-top: 3rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .pesantren-footer-content h4 {
        display: block;
        color: white;
        font-size: 25px;
        font-weight: 600;
        /* tambah ketebalan huruf */
        letter-spacing: 1px;
        text-transform: uppercase;
        font-family: 'Poppins', sans-serif;
        /* huruf modern dan tegas */
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        /* bayangan biar makin stand out */
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        max-width: 80%;
        max-height: 80%;
        object-fit: contain;
        border: 3px solid var(--pesantren-accent);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    .close {
        position: absolute;
        top: 20px;
        right: 30px;
        color: white;
        font-size: 35px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .close:hover {
        color: var(--pesantren-accent);
        transform: scale(1.2);
    }
</style>

<!-- JavaScript untuk Modal -->
<script>
    function showAgendaImage(imageUrl) {
        let modal = document.getElementById("agendaModal");
        let img = document.getElementById("agendaImage");

        if (imageUrl && imageUrl.trim() !== "") {
            img.src = imageUrl;
            modal.style.display = "flex";
            document.body.style.overflow = "hidden"; // Mencegah scroll
        }
    }

    function closeAgendaImage() {
        let modal = document.getElementById("agendaModal");
        let img = document.getElementById("agendaImage");

        modal.style.display = "none";
        img.src = "";
        document.body.style.overflow = "auto"; // Mengembalikan scroll
    }

    // Tutup modal jika mengklik di luar gambar
    window.onclick = function(event) {
        let modal = document.getElementById("agendaModal");
        if (event.target == modal) {
            closeAgendaImage();
        }
    }
</script>
