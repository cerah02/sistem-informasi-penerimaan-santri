<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <!-- Bagian breadcrumb tetap -->
        @php
            $segments = Request::segments();
        @endphp

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-white" href="{{ url('/') }}">Home</a>
                </li>
                @foreach ($segments as $key => $segment)
                    <li class="breadcrumb-item text-sm {{ $loop->last ? 'text-white active' : '' }}"
                        aria-current="{{ $loop->last ? 'page' : '' }}">
                        @if (!$loop->last)
                            <a class="opacity-5 text-white text-capitalize"
                                href="{{ url(implode('/', array_slice($segments, 0, $key + 1))) }}">
                                {{ str_replace('-', ' ', $segment) }}
                            </a>
                        @else
                            {{ str_replace('-', ' ', ucfirst($segment)) }}
                        @endif
                    </li>
                @endforeach
            </ol>
            <h6 class="font-weight-bolder text-white mb-0 text-capitalize">
                {{ str_replace('-', ' ', ucfirst(last($segments))) ?? 'Dashboard' }}
            </h6>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>

            <ul class="navbar-nav justify-content-end">

                @if (Auth::check() && Auth::user()->hasRole('Santri'))
                    @php
                        $unread = Auth::user()->unreadNotifications;
                    @endphp

                    <li class="nav-item dropdown">
                        <a class="nav-link text-white position-relative px-3" href="#" id="notifDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell fa-lg" style="color: #fff !important; font-size: 1.25rem;"></i>
                            @if ($unread->count() > 0)
                                <span
                                    class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger py-1 px-2">
                                    {{ $unread->count() }}
                                    <span class="visually-hidden">unread notifications</span>
                                </span>
                                <div class="pulse-ring"></div>
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end py-0 shadow-lg" aria-labelledby="notifDropdown"
                            style="width: 350px; max-height: 500px; overflow-y: auto;">
                            <li class="dropdown-header bg-light py-3">
                                <div class="d-flex justify-content-between align-items-center px-3">
                                    <h6 class="m-0 text-dark fw-bold">NOTIFICATIONS</h6>
                                    <span class="badge bg-primary">{{ $unread->count() }} New</span>
                                </div>
                            </li>

                            <div class="dropdown-divider m-0"></div>

                            @forelse ($unread as $notification)
                                <li>
                                    <a href="{{ $notification->data['url'] ?? '#' }}"
                                        class="dropdown-item py-3 position-relative">
                                        <div class="d-flex align-items-start">
                                            <div class="me-3">
                                                <i class="fas fa-bell text-primary bg-light p-2 rounded-circle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <h6 class="mb-0 fw-bold text-dark">
                                                        {{ $notification->data['title'] }}</h6>
                                                    <small
                                                        class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                                </div>
                                                <p class="mb-0 text-muted text-truncate-2"
                                                    style="font-size: 0.9rem; line-height: 1.4">
                                                    {{ $notification->data['message'] }}
                                                </p>
                                            </div>
                                        </div>
                                        <span
                                            class="position-absolute top-50 end-0 translate-middle-y p-1 bg-primary rounded-circle"
                                            style="right: 15px"></span>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                </li>
                            @empty
                                <li class="py-3 px-4 text-center">
                                    <i class="fas fa-bell-slash fa-2x text-muted mb-2"></i>
                                    <p class="text-muted mb-0">Tidak ada notifikasi baru</p>
                                </li>
                            @endforelse

                            @if ($unread->count() > 0)
                                <li>
                                    <a class="dropdown-item text-center py-3 bg-light-hover"
                                        href="{{ route('notifikasi.baca-semua') }}">
                                        <span class="text-primary fw-bold">Tandai semua sudah dibaca</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown pe-2">
                    <a class="nav-link dropdown-toggle p-0 d-flex align-items-center" href="javascript:;"
                        id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-sm me-2">
                            <img src="{{ asset('storage/profil/' . Auth::user()->foto) }}" class="rounded-circle"
                                style="width: 32px; height: 32px; border: 2px solid white">
                        </div>
                        <span class="text-white font-weight-bold">{{ Auth::user()->name }}</span>
                    </a>

                    <!-- Dropdown Menu dengan Card Profil -->
                    <ul class="dropdown-menu dropdown-menu-end px-4 py-3" aria-labelledby="profileDropdown"
                        style="width: 320px; border-radius: 1rem; overflow: hidden">
                        <li>
                            <div class="card-profile">
                                <!-- Header dengan Gambar Background -->
                                <div class="card-header p-0 position-relative">
                                    <div class="bg-gradient-primary" style="height: 100px; border-radius: 0 0 20% 20%">
                                        <div class="wave-bg"></div>
                                    </div>
                                    <img src="{{ asset('storage/profil/' . Auth::user()->foto) }}"
                                        class="avatar-profile rounded-circle shadow-lg"
                                        style="width: 80px; height: 80px; border: 3px solid white">
                                </div>

                                <!-- Body dengan Informasi Profil -->
                                <div class="card-body pt-5 px-0 pb-2">
                                    <div class="text-center mb-3">
                                        <h5 class="mb-1" style="font-size: 1.1rem;">
                                            {{ Auth::user()->name }}
                                            <i class="icofont-check-circled text-primary fs-6"></i>
                                        </h5>
                                        <div class="badge bg-primary-soft mt-1" style="font-size: 0.8rem;">
                                            {{ Auth::user()->getRoleNames()[0] }}
                                        </div>
                                    </div>

                                    <!-- Informasi Detail -->
                                    <div class="detail-item hover-transform">
                                        <div class="icon-box bg-info-gradient">
                                            <i class="icofont-email"></i>
                                        </div>
                                        <div class="detail-content">
                                            <span style="font-size: 0.8rem;">Nomor Telpon</span>
                                            <h5 style="font-size: 0.9rem;">{{ Auth::user()->nomor_telpon }}</h5>
                                        </div>
                                    </div>

                                    <!-- Kondisi Ketika Guru -->
                                    @if (Auth::user()->hasRole('Guru'))
                                        <div class="profile-details">
                                            <div class="detail-item hover-transform">
                                                <div class="icon-box bg-primary-gradient">
                                                    <i class="icofont-id-card"></i>
                                                </div>
                                                <div class="detail-content">
                                                    <span style="font-size: 0.8rem;">NIP</span>
                                                    <h5 style="font-size: 0.9rem;">{{ $Guru->nip ?? '' }}</h5>
                                                </div>
                                            </div>
                                    @endif

                                    @if (Auth::user()->hasRole('Guru'))
                                        <div class="detail-item hover-transform">
                                            <div class="icon-box bg-success-gradient">
                                                <i class="icofont-users"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span style="font-size: 0.8rem;">No. Telpon</span>
                                                <h5 style="font-size: 0.9rem;">{{ $Guru->email ?? '' }}</h5>
                                            </div>
                                        </div>
                                    @endif

                                    @if (Auth::user()->hasRole('Guru'))
                                        <div class="profile-details">
                                            <div class="detail-item hover-transform">
                                                <div class="icon-box bg-primary-gradient">
                                                    <i class="icofont-id-card"></i>
                                                </div>
                                                <div class="detail-content">
                                                    <span style="font-size: 0.8rem;">Status Guru</span>
                                                    <h5 style="font-size: 0.9rem;">{{ $Guru->status_guru ?? '' }}</h5>
                                                </div>
                                            </div>
                                    @endif

                                    <!-- Kondisi ketika Santri -->
                                    @if (Auth::user()->hasRole('Santri'))
                                        <div class="profile-details">
                                            <div class="detail-item hover-transform">
                                                <div class="icon-box bg-primary-gradient">
                                                    <i class="icofont-id-card"></i>
                                                </div>
                                                <div class="detail-content">
                                                    <span style="font-size: 0.8rem;">NIK</span>
                                                    <h5 style="font-size: 0.9rem;">{{ $Santri->nik ?? '' }}</h5>
                                                </div>
                                            </div>
                                    @endif

                                    @if (Auth::user()->hasRole('Santri'))
                                        <div class="detail-item hover-transform">
                                            <div class="icon-box bg-success-gradient">
                                                <i class="icofont-users"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span style="font-size: 0.8rem;">NISN</span>
                                                <h5 style="font-size: 0.9rem;">{{ $Santri->nisn ?? '' }}</h5>
                                            </div>
                                        </div>
                                    @endif

                                    @if (Auth::user()->hasRole('Santri'))
                                        <div class="profile-details">
                                            <div class="detail-item hover-transform">
                                                <div class="icon-box bg-primary-gradient">
                                                    <i class="icofont-id-card"></i>
                                                </div>
                                                <div class="detail-content">
                                                    <span style="font-size: 0.8rem;">Jenjang Pendidikan</span>
                                                    <h5 style="font-size: 0.9rem;">
                                                        {{ $Santri->jenjang_pendidikan ?? '' }}</h5>
                                                </div>
                                            </div>
                                    @endif
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="d-flex gap-2 mt-4">
                                    <a href="{{ route('edit_profile') }}" class="btn btn-sm btn-primary flex-fill"
                                        style="font-size: 0.8rem;">
                                        <i class="icofont-edit me-2"></i>Edit
                                    </a>

                                    <a class="nav-link {{ request()->routeIs('logout') ? 'active' : '' }}"
                                        href="{{ route('logout') }}" style="font-size: 0.8rem;">
                                        <div
                                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                            <i class="ni ni-user-run text-dark text-sm opacity-10"></i>
                                        </div>
                                        <span class="nav-link-text ms-1">Logout</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
    .pulse-ring {
        position: absolute;
        top: 5px;
        right: 2px;
        width: 8px;
        height: 8px;
        background: rgba(255, 82, 82, 0.7);
        border-radius: 50%;
        animation: pulsate 1.5s ease-out infinite;
    }

    @keyframes pulsate {
        0% {
            transform: scale(0.1, 0.1);
            opacity: 0.0;
        }

        50% {
            opacity: 1.0;
        }

        100% {
            transform: scale(1.2, 1.2);
            opacity: 0.0;
        }
    }

    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .bg-light-hover:hover {
        background-color: #f8f9fa !important;
    }

    .dropdown-menu::-webkit-scrollbar {
        width: 6px;
    }

    .dropdown-menu::-webkit-scrollbar-thumb {
        background-color: #dee2e6;
        border-radius: 10px;
    }
</style>
<style>
    /* Custom CSS untuk dropdown profil */
    .card-profile {
        background: white;
        border-radius: 1rem;
    }

    .avatar-profile {
        position: absolute;
        left: 50%;
        top: 60px;
        transform: translateX(-50%);
        transition: all 0.3s ease;
    }

    .profile-info .info-item {
        padding: 0.5rem;
        margin-bottom: 0.5rem;
        background: #f8f9fa;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
    }

    .profile-info .info-item i {
        width: 24px;
        color: #007bff;
    }

    .wave-bg {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 20px;
        background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg"><path fill="%23ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,154.7C384,128,480,96,576,117.3C672,139,768,213,864,224C960,235,1056,181,1152,160C1248,139,1344,149,1392,154.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-size: cover;
    }

    .badge.bg-primary-soft {
        background: rgba(0, 123, 255, 0.1);
        color: #007bff;
        padding: 0.35rem 0.75rem;
        border-radius: 1rem;
    }

    .detail-item {
        padding: 0.5rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-item .icon-box {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
    }

    .detail-item .detail-content {
        flex: 1;
    }

    .detail-item .detail-content span {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .detail-item .detail-content h5 {
        font-size: 0.9rem;
        margin: 0;
        color: #343a40;
    }

    .navbar-main .nav-link {
        display: flex !important;
        align-items: center !important;
        position: relative !important;
        z-index: 5 !important;
    }
</style>
