<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex flex-column align-items-center text-center" href="{{ route('dashboard') }}">
            <div class="d-flex justify-content-center align-items-center mb-2">
                <img src="/assets/img/logo_pondok.png" width="40px" height="40px" class="rounded-circle"
                    alt="main_logo">
            </div>
            <div>
                <span class="font-weight-bold fs-5">Pondok Pesantren</span>
                <span class="d-block fs-6 text-muted">Darul Muttaqien</span>
            </div>
        </a>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <!-- Santri -->
                @can('santri-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('santris.index') ? 'active' : '' }}"
                            href="{{ route('santris.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Santri</span>
                        </a>
                    </li>
                @endcan

                <!-- Kelas -->
                @can('kelas-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kelas.index') ? 'active' : '' }}"
                            href="{{ route('kelas.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Kelas</span>
                        </a>
                    </li>
                @endcan

                <!-- Guru -->
                @can('guru-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gurus.index') ? 'active' : '' }}"
                            href="{{ route('gurus.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Guru</span>
                        </a>
                    </li>
                @endcan

                <!-- Pendaftaran -->
                @can('pendaftaran-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pendaftarans.index') ? 'active' : '' }}"
                            href="{{ route('pendaftarans.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-collection text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Pendaftaran</span>
                        </a>
                    </li>
                @endcan

                <!-- Ujian -->
                @can('ujian-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ujians.index') ? 'active' : '' }}"
                            href="{{ route('ujians.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-paper-diploma text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Ujian</span>
                        </a>
                    </li>
                @endcan

                <!-- Soal -->
                @can('soal-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('soals.index') ? 'active' : '' }}"
                            href="{{ route('soals.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Soal</span>
                        </a>
                    </li>
                @endcan

                <!-- Jawaban -->
                @can('jawaban-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('jawabans.index') ? 'active' : '' }}"
                            href="{{ route('jawabans.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-check-bold text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Jawaban</span>
                        </a>
                    </li>
                @endcan

                <!-- Dokumen -->
                @can('dokumen-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dokumens.index') ? 'active' : '' }}"
                            href="{{ route('dokumens.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-folder-17 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Dokumen</span>
                        </a>
                    </li>
                @endcan

                <!-- Orang Tua -->
                @can('ortu-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ortus.index') ? 'active' : '' }}"
                            href="{{ route('ortus.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Orang Tua</span>
                        </a>
                    </li>
                @endcan

                <!-- Kesehatan -->
                @can('kesehatan-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kesehatans.index') ? 'active' : '' }}"
                            href="{{ route('kesehatans.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-ambulance text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Kesehatan</span>
                        </a>
                    </li>
                @endcan

                <!-- Bantuan -->
                @can('bantuan-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('bantuans.index') ? 'active' : '' }}"
                            href="{{ route('bantuans.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-money-coins text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Bantuan</span>
                        </a>
                    </li>
                @endcan

                <!-- Waktu Ujian -->
                @can('waktu_CCujian-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('waktu_ujians.index') ? 'active' : '' }}"
                            href="{{ route('waktu_ujians.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-watch-time text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Waktu Ujian</span>
                        </a>
                    </li>
                @endcan

                <!-- List Soal -->
                @can('soal-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('list_soal') ? 'active' : '' }}"
                            href="{{ route('list_soal') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Soal Ujian</span>
                        </a>
                    </li>
                @endcan

                <!-- Account Pages Section -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>

                <!-- Login -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                        href="{{ route('login') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Login</span>
                    </a>
                </li>

                <!-- Register -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                        href="{{ route('register') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-collection text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Register</span>
                    </a>
                </li>

                <!-- Roles -->
                @can('role-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                            href="{{ route('roles.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-badge text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Roles</span>
                        </a>
                    </li>
                @endcan

                <!-- Users -->
                @can('user-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
                            href="{{ route('users.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-circle-08 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Users</span>
                        </a>
                    </li>
                @endcan

                <!-- Logout -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('logout') ? 'active' : '' }}"
                        href="{{ route('logout') }}">
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
