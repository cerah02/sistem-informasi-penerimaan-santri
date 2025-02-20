<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8 CRUD Application - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Laravel 8 CRUD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @can('santri-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('santris.index') }}">Santri</a>
                    </li>
                @endcan

                @can('kelas-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kelas.index') }}">Kelas</a>
                    </li>
                @endcan

                @can('guru-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gurus.index') }}">Guru</a>
                    </li>
                @endcan

                @can('pendaftaran-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pendaftarans.index') }}">Pendaftaran</a>
                    </li>
                @endcan

                @can('ujian-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ujians.index') }}">Ujian</a>
                    </li>
                @endcan

                @can('soal-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('soals.index') }}">Soal</a>
                    </li>
                @endcan

                @can('jawaban-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jawabans.index') }}">Jawaban</a>
                    </li>
                @endcan

                @can('dokumen-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dokumens.index') }}">Dokumen</a>
                    </li>
                @endcan

                @can('ortu-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ortus.index') }}">Orang Tua</a>
                    </li>
                @endcan

                @can('kesehatan-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kesehatans.index') }}">Kesehatan</a>
                    </li>
                @endcan

                @can('bantuan-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bantuans.index') }}">Bantuan</a>
                    </li>
                @endcan

                @can('waktu_CCujian-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('waktu_ujians.index') }}">Waktu Ujian</a>
                    </li>
                @endcan

                @can('soal-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list_soal') }}">List Soal</a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>

                @can('role-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
                    </li>
                @endcan

                @can('user-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>

            </ul>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
    @stack('scripts')
</body>

</html>
