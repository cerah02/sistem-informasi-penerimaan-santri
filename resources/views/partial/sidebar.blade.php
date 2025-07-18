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

                <!-- Pendaftaran Santri -->
                @php
                    $aksesPendaftaran =
                        auth()->user()->can('pendaftaran-list') ||
                        auth()->user()->can('santri-list') ||
                        auth()->user()->can('dokumen-list') ||
                        auth()->user()->can('ortu-list') ||
                        auth()->user()->can('kesehatan-list') ||
                        auth()->user()->can('bantuan-list');
                @endphp

                @if ($aksesPendaftaran)
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pendaftaranDropdown" aria-expanded="false"
                            aria-controls="pendaftaranDropdown">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-collection text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Pendaftaran Santri</span>
                        </a>
                        <div class="collapse" id="pendaftaranDropdown">
                            <ul class="nav flex-column ms-3">
                                @can('pendaftaran-list')
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('pendaftarans.index') ? 'active' : '' }}"
                                            href="{{ route('pendaftarans.index') }}">
                                            <i class="ni ni-badge text-sm me-2"></i> Pendaftaran
                                        </a>
                                    </li>
                                @endcan
                                @can('santri-list')
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('santris.index') ? 'active' : '' }}"
                                            href="{{ route('santris.index') }}">
                                            <i class="ni ni-single-02 text-sm me-2"></i> Santri
                                        </a>
                                    </li>
                                @endcan
                                @can('dokumen-list')
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('dokumens.index') ? 'active' : '' }}"
                                            href="{{ route('dokumens.index') }}">
                                            <i class="ni ni-folder-17 text-sm me-2"></i> Dokumen
                                        </a>
                                    </li>
                                @endcan
                                @can('ortu-list')
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('ortus.index') ? 'active' : '' }}"
                                            href="{{ route('ortus.index') }}">
                                            <i class="ni ni-hat-3 text-sm me-2"></i> Orang Tua
                                        </a>
                                    </li>
                                @endcan
                                @can('kesehatan-list')
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('kesehatans.index') ? 'active' : '' }}"
                                            href="{{ route('kesehatans.index') }}">
                                            <i class="ni ni-ambulance text-sm me-2"></i> Kesehatan
                                        </a>
                                    </li>
                                @endcan
                                @can('bantuan-list')
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('bantuans.index') ? 'active' : '' }}"
                                            href="{{ route('bantuans.index') }}">
                                            <i class="ni ni-money-coins text-sm me-2"></i> Bantuan
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif

                @can('pendaftaran-santri')
                    <li class="nav-item">
                        @php
                            $user = Auth::user();
                            // Cek role dan tentukan route yang sesuai
                            if ($user->hasRole('Admin')) {
                                $route = route('admin_pendaftaran_santri_view'); // route untuk admin
                            } elseif ($user->hasRole('Santri')) {
                                $route = route('santri_pendaftaran_view'); // route untuk santri
                            } else {
                                $route = 'dashboard'; // default/fallback
                            }
                        @endphp

                        <a class="nav-link {{ request()->url() == $route ? 'active' : '' }}" href="{{ $route }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Formulir Dan Berkas</span>
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

                <!-- Ujian -->
                @can('ujian-list')
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#ujianDropdown" aria-expanded="false" aria-controls="ujianDropdown">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Ujian</span>
                        </a>
                        <div class="collapse" id="ujianDropdown">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('ujian/sd') ? 'active' : '' }}"
                                        href="{{ url('ujian/sd') }}">
                                        Ujian SD
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('ujian/mts') ? 'active' : '' }}"
                                        href="{{ url('ujian/mts') }}">
                                        Ujian MTS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('ujian/ma') ? 'active' : '' }}"
                                        href="{{ url('ujian/ma') }}">
                                        Ujian MA
                                    </a>
                                </li>

                                @can('jawaban-list')
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('jawabans.index') ? 'active' : '' }}"
                                            href="{{ route('jawabans.index') }}">
                                            Jawaban
                                        </a>
                                    </li>
                                @endcan

                                @can('hasil-list')
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('hasils.index') ? 'active' : '' }}"
                                            href="{{ route('hasils.index') }}">
                                            Hasil Ujian
                                        </a>
                                    </li>
                                @endcan
                                @can('passing_grade-index')
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('passing_grade.index') ? 'active' : '' }}"
                                            href="{{ route('passing_grade.index') }}">
                                            Passing Grade
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('soal-list')
                    @if (auth()->user()->hasRole('Santri'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('list_soal') ? 'active' : '' }}"
                                href="{{ route('list_soal') }}">
                                <div
                                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Jadwal Ujian</span>
                            </a>
                        </li>
                    @endif
                @endcan

                <!-- Account Pages Section -->

                <!-- List Agenda -->
                @can('agenda-list')
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Informasi Pondok</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('agendas.index') ? 'active' : '' }}"
                            href="{{ route('agendas.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Agenda Pondok</span>
                        </a>
                    </li>
                @endcan

                <!-- List notifikasi -->
                @can('notifikasi-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('notifikasi.index') ? 'active' : '' }}"
                            href="{{ route('notifikasi.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-bell-55 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Notifikasi</span>
                        </a>
                    </li>
                @endcan

                <!-- List pengumuman-->
                @can('beranda_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('beranda.index') ? 'active' : '' }}"
                            href="{{ route('beranda.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-shop text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Beranda</span>
                        </a>
                    </li>
                @endcan

                @can('visi_misi-edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('visi_misi.edit') ? 'active' : '' }}"
                            href="{{ route('visi_misi.edit') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-book-bookmark text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Visi Misi</span>
                        </a>
                    </li>
                @endcan

                @can('fasilitas_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('fasilitas_edit.*') ? 'active' : '' }}"
                            href="{{ route('fasilitas_edit.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-building text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Fasilitas</span>
                        </a>
                    </li>
                @endcan

                @can('pakaian_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pakaian_edit.*') ? 'active' : '' }}"
                            href="{{ route('pakaian_edit.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-briefcase-24 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Pakaian</span>
                        </a>
                    </li>
                @endcan

                @can('brosur_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('brosur_edit.*') ? 'active' : '' }}"
                            href="{{ route('brosur_edit.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-briefcase-24 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Brosur</span>
                        </a>
                    </li>
                @endcan

                @can('pengumuman-list')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pengumuman.index') ? 'active' : '' }}"
                            href="{{ route('pengumuman.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-notification-70 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Pengumuman</span>
                        </a>
                    </li>
                @endcan

                @can('laporan-index')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('laporan') ? 'active' : '' }}"
                            href="{{ route('laporan') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-chart-bar-32 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Laporan</span>
                        </a>
                    </li>
                @endcan

                <!-- Account Pages Section -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Halaman Akun</h6>
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
