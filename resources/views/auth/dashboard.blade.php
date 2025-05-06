@extends('layout')
@section('content')
    <div class="container">
        {{-- <?php dd(Auth::user()->roles[0]['name']); ?> --}}
        @if (Auth::user()->roles[0]['name'] === 'Admin' || Auth::user()->roles[0]['name'] === 'Guru')
            <div class="row">
                <!-- Card Total Santri -->
                <div class="col-xl-4 col-md-4 mb-4">
                    <div class="card shadow-lg border-0 bg-gradient-info text-white hover-scale h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="fw-bold mb-2">Total Santri Mendaftar</h6>
                                    <h3 class="fw-bold mb-0 text-white">
                                        {{ request('jenjang_filter') || request('year') ? $hitung_santri_byfilter : $jumlah_santri }}
                                    </h3>
                                    <small class="text-light">
                                        {{ request('jenjang_filter') || request('year') ? 'Santri sesuai filter' : 'Total seluruh santri' }}
                                    </small>
                                </div>
                                <div class="d-flex flex-column gap-1 ms-3" style="width: 100px;">
                                    <select id="jenjang_filter" class="form-select form-select-sm" onchange="applyFilter()">
                                        <option value="">Jenjang</option>
                                        <option value="SD" {{ request('jenjang_filter') == 'SD' ? 'selected' : '' }}>SD
                                        </option>
                                        <option value="MTS" {{ request('jenjang_filter') == 'MTS' ? 'selected' : '' }}>
                                            MTS
                                        </option>
                                        <option value="MA" {{ request('jenjang_filter') == 'MA' ? 'selected' : '' }}>MA
                                        </option>
                                    </select>
                                    <select id="year_filter" class="form-select form-select-sm" onchange="applyFilter()">
                                        <option value="">Tahun</option>
                                        @for ($i = date('Y'); $i >= 2015; $i--)
                                            <option value="{{ $i }}"
                                                {{ request('year') == $i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Santri Disetujui -->
                <div class="col-xl-4 col-md-4 mb-4">
                    <a href="{{ route('pendaftarans.index', ['status' => 'diterima']) }}" class="text-decoration-none">
                        <div class="card shadow-lg border-0 bg-gradient-success text-white hover-scale h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold mb-1">Total Santri Diterima</h6>
                                    <h3 class="fw-bold mb-0">{{ $jumlah_santri_yang_sudah_disetujui }}</h3>
                                </div>
                                <div class="icon bg-white text-success rounded-circle p-3 ms-3">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card Santri Menunggu -->
                <div class="col-xl-4 col-md-4 mb-4">
                    <a href="{{ route('pendaftarans.index', ['status' => 'proses']) }}" class="text-decoration-none">
                        <div class="card shadow-lg border-0 bg-gradient-warning text-white hover-scale h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold mb-1">Santri Menunggu Diterima</h6>
                                    <h3 class="fw-bold mb-0">{{ $jumlah_santri_yang_menunggu_disetujui }}</h3>
                                </div>
                                <div class="icon bg-white text-warning rounded-circle p-3 ms-3">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="results-container mt-5 mb-5">
                <div class="filter-title-section">
                    <h4 class="section-title">Tabel Kelengkapan Syarat Santri</h4>
                    <div class="filter-section">
                        <div class="filter-group">
                            <label for="filterJenjang" class="filter-label">Filter Jenjang:</label>
                            <select id="filterJenjang" class="filter-select" name="jenjang_filter">
                                <option value="">Semua</option>
                                @foreach ($jenjang_list as $jenjang)
                                    <option value="{{ $jenjang }}"
                                        {{ request('jenjang_filter') == $jenjang ? 'selected' : '' }}>{{ $jenjang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="filterYear" class="filter-label">Filter Tahun Masuk:</label>
                            <select id="filterYear" class="filter-select" name="year">
                                <option value="">Semua</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                        {{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="tabelKelengkapanSyarat" class="results-table">
                        <thead>
                            <tr>
                                <th class="student-col">Nama Santri</th>
                                <th class="level-col">Jenjang Pendidikan</th>
                                <th class="santri-col">Data Santri</th>
                                <th class="ortu-col">Data Orang Tua</th>
                                <th class="dokumen-col">Dokumen</th>
                                <th class="kesehatan-col">Data Kesehatan</th>
                                <th class="bantuan-col">Data Bantuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($santriData as $data)
                                <tr>
                                    <td class="student-name">{{ $data['nama_santri'] }}</td>
                                    <td class="level">{{ $data['jenjang_pendidikan'] }}</td>
                                    <td class="santri-status">
                                        @if ($data['santri_complete'] == 'Lengkap')
                                            <span class="status-badge bg-green">Lengkap</span>
                                        @else
                                            <span class="status-badge bg-red">Tidak Lengkap</span>
                                        @endif
                                    </td>
                                    <td class="ortu-status">
                                        @if ($data['ortu_complete'] == 'Lengkap')
                                            <span class="status-badge bg-green">Lengkap</span>
                                        @else
                                            <span class="status-badge bg-red">Tidak Lengkap</span>
                                        @endif
                                    </td>
                                    <td class="dokumen-status">
                                        @if ($data['dokumen_complete'] == 'Lengkap')
                                            <span class="status-badge bg-green">Lengkap</span>
                                        @else
                                            <span class="status-badge bg-red">Tidak Lengkap</span>
                                        @endif
                                    </td>
                                    <td class="kesehatan-status">
                                        @if ($data['kesehatan_complete'] == 'Lengkap')
                                            <span class="status-badge bg-green">Lengkap</span>
                                        @else
                                            <span class="status-badge bg-red">Tidak Lengkap</span>
                                        @endif
                                    </td>
                                    <td class="bantuan-status">
                                        @if ($data['bantuan_complete'] == 'Lengkap')
                                            <span class="status-badge bg-green">Lengkap</span>
                                        @else
                                            <span class="status-badge bg-red">Tidak Lengkap</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="results-container mt-5 mb-5">
                <div class="filter-title-section">
                    <h4 class="section-title">Tabel Hasil Ujian Santri</h4>
                    <div class="filter-section">
                        <div class="filter-group">
                            <label for="filterJenjang" class="filter-label">Filter Jenjang:</label>
                            <select id="filterJenjang" class="filter-select">
                                <option value="">Semua</option>
                                @foreach ($jenjang_list as $jenjang)
                                    <option value="{{ $jenjang }}">{{ $jenjang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="tabelHasil" class="results-table">
                        <thead>
                            <tr>
                                <th class="student-col">Nama Santri</th>
                                <th class="level-col">Jenjang Pendidikan</th>
                                <th class="scores-col">Nilai Per-Mapel</th>
                                <th class="total-col">Total Nilai</th>
                                <th class="average-col">Rata-Rata</th>
                                <th class="status-col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_ujian as $data)
                                <tr data-jenjang="{{ $data['jenjang'] }}"
                                    class="{{ strtolower(str_replace(' ', '-', $data['status_kelulusan'])) }}">
                                    <td class="student-name">{{ $data['nama_santri'] }}</td>
                                    <td class="level">{{ $data['jenjang'] }}</td>
                                    <td class="subject-scores">
                                        <div class="score-details">
                                            @foreach ($data['nilai_permapel'] as $mapel => $nilai)
                                                <div class="score-item">
                                                    <span class="subject">{{ $mapel }}:</span>
                                                    <span
                                                        class="score {{ $nilai >= 75 ? 'good' : ($nilai >= 50 ? 'average' : 'poor') }}">{{ $nilai }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="total-score">{{ $data['total_nilai'] }}</td>
                                    <td class="average-score">{{ $data['rata_rata'] }}</td>
                                    <td class="status">
                                        <span class="status-badge">{{ $data['status_kelulusan'] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row d-flex align-items-stretch">
                <!-- Card Perkembangan Jumlah Santri -->
                <div class="col-md-8 mb-4">
                    <div class="card border-0 shadow transition-all h-100" style="border-radius: 15px;">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="badge bg-info bg-opacity-10 text-info mb-2">Visualisasi</span>
                                    <h5 class="card-title mb-0 fw-bold text-dark">Perkembangan Jumlah Santri</h5>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                        id="chartDropdown" data-bs-toggle="dropdown">
                                        <i class="fas fa-sliders-h me-1"></i> Opsi
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#"
                                                onclick="changeChartType('line')">Garis</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                onclick="changeChartType('bar')">Batang</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#" onclick="exportChart()">Ekspor
                                                Gambar</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="chart-container mb-4" style="position: relative; height: 300px;">
                                <canvas id="santriGrowthChart"></canvas>
                            </div>

                            <div class="mt-auto text-end">
                                <small class="text-muted">Terakhir diperbarui: {{ date('d M Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Statistik Jenis Kelamin -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-lg transition-all hover-shadow-lg h-100 d-flex flex-column"
                        style="border-radius: 15px; overflow: hidden;">
                        <!-- Header -->
                        <div class="card-header bg-gradient-primary text-white py-3"
                            style="border-radius: 15px 15px 0 0 !important;">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0 fw-bold">Statistik Jenis Kelamin</h5>
                                <i class="fas fa-venus-mars fa-2x opacity-50"></i>
                            </div>
                        </div>

                        <!-- Filter -->
                        <div class="px-4 pt-3 pb-2 bg-light">
                            <form method="GET" action="{{ route('dashboard') }}">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <select name="year" class="form-select form-select-sm"
                                            onchange="this.form.submit()">
                                            <option value="">-- Pilih Tahun --</option>
                                            @foreach (\App\Models\Santri::select('tahun_masuk')->distinct()->pluck('tahun_masuk') as $tahun)
                                                <option value="{{ $tahun }}"
                                                    {{ request('year') == $tahun ? 'selected' : '' }}>
                                                    {{ $tahun }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select name="jenjang_filter" class="form-select form-select-sm"
                                            onchange="this.form.submit()">
                                            <option value="">-- Pilih Jenjang --</option>
                                            @foreach (['SD', 'MTS', 'MA'] as $jenjang)
                                                <option value="{{ $jenjang }}"
                                                    {{ request('jenjang_filter') == $jenjang ? 'selected' : '' }}>
                                                    {{ $jenjang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Chart & Ringkasan -->
                        <div class="card-body p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <div style="position: relative; height: 280px;">
                                <canvas id="genderChart"></canvas>
                            </div>

                            <div class="row mt-4 text-center">
                                <div class="col-6">
                                    <div class="border-end">
                                        <h3 class="fw-bold text-primary mb-1">{{ $jumlah_laki_laki }}</h3>
                                        <p class="text-muted small mb-0">
                                            <i class="fas fa-male text-primary me-1"></i> Santri Laki-laki
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <h3 class="fw-bold text-pink mb-1">{{ $jumlah_perempuan }}</h3>
                                        <p class="text-muted small mb-0">
                                            <i class="fas fa-female text-pink me-1"></i> Santri Perempuan
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif (Auth::user()->roles[0]['name'] === 'Santri')
            <div class="merek-step-container">
                <div class="merek-step-row">
                    <div class="merek-step-item">
                        <img src="/assets/img/logo_pondok.png" alt="Registrasi akun">
                        <p>Registrasi akun <br><span class="merek-step-highlight">merek.dgip.go.id</span></p>
                    </div>
                    <div class="merek-step-item">
                        <img src="/assets/img/logo_pondok.png" alt="Permohonan Baru">
                        <p>Klik tambah untuk membuat <strong>Permohonan Baru</strong></p>
                    </div>
                    <div class="merek-step-item">
                        <img src="/assets/img/logo_pondok.png" alt="Isi formulir">
                        <p>Isi <strong>seluruh formulir</strong> yang tersedia</p>
                    </div>
                    <div class="merek-step-item">
                        <img src="/assets/img/logo_pondok.png" alt="Unggah dokumen">
                        <p>Unggah <strong>data dukung</strong> yang dibutuhkan</p>
                    </div>
                </div>

                <div class="merek-step-row">
                    <div class="merek-step-item">
                        <img src="icon5.png" alt="Generate Billing">
                        <p>Pesan Kode Pembayaran dengan klik <strong>Generate Kode Billing</strong></p>
                    </div>
                    <div class="merek-step-item">
                        <img src="icon6.png" alt="Pembayaran">
                        <p>Lakukan <strong>pembayaran sesuai dengan kode billing</strong><br>maks. pukul 23.59 WIB di hari
                            yang sama</p>
                    </div>
                    <div class="merek-step-item">
                        <img src="icon7.png" alt="Klik selesai">
                        <p>Jika semua dirasa sudah benar klik <strong>selesai</strong></p>
                    </div>
                    <div class="merek-step-item">
                        <img src="icon8.png" alt="Diterima DJKI">
                        <p><strong>Permohonan Anda</strong><br>sudah diterima oleh DJKI</p>
                    </div>
                </div>
            </div>
        @endif


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const genderCtx = document.getElementById('genderChart').getContext('2d');
                new Chart(genderCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Laki-laki', 'Perempuan'],
                        datasets: [{
                            label: 'Students',
                            data: [{{ $jumlah_laki_laki }}, {{ $jumlah_perempuan }}],
                            backgroundColor: ['#4e73df', '#e83e8c'],
                            borderColor: ['#ffffff', '#ffffff'],
                            borderWidth: 3,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    font: {
                                        family: "'Nunito', sans-serif",
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: '#2d3748',
                                titleFont: {
                                    family: "'Nunito', sans-serif",
                                    size: 14,
                                    weight: 'bold'
                                },
                                bodyFont: {
                                    family: "'Nunito', sans-serif",
                                    size: 12
                                },
                                callbacks: {
                                    label: function(context) {
                                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        let value = context.parsed;
                                        let percent = (value / total * 100).toFixed(1);
                                        return `${context.label}: ${value} students (${percent}%)`;
                                    }
                                }
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
            });
        </script>


        <!-- Footer -->
        <footer class="footer pt-3">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            dibuat <i class="fa fa-heart"></i> oleh
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Muhamad
                                Cerah</a>
                            Dari Alumni 2020.
                        </div>
                    </div>

                </div>
        </footer>
    </div>

    <!-- JavaScript untuk Filter -->
    <script>
        function applyFilter() {
            let jenjang = document.getElementById("jenjang_filter").value;
            let year = document.getElementById("year_filter").value;

            let url = new URL(window.location.href);
            url.searchParams.set("jenjang_filter", jenjang);
            url.searchParams.set("year", year);

            window.location.href = url.toString();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('chart-bar').getContext('2d');
            var data = {
                labels: ['2020', '2021', '2022', '2023'],
                datasets: [{
                        label: 'SD',
                        data: [50, 55, 60, 65],
                        backgroundColor: 'rgba(255, 99, 132, 0.6)'
                    },
                    {
                        label: 'SMP',
                        data: [60, 65, 70, 75],
                        backgroundColor: 'rgba(54, 162, 235, 0.6)'
                    },
                    {
                        label: 'SMA',
                        data: [70, 75, 80, 85],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)'
                    }
                ]
            };

            var chartBar = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            document.getElementById('yearFilter').addEventListener('change', function() {
                var selectedYear = this.value;
                if (selectedYear === 'all') {
                    chartBar.data.labels = ['2020', '2021', '2022', '2023'];
                    chartBar.data.datasets[0].data = [50, 55, 60, 65];
                    chartBar.data.datasets[1].data = [60, 65, 70, 75];
                    chartBar.data.datasets[2].data = [70, 75, 80, 85];
                } else {
                    var index = data.labels.indexOf(selectedYear);
                    chartBar.data.labels = [selectedYear];
                    chartBar.data.datasets[0].data = [data.datasets[0].data[index]];
                    chartBar.data.datasets[1].data = [data.datasets[1].data[index]];
                    chartBar.data.datasets[2].data = [data.datasets[2].data[index]];
                }
                chartBar.update();
            });
        });

        // script hasil nilai santri
        document.getElementById('filterJenjang').addEventListener('change', function() {
            const selected = this.value;
            const rows = document.querySelectorAll('#tabelHasil tbody tr');

            rows.forEach(row => {
                const jenjang = row.getAttribute('data-jenjang');
                if (!selected || jenjang === selected) {
                    row.style.display = '';
                    row.classList.add('filter-match');
                    setTimeout(() => {
                        row.style.opacity = '1';
                        row.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    row.style.opacity = '0';
                    row.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        row.style.display = 'none';
                        row.classList.remove('filter-match');
                    }, 200);
                }
            });
        });
    </script>

    {{-- scrip jenis kelamin --}}
    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let santriChart;

        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('santriGrowthChart').getContext('2d');

            const years = @json($years);
            const sdData = @json($chartData['SD']);
            const mtsData = @json($chartData['MTS']);
            const maData = @json($chartData['MA']);

            santriChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: years,
                    datasets: [{
                            label: 'SD',
                            data: sdData,
                            borderColor: '#4e73df',
                            backgroundColor: 'rgba(78, 115, 223, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'MTS',
                            data: mtsData,
                            borderColor: '#1cc88a',
                            backgroundColor: 'rgba(28, 200, 138, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'MA',
                            data: maData,
                            borderColor: '#f6c23e',
                            backgroundColor: 'rgba(246, 194, 62, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value + ' santri';
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'nearest'
                    }
                }
            });
        });

        function changeChartType(type) {
            santriChart.config.type = type;
            santriChart.update();
        }

        function exportChart() {
            const link = document.createElement('a');
            link.download = 'perkembangan-santri.png';
            link.href = document.getElementById('santriGrowthChart').toDataURL('image/png');
            link.click();
        }
    </script>

    <style>
        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .icon {
            transition: transform 0.3s ease;
        }

        .icon:hover {
            transform: rotate(15deg);
        }

        .bg-gradient-danger {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
        }

        .bg-gradient-success {
            background: linear-gradient(45deg, #00b09b, #96c93d);
        }

        .bg-gradient-warning {
            background: linear-gradient(45deg, #f7971e, #ffd200);
        }

        .bg-gradient-primary {
            background: linear-gradient(45deg, #007bff, #00b4ff);
        }

        .card {
            border-radius: 15px;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        /* style tabel nilai santri */
        .mt-5 {
            margin-top: 3rem;
        }

        .mb-5 {
            margin-bottom: 3rem;
        }

        .filter-title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        .results-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9fafb;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .filter-section {
            margin-bottom: 25px;
            display: flex;
            justify-content: flex-end;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-label {
            font-weight: 600;
            color: #4b5563;
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background-color: white;
            font-size: 14px;
            color: #374151;
            transition: all 0.2s;
        }

        .filter-select:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .results-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .results-table thead {
            background-color: #6366f1;
            color: white;
        }

        .results-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .results-table tbody tr {
            transition: background-color 0.2s;
        }

        .results-table tbody tr:hover {
            background-color: #f3f4f6;
        }

        .results-table tbody tr.lulus {
            border-left: 4px solid #10b981;
        }

        .results-table tbody tr.tidak-lulus {
            border-left: 4px solid #ef4444;
        }

        .results-table td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .student-name {
            font-weight: 600;
            color: #111827;
        }

        .level {
            color: #4b5563;
            font-size: 14px;
        }

        .score-details {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .score-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .subject {
            color: #4b5563;
            font-size: 14px;
        }

        .score {
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 13px;
        }

        .score.good {
            background-color: #dcfce7;
            color: #166534;
        }

        .score.average {
            background-color: #fef9c3;
            color: #854d0e;
        }

        .score.poor {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .total-score,
        .average-score {
            font-weight: 700;
            color: #111827;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .lulus .status-badge {
            background-color: #dcfce7;
            color: #166534;
        }

        .tidak-lulus .status-badge {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {

            .results-table th,
            .results-table td {
                padding: 10px;
            }

            .filter-group {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .status-badge.bg-red {
            background-color: #ef4444;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
        }

        .status-badge.bg-green {
            background-color: #10b981;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
        }

        /* style 3 card atas */
        .hover-shadow:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
        }

        .transition-all {
            transition: all 0.3s ease-in-out;
        }

        /* khusus santri */
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            padding: 20px;
        }

        .merek-step-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
        }

        .merek-step-row {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .merek-step-item {
            text-align: center;
            max-width: 180px;
        }

        .merek-step-item img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .merek-step-highlight {
            display: inline-block;
            background-color: #ffd400;
            padding: 4px 8px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 0.9em;
        }

        strong {
            color: #001d6e;
        }
    </style>
@endsection
