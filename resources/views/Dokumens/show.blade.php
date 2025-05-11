@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="m-0"><i class="fas fa-file-alt mr-2"></i>Detail Dokumen Santri</h4>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-light btn-sm" href="{{ route('dokumens.index') }}">
                            <i class="fas fa-arrow-left mr-1"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <h5 class="alert-heading mb-2"><i class="fas fa-id-badge mr-2"></i>ID Santri</h5>
                    <span class="badge badge-pill badge-primary px-3 py-2">{{ $dokumen->santri_id }}</span>
                </div>

                <div class="row">
                    <!-- Dokumen Pendidikan -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-secondary text-white">
                                <i class="fas fa-graduation-cap mr-2"></i>Dokumen Pendidikan
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="fas fa-file-pdf text-danger mr-2"></i>
                                    Ijazah
                                    <a href="{{ asset('storage/' . $dokumen->ijazah) }}" target="_blank"
                                        class="btn btn-link btn-sm float-right">
                                        Lihat <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-file-pdf text-danger mr-2"></i>
                                    Akta Kelahiran
                                    <a href="{{ asset('storage/' . $dokumen->akta_kelahiran) }}" target="_blank"
                                        class="btn btn-link btn-sm float-right">
                                        Lihat <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-chart-line text-info mr-2"></i>
                                    Nilai Raport
                                    <a href="{{ asset('storage/' . $dokumen->nilai_raport) }}" target="_blank"
                                        class="btn btn-link btn-sm float-right">
                                        Lihat <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-certificate text-warning mr-2"></i>
                                    SKHUN
                                    <a href="{{ asset('storage/' . $dokumen->skhun) }}" target="_blank"
                                        class="btn btn-link btn-sm float-right">
                                        Lihat <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Dokumen Pribadi & Keluarga -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-success text-white">
                                <i class="fas fa-users mr-2"></i>Dokumen Pribadi & Keluarga
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="fas fa-camera text-purple mr-2"></i>
                                    Foto
                                    <a href="{{ asset('storage/' . $dokumen->foto) }}" target="_blank"
                                        class="btn btn-link btn-sm float-right">
                                        Lihat <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-home text-info mr-2"></i>
                                    Kartu Keluarga (KK)
                                    <a href="{{ asset('storage/' . $dokumen->kk) }}" target="_blank"
                                        class="btn btn-link btn-sm float-right">
                                        Lihat <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-male text-primary mr-2"></i>
                                    KTP Ayah
                                    <a href="{{ asset('storage/' . $dokumen->ktp_ayah) }}" target="_blank"
                                        class="btn btn-link btn-sm float-right">
                                        Lihat <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-female text-danger mr-2"></i>
                                    KTP Ibu
                                    <a href="{{ asset('storage/' . $dokumen->ktp_ibu) }}" target="_blank"
                                        class="btn btn-link btn-sm float-right">
                                        Lihat <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-purple {
            color: #6f42c1;
        }

        .list-group-item {
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .card-header {
            font-weight: 500;
        }

        .btn-link {
            color: #17a2b8;
        }

        .btn-link:hover {
            color: #138496;
            text-decoration: none;
        }
    </style>
@endsection