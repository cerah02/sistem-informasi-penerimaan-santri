<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pon-Pes Darul Muttaqien</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Pondok Pesantren Darul Muttaqien, Pendidikan Islam, Generasi Qur'ani" name="keywords">
    <meta
        content="Pondok Pesantren Darul Muttaqien adalah lembaga pendidikan Islam yang berkomitmen mencetak generasi Qur'ani."
        name="description">

    <!-- Favicon -->
    <img href="/landing_assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="icon" type="image/png" href="/assets/img/logo_pondok.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="/landing_assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/landing_assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/landing_assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/landing_assets/css/style.css" rel="stylesheet">
</head>

<style>
    /* Efek Spinner */
    #spinner {
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.8);
        z-index: 9999;
    }

    /* Teks Jam dan Tanggal */
    .date-time {
        background: linear-gradient(45deg, #ffcc00, #d4af37, #b8860b);
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 1rem;
        color: #fff;
        text-shadow: 0 0 8px rgba(255, 204, 0, 0.8);
    }

    /* Efek Scrolling Teks */
    .scrolling-container {
        width: 80%;
        overflow: hidden;
        position: relative;
    }

    .scrolling-text {
        display: inline-block;
        white-space: nowrap;
        animation: scrollText 10s linear infinite;
    }

    .scrolling-text .char {
        display: inline-block;
        font-weight: bold;
        color: white;
        text-transform: uppercase;
        opacity: 0;
        animation: fadeInOut 0.5s forwards;
    }

    @keyframes scrollText {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    @keyframes fadeInOut {
        0% {
            opacity: 0;
            transform: translateX(20px);
        }

        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Bayangan lembut untuk header */
    .container-fluid {
        font-size: 16px;
        box-shadow: 0 2px 10px rgba(255, 204, 0, 0.4);
    }

    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=Poppins:wght@600&display=swap');

    /* Ukuran dan Efek Logo */
    .logo-img {
        width: 80px;
        height: auto;
        transition: transform 0.3s ease-in-out;
    }

    .logo-img:hover {
        filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.8));
        transform: scale(1.1);
    }

    /* Container untuk Heading */
    .heading {
        position: relative;
        width: fit-content;
    }

    /* Efek pada teks utama */
    .small-heading {
        position: relative;
        font-size: clamp(1rem, 5vw, 2.5rem);
        text-transform: uppercase;
        color: #d4af37;
        background: linear-gradient(90deg, #ffcc00, #d4af37, #b8860b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
        overflow: hidden;
        white-space: nowrap;
    }

    /* Efek Reveal pada Teks Arab */
    .small-heading .arabic {
        font-family: 'Amiri', serif;
        font-size: 1.2em;
        display: block;
        position: relative;
    }

    .small-heading .arabic::before {
        content: attr(data-text);
        position: absolute;
        top: 0;
        left: 0;
        width: 20%;
        height: 100%;
        color: #ffcc00;
        -webkit-text-stroke: 0.8px #ffcc00;
        border-right: 2px solid #ffcc00;
        overflow: hidden;
        white-space: nowrap;
        animation: reveal 4s alternate ease-in-out infinite;
    }

    /* Efek Reveal pada Teks Latin */
    .small-heading .latin {
        font-family: 'Poppins', sans-serif;
        font-size: 0.7em;
        color: white;
        display: block;
        position: relative;
    }

    .small-heading .latin::before {
        content: attr(data-span);
        position: absolute;
        top: 0;
        left: 0;
        width: 0%;
        height: 100%;
        color: #ffcc00;
        -webkit-text-stroke: 0.6px #ffcc00;
        overflow: hidden;
        white-space: nowrap;
        animation: reveal 4s alternate ease-in-out infinite;
    }

    /* Animasi Reveal */
    @keyframes reveal {
        0% {
            width: 0%;
        }

        100% {
            width: 50%;
        }
    }

    /* style tombol css */
    button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 0 10px;
        color: white;
        text-shadow: 2px 2px rgb(116, 116, 116);
        text-transform: uppercase;
        cursor: pointer;
        border: solid 2px black;
        letter-spacing: 1px;
        font-weight: 600;
        font-size: 17px;
        background-color: hsl(49deg 98% 60%);
        border-radius: 50px;
        position: relative;
        overflow: hidden;
        transition: all 0.5s ease;
    }

    button:active {
        transform: scale(0.9);
        transition: all 100ms ease;
    }

    button png {
        transition: all 0.5s ease;
        z-index: 2;
    }

    .play {
        transition: all 0.5s ease;
        transition-delay: 300ms;
    }

    button:hover png {
        transform: scale(3) translate(50%);
    }

    .now {
        position: absolute;
        left: 0;
        transform: translateX(-100%);
        transition: all 0.5s ease;
        z-index: 2;
    }

    button:hover .now {
        transform: translateX(10px);
        transition-delay: 300ms;
    }

    button:hover .play {
        transform: translateX(200%);
        transition-delay: 300ms;
    }

    button img {
        width: 36px;
        height: 36px;
        transition: all 0.5s ease;
    }

    button:hover img {
        transform: scale(1.2);
    }

    .card img {
        height: 25px;
        width: 25px;
        transition: transform 0.25s;
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: row;
        /* Pastikan ikon berjajar horizontal */
        align-items: center;
        justify-content: center;
        background: #e7e7e7;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        overflow: hidden;
        height: 50px;
        width: auto;
        /* Sesuaikan lebar otomatis */
        padding: 0 10px;
        /* Tambahkan padding */
    }

    .card::before,
    .card::after {
        position: absolute;
        display: flex;
        align-items: center;
        width: 50%;
        height: 100%;
        transition: 0.25s linear;
        z-index: 1;
    }

    .card::before {
        content: "";
        left: 0;
        justify-content: flex-end;
        background-color: #4CAF50;
        /* Hijau Soft */
    }

    .card::after {
        content: "";
        right: 0;
        justify-content: flex-start;
        background-color: #45a049;
        /* Hijau Soft Lebih Gelap */
    }

    .card:hover {
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }

    .card:hover span {
        opacity: 0;
        z-index: -3;
    }

    .card:hover::before {
        opacity: 0.5;
        transform: translateY(-100%);
    }

    .card:hover::after {
        opacity: 0.5;
        transform: translateY(100%);
    }

    .card span {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: whitesmoke;
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        /* Ukuran font diperkecil */
        font-weight: 700;
        opacity: 1;
        transition: opacity 0.25s;
        z-index: 2;
    }

    .card .social-link {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: auto;
        /* Lebar otomatis */
        height: 100%;
        color: whitesmoke;
        font-size: 24px;
        text-decoration: none;
        transition: 0.25s;
        margin: 0 5px;
        /* Jarak antar ikon */
    }

    .card .social-link:hover {
        background-color: rgba(249, 244, 255, 0.774);
        animation: bounce_613 0.4s linear;
    }

    @keyframes bounce_613 {
        40% {
            transform: scale(1.4);
        }

        60% {
            transform: scale(0.8);
        }

        80% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    .agenda-section {
        max-width: 400px;
    }

    .agenda-section h3 {
        color: teal;
        margin-bottom: 15px;
    }

    .agenda-item {
        display: flex;
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
    }

    .date-box {
        background: teal;
        color: white;
        text-align: center;
        padding: 10px;
        width: 60px;
        border-radius: 5px;
        margin-right: 10px;
    }

    .date-box .date {
        font-size: 18px;
        font-weight: bold;
    }

    .date-box .month {
        font-size: 12px;
    }

    .agenda-info {
        display: flex;
        flex-direction: column;
    }

    .time {
        background: teal;
        color: white;
        padding: 2px 5px;
        font-size: 12px;
        border-radius: 3px;
        width: fit-content;
    }

    .status {
        font-size: 12px;
        color: gray;
    }
</style>

<script>
    // scrip header //
    function updateClockAndDate() {
        const now = new Date();

        // Format Waktu (24 jam)
        let hours = now.getHours().toString().padStart(2, '0');
        let minutes = now.getMinutes().toString().padStart(2, '0');
        let seconds = now.getSeconds().toString().padStart(2, '0');

        let timeString = `${hours}:${minutes}:${seconds}`;
        document.getElementById("liveClock").textContent = timeString;

        // Format Hari dan Tanggal
        const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Desember"
        ];

        let day = days[now.getDay()];
        let date = now.getDate();
        let month = months[now.getMonth()];
        let year = now.getFullYear();

        let dateString = `${day}, ${date} ${month} ${year}`;
        document.getElementById("liveDate").textContent = dateString;
    }

    // Perbarui setiap detik
    setInterval(updateClockAndDate, 1000);
    updateClockAndDate();
    // end scrip header //
</script>

<body>

    <body>
        <div class="container-fluid bg-dark text-white py-2 shadow-lg">
            @include('header')
            @include('navbar')
        </div>

        <main class="container mt-4">
            @yield('content')
        </main>

        <div class="container-fluid bg-dark text-white py-2 shadow-lg">
            @include('footer')
        </div>


        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/landing_assets/lib/wow/wow.min.js"></script>
        <script src="/landing_assets/lib/easing/easing.min.js"></script>
        <script src="/landing_assets/lib/waypoints/waypoints.min.js"></script>
        <script src="/landing_assets/lib/counterup/counterup.min.js"></script>
        <script src="/landing_assets/lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="/landing_assets/js/main.js"></script>
    </body>
