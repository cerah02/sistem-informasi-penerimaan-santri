@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a class="btn btn-light btn-primary" href="{{ route('kesehatans.index') }}">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-lg">
            <!-- Header Card -->
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0">
                    <i class="bi bi-clipboard2-pulse me-2"></i>Informasi Kesehatan
                </h4>
            </div>

            <div class="card-body p-4">
                <!-- Data Santri -->
                <div class="row mb-4">
                    <div class="col-md-12 mb-3">
                        <div class="alert alert-info bg-light-info border-info">
                            <h5 class="mb-0">
                                <i class="bi bi-person-vcard me-2"></i>
                                Santri Terkait: <strong>{{ $kesehatan->santri->nama ?? 'N/A' }}</strong>
                            </h5>
                        </div>
                    </div>
                </div>

                <!-- Vital Signs -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="card border-primary h-100">
                            <div class="card-header bg-light-primary d-flex align-items-center">
                                <i class="bi bi-droplet fs-4 text-primary me-3"></i>
                                <h5 class="mb-0">Golongan Darah</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="display-4 fw-bold text-primary">
                                    {{ $kesehatan->golongan_darah ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-success h-100">
                            <div class="card-header bg-light-success d-flex align-items-center">
                                <i class="bi bi-rulers fs-4 text-success me-3"></i>
                                <h5 class="mb-0">Parameter Fisik</h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="h5 text-muted">Tinggi Badan</div>
                                        <div class="h2 fw-bold text-success">
                                            {{ $kesehatan->tb }} <small class="h5">cm</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="h5 text-muted">Berat Badan</div>
                                        <div class="h2 fw-bold text-success">
                                            {{ $kesehatan->bb }} <small class="h5">kg</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Medical History -->
                <div class="card border-warning">
                    <div class="card-header bg-light-warning d-flex align-items-center">
                        <i class="bi bi-clipboard2-x fs-4 text-warning me-3"></i>
                        <h5 class="mb-0">Riwayat Kesehatan</h5>
                    </div>
                    <div class="card-body">
                        @if ($kesehatan->riwayat_penyakit)
                            <div class="alert alert-warning bg-light-warning mb-0">
                                {!! nl2br(e($kesehatan->riwayat_penyakit)) !!}
                            </div>
                        @else
                            <div class="text-center text-muted py-3">
                                <i class="bi bi-check2-circle me-2"></i>Tidak ada riwayat penyakit
                            </div>
                        @endif
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

        .bg-light-success {
            background-color: #d1e7dd;
        }

        .bg-light-warning {
            background-color: #fff3cd;
        }

        .bg-light-info {
            background-color: #cff4fc;
        }

        .display-4 {
            font-size: 2.5rem;
        }
    </style>
@endsection
