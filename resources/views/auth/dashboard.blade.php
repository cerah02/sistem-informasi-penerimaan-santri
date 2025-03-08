@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Card Filter & Hasil -->
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card shadow-lg border-0 hover-scale">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-primary fw-bold">Total Santri</h5>

                            <!-- Dropdown Filter -->
                            <div class="d-flex gap-2">
                                <!-- Jenjang Filter -->
                                <select id="jenjang_filter" class="form-select" onchange="applyFilter()">
                                    <option value="">Semua Jenjang</option>
                                    <option value="SD" {{ request('jenjang_filter') == 'SD' ? 'selected' : '' }}>SD
                                    </option>
                                    <option value="MTS" {{ request('jenjang_filter') == 'MTS' ? 'selected' : '' }}>MTS
                                    </option>
                                    <option value="MA" {{ request('jenjang_filter') == 'MA' ? 'selected' : '' }}>MA
                                    </option>
                                </select>

                                <!-- Tahun Filter -->
                                <select id="year_filter" class="form-select" onchange="applyFilter()">
                                    <option value="">Semua Tahun</option>
                                    @for ($i = date('Y'); $i >= 2015; $i--)
                                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Hasil Filter -->
                        <div class="mt-3 text-center">
                            <h2 class="fw-bold text-dark">
                                {{ request('jenjang_filter') || request('year') ? $hitung_santri_byfilter : $jumlah_santri }}
                            </h2>
                            <p class="text-muted">
                                {{ request('jenjang_filter') || request('year') ? 'Santri sesuai filter' : 'Total seluruh santri' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Santri Mendaftar Tahun Ini -->
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card shadow-lg border-0 bg-gradient-danger text-white hover-scale">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h6 class="fw-bold">Santri Mendaftar Tahun Ini</h6>
                            <h3 class="fw-bold">{{ $jumlah_santri_mendaftar_tahun_ini }}</h3>
                        </div>
                        <div class="ms-auto">
                            <div class="icon bg-white text-danger rounded-circle p-3">
                                <i class="fas fa-user-plus fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Santri Disetujui -->
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card shadow-lg border-0 bg-gradient-success text-white hover-scale">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h6 class="fw-bold">Santri Disetujui</h6>
                            <h3 class="fw-bold">{{ $jumlah_santri_yang_sudah_disetujui }}</h3>
                        </div>
                        <div class="ms-auto">
                            <div class="icon bg-white text-success rounded-circle p-3">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Santri Menunggu Persetujuan -->
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card shadow-lg border-0 bg-gradient-warning text-white hover-scale">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h6 class="fw-bold">Santri Menunggu Disetujui</h6>
                            <h3 class="fw-bold">{{ $jumlah_santri_yang_menunggu_disetujui }}</h3>
                        </div>
                        <div class="ms-auto">
                            <div class="icon bg-white text-warning rounded-circle p-3">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Overview Card -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8 col-xl-6 mb-4">
                <div class="card shadow-lg border-0 hover-scale">
                    <div class="card-header bg-gradient-primary text-white pb-3 pt-4 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0 text-white">Sales Overview</h5>
                                <p class="text-sm text-white opacity-8 mb-0">
                                    <i class="fas fa-arrow-up text-success"></i>
                                    <span class="font-weight-bold">4% more</span> in 2023
                                </p>
                            </div>
                            <i class="fas fa-chart-line fa-2x text-white-50"></i>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-end mb-3">
                            <select id="yearFilter" class="form-select w-auto">
                                <option value="all">All Years</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                        </div>
                        <div class="chart-container" style="height: 300px;">
                            <canvas id="chart-bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales by Country Card -->
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card shadow-lg border-0 hover-scale">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Sales by Country</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <tbody>
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="../assets/img/icons/flags/US.png" alt="Country flag">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                <h6 class="text-sm mb-0">United States</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                            <h6 class="text-sm mb-0">2500</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                                            <h6 class="text-sm mb-0">$230,900</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                            <h6 class="text-sm mb-0">29.9%</h6>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Repeat for other countries -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

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
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                    target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
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
    </style>
@endsection
