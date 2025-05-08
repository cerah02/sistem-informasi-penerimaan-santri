@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a class="btn btn-light btn-primary" href="{{ route('bantuans.index') }}">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-lg">
            <!-- Header Card -->
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0">
                    <i class="bi bi-award me-2"></i>Informasi Bantuan Pendidikan
                </h4>
            </div>

            <div class="card-body p-4">
                <!-- Santri Info -->
                <div class="row mb-4">
                    <div class="col-md-12 mb-3">
                        <div class="alert alert-info bg-light-info border-info">
                            <h5 class="mb-0">
                                <i class="bi bi-person-vcard me-2"></i>
                                Santri Penerima: <strong>{{ $bantuan->santri->nama ?? 'N/A' }}</strong>
                            </h5>
                        </div>
                    </div>
                </div>

                <!-- Bantuan Details -->
                <div class="card mb-4 border-success">
                    <div class="card-header bg-light-success d-flex align-items-center">
                        <i class="bi bi-info-circle fs-4 text-success me-3"></i>
                        <h5 class="mb-0">Detail Bantuan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small mb-1">Nama Bantuan</label>
                                <div class="h4 text-success">
                                    <i class="bi bi-patch-check me-2"></i>{{ $bantuan->nama_bantuan }}
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small mb-1">Tingkat Bantuan</label>
                                <div class="h5">
                                    <span class="badge bg-success py-2 px-3">
                                        {{ $bantuan->tingkat }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                    <div>
                                        <label class="form-label text-muted small mb-1">Nomor KIP</label>
                                        <div class="h5 mb-0">
                                            {{ $bantuan->no_kip ?? '-' }}
                                        </div>
                                    </div>
                                    <i class="bi bi-credit-card-2-front fs-1 text-secondary"></i>
                                </div>
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

        .bg-light-info {
            background-color: #cff4fc;
        }

        .bg-light-success {
            background-color: #d1e7dd;
        }

        .h4 {
            font-weight: 600;
        }

        .h5 {
            font-weight: 500;
        }
    </style>
@endsection
