<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <!-- Bagian breadcrumb tetap -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
            
            <ul class="navbar-nav justify-content-end">
                <!-- Profile Dropdown -->
                <li class="nav-item dropdown pe-2">
                    <a class="nav-link dropdown-toggle p-0 d-flex align-items-center" href="javascript:;" 
                       id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-sm me-2">
                            <img src="{{ asset('storage/profil/' . Auth::user()->foto) }}" 
                                 class="rounded-circle" 
                                 style="width: 32px; height: 32px; border: 2px solid white">
                        </div>
                        <span class="text-white font-weight-bold">{{ Auth::user()->name }}</span>
                    </a>
                    
                    <!-- Dropdown Menu dengan Card Profil -->
                    <ul class="dropdown-menu dropdown-menu-end px-4 py-3" 
                        aria-labelledby="profileDropdown"
                        style="width: 320px; border-radius: 1rem; overflow: hidden">
                        <li>
                            <div class="card-profile">
                                <!-- Header dengan Gambar Background -->
                                <div class="card-header p-0 position-relative">
                                    <div class="bg-gradient-primary" 
                                         style="height: 100px; border-radius: 0 0 20% 20%">
                                        <div class="wave-bg"></div>
                                    </div>
                                    <img src="{{ asset('storage/profil/' . Auth::user()->foto) }}" 
                                         class="avatar-profile rounded-circle shadow-lg"
                                         style="width: 80px; height: 80px; border: 3px solid white">
                                </div>

                                <!-- Body dengan Informasi Profil -->
                                <div class="card-body pt-5 px-0 pb-2">
                                    <div class="text-center mb-3">
                                        <h5 class="mb-1">
                                            {{ Auth::user()->name }}
                                            <i class="icofont-check-circled text-primary fs-6"></i>
                                        </h5>
                                        <div class="badge bg-primary-soft mt-1">
                                            {{ Auth::user()->getRoleNames()[0] }}
                                        </div>
                                    </div>

                                    <!-- Informasi Detail -->
                                    <div class="profile-info">
                                        {{-- <div class="info-item">
                                            <i class="icofont-id-card me-2"></i>
                                            <span>NIP:</span>
                                            <strong>480432434</strong>
                                        </div> --}}
                                        <div class="info-item">
                                            <i class="icofont-email me-2"></i>
                                            <span>Email:</span>
                                            <strong>{{ Auth::user()->email }}</strong>
                                        </div>
                                        {{-- <div class="info-item">
                                            <i class="icofont-iphone me-2"></i>
                                            <span>Telp:</span>
                                            <strong>{{ Auth::user()->no_hp }}</strong>
                                        </div> --}}
                                    </div>

                                    <!-- Tombol Aksi -->
                                    <div class="d-flex gap-2 mt-4">
                                        <a href="{{ route('edit_profile') }}" 
                                           class="btn btn-sm btn-primary flex-fill">
                                            <i class="icofont-edit me-2"></i>Edit
                                        </a>
                                        <button class="btn btn-sm btn-danger flex-fill">
                                            <i class="icofont-logout me-2"></i>Keluar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- Item navbar lainnya tetap sama -->
                <!-- ... (bagian icon sidenav toggle, settings, dan notifikasi tetap sama) ... -->
            </ul>
        </div>
    </div>
</nav>

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
        background: rgba(0,123,255,0.1);
        color: #007bff;
        padding: 0.35rem 0.75rem;
        border-radius: 1rem;
    }
</style>