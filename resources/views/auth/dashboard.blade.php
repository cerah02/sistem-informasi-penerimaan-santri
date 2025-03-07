@extends('layout')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Keseluruhan
                                    santri yang mendaftar</p>
                                <h5 class="font-weight-bolder">

                                    <td>
                                        <h6> SD | {{ $santri_sd }}</h6>
                                        <h6> MTS | {{ $santri_mts }}</h6>
                                        <h6> MA | {{ $santri_ma }}</h6>
                                    </td>
                                </h5>Total | {{ $jumlah_santri }}

                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Santri Yang
                                    Mendaftar Tahun INI</p>
                                <h5 class="font-weight-bolder">
                                    {{ $jumlah_santri_mendaftar_tahun_ini }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah santri yang
                                    telah disetujui</p>
                                <h5 class="font-weight-bolder">
                                    {{ $jumlah_santri_yang_sudah_disetujui }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Santri Yang Menunggu
                                    disetujui</p>
                                <h5 class="font-weight-bolder">
                                    {{ $jumlah_santri_yang_menunggu_disetujui }}
                                </h5>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <!-- Card Sales Overview -->
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

        <!-- Card Profile -->
        <div class="col-lg-8 col-xl-6">
            <div class="card border-0 overflow-hidden">
                <div class="card-header p-0 position-relative">
                    <!-- Gradient Background with Waves -->
                    <div class="bg-gradient-primary position-absolute w-100"
                        style="height: 150px; border-radius: 0 0 40% 40%">
                        <div class="wave-bg"></div>
                    </div>

                    <!-- Profile Image with Floating Effect -->
                    <div class="avatar-frame position-relative mx-auto mt-5">
                        <div class="hover-scale">
                            <img src="{{ asset('storage/profil/' . Auth::user()->foto) }}" alt="profile"
                                class="img-fluid rounded-circle shadow-lg"
                                style="width: 160px; height: 160px; border: 4px solid white; transform: translateY(50%)">
                            <div class="profile-overlay"></div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-100 px-4 pb-4">
                    <!-- Profile Info with Animation -->
                    <div class="text-center mb-4">
                        <h2 class="text-gradient text-primary mb-1 animate__animated animate__fadeInDown">
                            {{ Auth::user()->name }}
                            <span class="verified-badge"><i class="icofont-check-circled"></i></span>
                        </h2>
                        <div class="role-badge animate__animated animate__zoomIn">
                            {{ Auth::user()->getRoleNames()[0] }}
                        </div>
                    </div>

                    <!-- Detail Info with Hover Effects -->
                    @if (Auth::user()->hasRole('guru'))
                        <div class="profile-details">
                            <div class="detail-item hover-transform">
                                <div class="icon-box bg-primary-gradient">
                                    <i class="icofont-id-card"></i>
                                </div>
                                <div class="detail-content">
                                    <span>NIP</span>
                                    <h5>{{ $guru->nip }}</h5>
                                </div>
                            </div>
                    @endif

                    <div class="detail-item hover-transform">
                        <div class="icon-box bg-success-gradient">
                            <i class="icofont-users"></i>
                        </div>

                        @if (Auth::user()->hasRole('guru'))
                            <div class="detail-content">
                                <span>Status Guru</span>
                                <h5></h5>
                            </div>
                        @endif
                    </div>

                    <div class="detail-item hover-transform">
                        <div class="icon-box bg-info-gradient">
                            <i class="icofont-email"></i>
                        </div>
                        <div class="detail-content">
                            <span>Email</span>
                            <h5>{{ Auth::user()->email }}</h5>
                        </div>
                    </div>

                    <div class="detail-item hover-transform">
                        <div class="icon-box bg-warning-gradient">
                            <i class="icofont-iphone"></i>
                        </div>
                        <div class="detail-content">
                            <span>No. Telpon</span>
                            <h5>{{ Auth::user()->no_hp }}</h5>
                        </div>
                    </div>
                </div>

                <!-- Floating Action Buttons -->
                <div class="action-buttons mt-4">
                    <a href="{{ route('edit_profile') }}" class="btn btn-primary btn-floating shadow-lg">
                        <i class="icofont-edit"></i>
                        <span>Edit Profil</span>
                    </a>
                    <button class="btn btn-danger btn-floating shadow-lg">
                        <i class="icofont-logout"></i>
                        <span>Keluar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles */
        .wave-bg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg"><path fill="%23ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,154.7C384,128,480,96,576,117.3C672,139,768,213,864,224C960,235,1056,181,1152,160C1248,139,1344,149,1392,154.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
        }

        .profile-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, transparent 60%, rgba(0, 123, 255, 0.2) 100%);
            border-radius: 50%;
        }

        .detail-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            margin-bottom: 1rem;
            background: white;
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .detail-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 123, 255, 0.15);
        }

        .icon-box {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1rem;
        }

        .bg-primary-gradient {
            background: linear-gradient(45deg, #007bff, #00b4ff)
        }

        .bg-success-gradient {
            background: linear-gradient(45deg, #28a745, #00e676)
        }

        .bg-info-gradient {
            background: linear-gradient(45deg, #17a2b8, #00e5ff)
        }

        .bg-warning-gradient {
            background: linear-gradient(45deg, #ffc107, #ffd54f)
        }

        .role-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: rgba(0, 123, 255, 0.1);
            color: #007bff;
            border-radius: 20px;
            font-weight: 500;
            border: 2px solid rgba(0, 123, 255, 0.2);
        }

        .btn-floating {
            border-radius: 15px;
            padding: 1rem 2rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            margin: 0 0.5rem;
        }

        .btn-floating:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .verified-badge {
            color: #00c853;
            font-size: 1.2rem;
            margin-left: 0.5rem;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .hover-scale:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        .animate__fadeInDown {
            animation: fadeInDown 0.6s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Argon Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0 overflow-auto">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"
                        onclick="sidebarType(this)">Dark</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="d-flex my-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                            onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <div class="mt-2 mb-5 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                            onclick="darkMode(this)">
                    </div>
                </div>
                <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free
                    Download</a>
                <a class="btn btn-outline-dark w-100"
                    href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View
                    documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard"
                        data-icon="octicon-star" data-size="large" data-show-count="true"
                        aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard"
                        class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard"
                        class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Sales by Country</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center ">
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
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div>
                                            <img src="../assets/img/icons/flags/DE.png" alt="Country flag">
                                        </div>
                                        <div class="ms-4">
                                            <p class="text-xs font-weight-bold mb-0">Country:</p>
                                            <h6 class="text-sm mb-0">Germany</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                        <h6 class="text-sm mb-0">3.900</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Value:</p>
                                        <h6 class="text-sm mb-0">$440,000</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                        <h6 class="text-sm mb-0">40.22%</h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div>
                                            <img src="../assets/img/icons/flags/GB.png" alt="Country flag">
                                        </div>
                                        <div class="ms-4">
                                            <p class="text-xs font-weight-bold mb-0">Country:</p>
                                            <h6 class="text-sm mb-0">Great Britain</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                        <h6 class="text-sm mb-0">1.400</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Value:</p>
                                        <h6 class="text-sm mb-0">$190,700</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                        <h6 class="text-sm mb-0">23.44%</h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div>
                                            <img src="../assets/img/icons/flags/BR.png" alt="Country flag">
                                        </div>
                                        <div class="ms-4">
                                            <p class="text-xs font-weight-bold mb-0">Country:</p>
                                            <h6 class="text-sm mb-0">Brasil</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                        <h6 class="text-sm mb-0">562</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Value:</p>
                                        <h6 class="text-sm mb-0">$143,960</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                        <h6 class="text-sm mb-0">32.14%</h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            di buat <i class="fa fa-heart"></i> oleh
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Muhamad
                                Cerah</a>
                            Dari Alumni 2020.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                    target="_blank">Creative
                                    Tim</a>
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
@endsection
