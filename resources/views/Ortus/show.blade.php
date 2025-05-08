@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a class="btn btn-light btn-sm" href="{{ route('ortus.index') }}">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-lg">
            <!-- Header Card -->
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0">
                    <i class="bi bi-file-person me-2"></i>Informasi Orang Tua
                </h4>
            </div>

            <div class="card-body p-4">
                <!-- Data Santri -->
                <div class="row mb-4">
                    <div class="col-md-12 mb-3">
                        <div class="alert alert-info bg-light-info border-info">
                            <h5 class="mb-0">
                                <i class="bi bi-person-vcard me-2"></i>
                                Santri Terkait: <strong>{{ $ortu->santri->nama ?? 'N/A' }}</strong>
                            </h5>
                        </div>
                    </div>
                </div>

                <!-- Data Ayah -->
                <div class="card mb-4 border-primary">
                    <div class="card-header bg-light-primary d-flex align-items-center">
                        <i class="bi bi-gender-male fs-4 text-primary me-3"></i>
                        <h5 class="mb-0">Data Ayah</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted small mb-1">Nama Lengkap</label>
                                <div class="h5">{{ $ortu->nama_ayah }}</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted small mb-1">Pendidikan Terakhir</label>
                                <div class="h5">
                                    <span class="badge bg-primary">
                                        {{ $ortu->pendidikan_ayah }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted small mb-1">Pekerjaan</label>
                                <div class="h5">{{ $ortu->pekerjaan_ayah }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Ibu -->
                <div class="card mb-4 border-danger">
                    <div class="card-header bg-light-danger d-flex align-items-center">
                        <i class="bi bi-gender-female fs-4 text-danger me-3"></i>
                        <h5 class="mb-0">Data Ibu</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted small mb-1">Nama Lengkap</label>
                                <div class="h5">{{ $ortu->nama_ibu }}</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted small mb-1">Pendidikan Terakhir</label>
                                <div class="h5">
                                    <span class="badge bg-danger">
                                        {{ $ortu->pendidikan_ibu }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted small mb-1">Pekerjaan</label>
                                <div class="h5">{{ $ortu->pekerjaan_ibu }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontak & Alamat -->
                <div class="card border-success">
                    <div class="card-header bg-light-success d-flex align-items-center">
                        <i class="bi bi-geo-alt fs-4 text-success me-3"></i>
                        <h5 class="mb-0">Kontak & Alamat</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small mb-1">Nomor HP</label>
                                <div class="h5">
                                    <a href="tel:{{ $ortu->no_hp }}" class="text-decoration-none">
                                        <i class="bi bi-telephone-outbound me-2"></i>{{ $ortu->no_hp }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small mb-1">Alamat Lengkap</label>
                                <div class="h5">{{ $ortu->alamat }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-header {
            border-bottom: 2px solid rgba(0, 0, 0, .125);
        }

        .bg-light-primary {
            background-color: #e3f2fd;
        }

        .bg-light-danger {
            background-color: #f8d7da;
        }

        .bg-light-success {
            background-color: #d1e7dd;
        }

        .bg-light-info {
            background-color: #cff4fc;
        }

        .h5 {
            font-weight: 500;
        }
    </style>
@endsection
