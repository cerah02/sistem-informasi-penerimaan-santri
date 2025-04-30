@extends('layout_landingpage')

@section('title', 'Pengumuman Kelulusan Santri')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Amiri:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        /* Reset Styles dengan Prefix Unik */
        .pengumuman-santri-reset {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Base Styles */
        body.pengumuman-santri-body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f5f0;
            color: #2c3e50;
            line-height: 1.8;
            background-image: url('https://example.com/arabesque-pattern.png');
            background-blend-mode: overlay;
            background-size: 300px;
            background-opacity: 0.05;
        }

        /* Container Utama */
        .pengumuman-santri-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .pengumuman-santri-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            padding: 2rem 0;
        }

        .pengumuman-santri-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 3px;
            background: linear-gradient(90deg, #2ecc71, #27ae60);
        }

        .pengumuman-santri-title {
            font-family: 'Amiri', serif;
            font-size: 2.8rem;
            color: #27ae60;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .pengumuman-santri-subtitle {
            color: #7f8c8d;
            font-weight: 300;
            font-size: 1.2rem;
        }

        /* Card Pengumuman */
        .pengumuman-santri-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            margin-bottom: 3rem;
            border-left: 5px solid #27ae60;
            position: relative;
            overflow: hidden;
        }

        .pengumuman-santri-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: url('https://example.com/islamic-pattern.png') no-repeat;
            background-size: contain;
            opacity: 0.1;
        }

        .pengumuman-santri-card-title {
            font-family: 'Amiri', serif;
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .pengumuman-santri-card-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: #27ae60;
        }

        /* Tabel Hasil Kelulusan */
        .pengumuman-santri-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            font-size: 0.95rem;
        }

        .pengumuman-santri-table thead {
            background-color: #27ae60;
            color: white;
        }

        .pengumuman-santri-table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        .pengumuman-santri-table td {
            padding: 1rem;
            border-bottom: 1px solid #ecf0f1;
        }

        .pengumuman-santri-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .pengumuman-santri-table tr:hover {
            background-color: #f1f8e9;
        }

        .pengumuman-santri-status-lulus {
            color: #27ae60;
            font-weight: 600;
        }

        .pengumuman-santri-status-tidak-lulus {
            color: #e74c3c;
            font-weight: 600;
        }

        /* Pencarian */
        .pengumuman-santri-search {
            margin-bottom: 2rem;
            position: relative;
        }

        .pengumuman-santri-search input {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 1px solid #ddd;
            border-radius: 50px;
            font-size: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .pengumuman-santri-search input:focus {
            outline: none;
            border-color: #27ae60;
            box-shadow: 0 2px 15px rgba(46, 204, 113, 0.2);
        }

        .pengumuman-santri-search::after {
            content: '\1F50D';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: #7f8c8d;
        }

        /* Footer */
        .pengumuman-santri-footer {
            text-align: center;
            margin-top: 3rem;
            padding: 2rem 0;
            color: #7f8c8d;
            font-size: 0.9rem;
            border-top: 1px solid #ecf0f1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pengumuman-santri-title {
                font-size: 2rem;
            }

            .pengumuman-santri-card {
                padding: 1.5rem;
            }

            .pengumuman-santri-table {
                font-size: 0.85rem;
            }

            .pengumuman-santri-table th,
            .pengumuman-santri-table td {
                padding: 0.75rem 0.5rem;
            }
        }

        /* Animasi */
        @keyframes pengumuman-santri-fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pengumuman-santri-card {
            animation: pengumuman-santri-fadeIn 0.6s ease-out;
        }
    </style>
    </head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Amiri:wght@400;700&display=swap"
        rel="stylesheet">

    <style>
        body.pengumuman-santri-body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
        }

        .pengumuman-santri-container {
            max-width: 960px;
            margin: auto;
            padding: 20px;
        }

        .pengumuman-santri-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .pengumuman-santri-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .pengumuman-santri-subtitle {
            font-size: 18px;
            color: #555;
        }

        .pengumuman-santri-search {
            text-align: center;
            margin-bottom: 20px;
        }

        .pengumuman-santri-search input {
            width: 60%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .pengumuman-santri-card {
            margin-bottom: 40px;
        }

        .pengumuman-santri-card-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .pengumuman-santri-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
        }

        .pengumuman-santri-table th,
        .pengumuman-santri-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .pengumuman-santri-status-lulus {
            color: green;
            font-weight: bold;
        }

        .pengumuman-santri-status-tidak-lulus {
            color: red;
            font-weight: bold;
        }

        .pengumuman-santri-footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #888;
        }

        .not-found {
            text-align: center;
            color: red;
            margin-top: 20px;
            display: none;
        }
    </style>

    <body class="pengumuman-santri-body">

        <div class="pengumuman-santri-container">
            <header class="pengumuman-santri-header">
                <h1 class="pengumuman-santri-title">Pengumuman Kelulusan</h1>
                <p class="pengumuman-santri-subtitle">Tahun Ajaran 1445 H / 2024 M</p>
            </header>

            <div class="pengumuman-santri-search">
                <input type="text" id="searchInput" placeholder="Cari nama santri">
            </div>

            <p id="notFoundMessage" class="not-found">Data tidak ditemukan.</p>

            @php
                $grouped = $data_pengumuman->groupBy('jenjang');
            @endphp

            @foreach ($grouped as $jenjang => $santris)
                <div class="pengumuman-santri-card">
                    <h2 class="pengumuman-santri-card-title">Jenjang: {{ strtoupper($jenjang) }}</h2>

                    <table class="pengumuman-santri-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Santri</th>
                                <th>Jenjang</th>
                                <th>Rata-Rata Nilai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($santris as $index => $santri)
                                <tr class="santri-row">
                                    <td>{{ $index + 1 }}</td>
                                    <td class="nama-santri">{{ $santri['nama_santri'] }}</td>
                                    <td>{{ $santri['jenjang'] }}</td>
                                    <td>{{ $santri['rata_rata'] }}</td>
                                    <td
                                        class="{{ $santri['status_kelulusan'] == 'Lulus' ? 'pengumuman-santri-status-lulus' : 'pengumuman-santri-status-tidak-lulus' }}">
                                        {{ strtoupper($santri['status_kelulusan']) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach

            <div class="pengumuman-santri-card">
                <h2 class="pengumuman-santri-card-title">{{ $pengumuman->judul }}</h2>
                <p>{!! nl2br(e($pengumuman->konten)) !!}</p>
            </div>

            <footer class="pengumuman-santri-footer">
                <p>© 2025 Pondok Pesantren Darul Muttaqien | Pengumuman Kelulusan Santri Baru</p>
            </footer>
        </div>

        <script>
            const searchInput = document.getElementById('searchInput');
            const notFoundMessage = document.getElementById('notFoundMessage');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('.santri-row');
                let found = false;
                let firstVisibleRow = null;

                rows.forEach(row => {
                    const namaSantri = row.querySelector('.nama-santri').textContent.toLowerCase();
                    if (namaSantri.includes(searchTerm)) {
                        row.style.display = '';
                        if (!firstVisibleRow) firstVisibleRow = row;
                        found = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (!found) {
                    notFoundMessage.style.display = 'block';
                } else {
                    notFoundMessage.style.display = 'none';
                    if (firstVisibleRow) {
                        firstVisibleRow.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
            });
        </script>
    </body>
@endsection
