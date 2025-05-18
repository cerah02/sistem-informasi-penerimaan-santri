<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Santri</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .kop-surat {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px double #333;
            padding-bottom: 15px;
        }

        .kop-surat img {
            height: 80px;
            margin-bottom: 5px;
        }

        .kop-surat h1 {
            font-size: 16px;
            margin: 5px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .kop-surat p {
            margin: 2px 0;
            font-size: 12px;
        }

        .judul-laporan {
            text-align: center;
            margin: 15px 0;
            font-size: 14px;
            font-weight: bold;
            text-decoration: underline;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            width: 100%;
            text-align: right;
        }

        .footer p {
            margin: 5px 0;
        }

        .tanggal {
            text-align: right;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        @php
            $logo = base64_encode(file_get_contents(public_path('assets/img/logo_pondok.png')));
        @endphp

        <img src="data:image/png;base64,{{ $logo }}" alt="Logo Pondok" style="height: 100px;">
        <h1>PONDOK PESANTREN DARUL MUTTAQIEN</h1>
        <p>Jl. Pratu Abraham No. 17 Desa Muara Baru Kec. kayuagung, Ogan Komering Ilir, Sum-Sel 30618</p>
        <p>Telp. (+62) 81281976980 | Email: ppdm2019@gmail.com</p>
    </div>

    <!-- Judul Laporan -->
    <div class="judul-laporan">
        LAPORAN DATA PENDAFTARAN SANTRI
    </div>

    <!-- Filter Info -->
    <div class="tanggal">
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
        @if ($jenjang)
            <p>Jenjang Pendidikan: <strong>{{ $jenjang }}</strong></p>
        @endif
    </div>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>NISN</th>
                <th>TTL</th>
                <th>Jenjang</th>
                <th>Tahun Masuk</th>
                <th>Tanggal Daftar</th>
                <th>Status Daftar</th>
                <th>Nilai</th>
                <th>Status Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($santris as $i => $santri)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $santri->nama }}</td>
                    <td>{{ $santri->nisn ?? '-' }}</td>
                    <td>{{ $santri->ttl ?? '-' }}</td>
                    <td>{{ $santri->jenjang_pendidikan }}</td>
                    <td>{{ $santri->tahun_masuk ?? '-' }}</td>
                    <td>{{ optional($santri->pendaftaran)->tanggal_pendaftaran ?? '-' }}</td>
                    <td>{{ optional($santri->pendaftaran)->status ?? '-' }}</td>
                    <td>{{ optional($santri->totalHasil)->rata_rata ? number_format(optional($santri->totalHasil)->rata_rata, 2) : '-' }}
                    </td>
                    <td>{{ optional($santri->totalHasil)->status ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Muara Baru, {{ date('d F Y') }}</p>
        <br><br><br>
        <p>_________________________</p>
        <p>Pimpinan Pondok</p>
    </div>
</body>

</html>
