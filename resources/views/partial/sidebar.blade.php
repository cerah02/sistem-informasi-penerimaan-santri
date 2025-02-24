<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('dashboard') }}">
            <img src="/assets/img/logo-ct-dark.png" width="26px" height="26px" class="navbar-brand-img h-100"
                alt="main_logo">
            <span class="ms-1 font-weight-bold">Creative Tim</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            @can('santri-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('santris.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Santri</span>
                    </a>
                </li>
            @endcan

            @can('kelas-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kelas.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kelas</span>
                    </a>
                </li>
            @endcan

            @can('guru-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gurus.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Guru</span>
                    </a>
                </li>
            @endcan

            @can('pendaftaran-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pendaftarans.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-collection text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pendaftaran</span>
                    </a>
                </li>
            @endcan

            @can('ujian-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ujians.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-paper-diploma text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ujian</span>
                    </a>
                </li>
            @endcan

            @can('soal-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('soals.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Soal</span>
                    </a>
                </li>
            @endcan

            @can('jawaban-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jawabans.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-check-bold text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Jawaban</span>
                    </a>
                </li>
            @endcan

            @can('dokumen-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dokumens.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-folder-17 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dokumen</span>
                    </a>
                </li>
            @endcan

            @can('ortu-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ortus.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Orang Tua</span>
                    </a>
                </li>
            @endcan

            @can('kesehatan-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kesehatans.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-ambulance text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kesehatan</span>
                    </a>
                </li>
            @endcan

            @can('bantuan-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bantuans.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-money-coins text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Bantuan</span>
                    </a>
                </li>
            @endcan

            @can('waktu_CCujian-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('waktu_ujians.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-watch-time text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Waktu Ujian</span>
                    </a>
                </li>
            @endcan

            @can('soal-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('list_soal') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">List Soal</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Login</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Register</span>
                </a>
            </li>

            @can('role-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('roles.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-badge text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Roles</span>
                    </a>
                </li>
            @endcan

            @can('user-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-circle-08 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-user-run text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
