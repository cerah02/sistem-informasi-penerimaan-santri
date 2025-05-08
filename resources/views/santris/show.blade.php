@extends('layout')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Detail Santri - {{ $santri->nama }}</h3>
                <a class="btn btn-light" href="{{ route('santris.index') }}">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>

            <div class="card-body">
                <!-- Data Pribadi -->
                <div class="card mb-4 border-primary">
                    <div class="card-header bg-light-primary">
                        <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Data Pribadi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">NISN</label>
                                <div class="h5">{{ $santri->nisn }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">NIK</label>
                                <div class="h5">{{ $santri->nik }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Jenis Kelamin</label>
                                <div class="h5">
                                    <span class="badge bg-primary">
                                        {{ ucfirst($santri->jenis_kelamin) }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Tempat dan Tanggal Lahir</label>
                                <div class="h5">
                                    {{ $santri->ttl }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Pendidikan -->
                <div class="card mb-4 border-success">
                    <div class="card-header bg-light-success">
                        <h5 class="mb-0"><i class="bi bi-book me-2"></i>Data Pendidikan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Asal Sekolah</label>
                                <div class="h5">{{ $santri->asal_sekolah }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Jenjang Di Daftar</label>
                                <div class="h5 text-success">
                                    <i class="bi bi-mortarboard me-2"></i>{{ $santri->jenjang_pendidikan }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Tahun Masuk</label>
                                <div class="h5">
                                    <span class="badge bg-success">
                                        {{ $santri->tahun_masuk }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Keluarga -->
                <div class="card mb-4 border-warning">
                    <div class="card-header bg-light-warning">
                        <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i>Data Keluarga</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Status Keluarga</label>
                                <div class="h5">{{ $santri->status_dkluarga }}</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Anak Ke-</label>
                                <div class="h5">{{ $santri->anak_ke }} Dari {{ $santri->jumlah_saudara }} Saudara</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Tinggal Bersama</label>
                                <div class="h5">{{ $santri->tempat_tinggal }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Kondisi Ekonomi</label>
                                <div class="h5">
                                    <span class="badge bg-warning text-dark">
                                        {{ $santri->kondisi }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Keadaan Orang Tua</label>
                                <div class="h5">{{ $santri->kondisi_ortu }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Kontak -->
                <div class="card border-info">
                    <div class="card-header bg-light-info">
                        <h5 class="mb-0"><i class="bi bi-telephone me-2"></i>Kontak & Alamat</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Alamat</label>
                                <div class="h5">{{ $santri->alamat }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Nomor Telepon</label>
                                <div class="h5">
                                    <a href="tel:{{ $santri->nomor_telpon }}" class="text-decoration-none">
                                        <i class="bi bi-phone me-2"></i>{{ $santri->nomor_telpon }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Email</label>
                                <div class="h5">
                                    <a href="mailto:{{ $santri->email }}" class="text-decoration-none">
                                        <i class="bi bi-envelope me-2"></i>{{ $santri->email }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Kewarganegaraan</label>
                                <div class="h5">{{ $santri->kewarganegaraan }}</div>
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

        .bg-light-success {
            background-color: #d1e7dd;
        }

        .bg-light-warning {
            background-color: #fff3cd;
        }

        .bg-light-info {
            background-color: #cff4fc;
        }

        .h5 {
            font-weight: 500;
        }

        .form-label {
            font-size: 0.9rem;
        }
    </style>
@endsection
