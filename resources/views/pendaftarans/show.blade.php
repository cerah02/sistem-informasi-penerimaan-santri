@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="card border-0 shadow-lg">
            <!-- Card Header -->
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">
                            <i class="bi bi-person-badge me-2"></i>Detail Data Santri
                        </h3>
                        <small class="text-white-50">ID: {{ $santri->id }}</small>
                    </div>
                    <div>
                        <a href="{{ route('pendaftarans.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <!-- Profile Section -->
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <div class="position-relative">
                            @if ($santri->dokumen && $santri->dokumen->foto)
                                <img src="{{ asset('storage/' . $santri->dokumen->foto) }}"
                                    class="img-thumbnail rounded-circle shadow-sm"
                                    style="width: 180px; height: 180px; object-fit: cover;" alt="Foto Santri">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light rounded-circle shadow-sm"
                                    style="width: 180px; height: 180px;">
                                    <i class="bi bi-person fs-1 text-secondary"></i>
                                </div>
                            @endif
                            <div class="position-absolute bottom-0 end-0">
                                <a href="{{ route('santris.edit', $santri->id) }}"
                                    class="btn btn-warning btn-sm rounded-circle shadow">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">{{ $santri->nama }}</h5>
                            <small class="text-muted">{{ $santri->jenjang_pendidikan }}</small>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="row">
                            <!-- Quick Info Cards -->
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <div class="text-primary mb-2">
                                            <i class="bi bi-calendar-date fs-4"></i>
                                        </div>
                                        <h6 class="card-title text-muted">Tanggal Lahir</h6>
                                        <p class="card-text">
                                            {{ \Carbon\Carbon::parse($santri->tanggal_lahir)->isoFormat('D MMMM Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <div class="text-primary mb-2">
                                            <i class="bi bi-telephone fs-4"></i>
                                        </div>
                                        <h6 class="card-title text-muted">Kontak</h6>
                                        <p class="card-text">{{ $santri->nomor_telpon }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <div class="text-primary mb-2">
                                            <i class="bi bi-house-door fs-4"></i>
                                        </div>
                                        <h6 class="card-title text-muted">Alamat</h6>
                                        <p class="card-text text-truncate" title="{{ $santri->alamat }}">
                                            {{ Str::limit($santri->alamat, 25) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Tabs -->
                <ul class="nav nav-tabs mb-4" id="santriTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal"
                            type="button" role="tab">
                            <i class="bi bi-person-lines-fill me-1"></i> Data Pribadi
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="parents-tab" data-bs-toggle="tab" data-bs-target="#parents"
                            type="button" role="tab">
                            <i class="bi bi-people-fill me-1"></i> Orang Tua
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="health-tab" data-bs-toggle="tab" data-bs-target="#health"
                            type="button" role="tab">
                            <i class="bi bi-heart-pulse me-1"></i> Kesehatan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="assistance-tab" data-bs-toggle="tab" data-bs-target="#assistance"
                            type="button" role="tab">
                            <i class="bi bi-hand-thumbs-up me-1"></i> Bantuan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents"
                            type="button" role="tab">
                            <i class="bi bi-folder me-1"></i> Dokumen
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="santriTabContent">
                    <!-- Personal Data Tab -->
                    <div class="tab-pane fade show active" id="personal" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Dasar</h6>
                                    </div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-5 text-muted">NISN</dt>
                                            <dd class="col-sm-7">{{ $santri->nisn }}</dd>

                                            <dt class="col-sm-5 text-muted">NIK</dt>
                                            <dd class="col-sm-7">{{ $santri->nik }}</dd>

                                            <dt class="col-sm-5 text-muted">Jenis Kelamin</dt>
                                            <dd class="col-sm-7">
                                                @if ($santri->jenis_kelamin == 'laki-laki')
                                                    <span class="badge bg-primary">
                                                        <i class="bi bi-gender-male"></i> Laki-laki
                                                    </span>
                                                @else
                                                    <span class="badge bg-pink">
                                                        <i class="bi bi-gender-female"></i> Perempuan
                                                    </span>
                                                @endif
                                            </dd>

                                            <dt class="col-sm-5 text-muted">TTL</dt>
                                            <dd class="col-sm-7">{{ $santri->ttl }}</dd>

                                            <dt class="col-sm-5 text-muted">Asal Sekolah</dt>
                                            <dd class="col-sm-7">{{ $santri->asal_sekolah }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="bi bi-house-heart me-2"></i>Informasi Keluarga</h6>
                                    </div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-5 text-muted">Status Keluarga</dt>
                                            <dd class="col-sm-7">{{ $santri->status_dkluarga }}</dd>

                                            <dt class="col-sm-5 text-muted">Anak Ke-</dt>
                                            <dd class="col-sm-7">{{ $santri->anak_ke }} dari
                                                {{ $santri->jumlah_saudara }} bersaudara</dd>

                                            <dt class="col-sm-5 text-muted">Tempat Tinggal</dt>
                                            <dd class="col-sm-7">
                                                {{ $santri->tempat_tinggal }}
                                                @if ($santri->tempat_tinggal == 'Lainnya' && $santri->tempat_tinggal_lainnya)
                                                    ({{ $santri->tempat_tinggal_lainnya }})
                                                @endif
                                            </dd>

                                            <dt class="col-sm-5 text-muted">Kondisi Ekonomi</dt>
                                            <dd class="col-sm-7">
                                                <span
                                                    class="badge {{ $santri->kondisi == 'Berkecukupan' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                    {{ $santri->kondisi }}
                                                </span>
                                            </dd>

                                            <dt class="col-sm-5 text-muted">Kondisi Orang Tua</dt>
                                            <dd class="col-sm-7">{{ $santri->kondisi_ortu }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="bi bi-envelope me-2"></i>Kontak & Alamat</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-4 text-muted">Email</dt>
                                                    <dd class="col-sm-8">
                                                        <a href="mailto:{{ $santri->email }}">{{ $santri->email }}</a>
                                                    </dd>

                                                    <dt class="col-sm-4 text-muted">Telepon</dt>
                                                    <dd class="col-sm-8">{{ $santri->nomor_telpon }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <dt class="text-muted">Alamat Lengkap</dt>
                                                <dd>{{ $santri->alamat }}</dd>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Parents Data Tab -->
                    <div class="tab-pane fade" id="parents" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0"><i class="bi bi-gender-male text-primary me-2"></i>Data Ayah
                                        </h6>
                                        <a href="{{ route('ortus.edit', $santri->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-4 text-muted">Nama</dt>
                                            <dd class="col-sm-8">{{ $santri->ortu->nama_ayah ?? '-' }}</dd>

                                            <dt class="col-sm-4 text-muted">Pendidikan</dt>
                                            <dd class="col-sm-8">{{ $santri->ortu->pendidikan_ayah ?? '-' }}</dd>

                                            <dt class="col-sm-4 text-muted">Pekerjaan</dt>
                                            <dd class="col-sm-8">{{ $santri->ortu->pekerjaan_ayah ?? '-' }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0"><i class="bi bi-gender-female text-pink me-2"></i>Data Ibu</h6>
                                        <a href="{{ route('ortus.edit', $santri->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-4 text-muted">Nama</dt>
                                            <dd class="col-sm-8">{{ $santri->ortu->nama_ibu ?? '-' }}</dd>

                                            <dt class="col-sm-4 text-muted">Pendidikan</dt>
                                            <dd class="col-sm-8">{{ $santri->ortu->pendidikan_ibu ?? '-' }}</dd>

                                            <dt class="col-sm-4 text-muted">Pekerjaan</dt>
                                            <dd class="col-sm-8">{{ $santri->ortu->pekerjaan_ibu ?? '-' }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="bi bi-telephone-forward me-2"></i>Kontak Orang Tua
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-4 text-muted">Nomor HP</dt>
                                                    <dd class="col-sm-8">
                                                        <a href="tel:{{ $santri->ortu->no_hp ?? '' }}">
                                                            {{ $santri->ortu->no_hp ?? '-' }}
                                                        </a>
                                                    </dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <dt class="text-muted">Alamat Orang Tua</dt>
                                                <dd>{{ $santri->ortu->alamat ?? '-' }}</dd>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Health Data Tab -->
                    <div class="tab-pane fade" id="health" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0"><i class="bi bi-droplet text-danger me-2"></i>Golongan Darah
                                        </h6>
                                        <a href="{{ route('kesehatans.edit', $santri->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </div>
                                    <div class="card-body text-center py-4">
                                        @if ($santri->kesehatan && $santri->kesehatan->golongan_darah)
                                            <div class="blood-type-display">
                                                <span class="blood-type">{{ $santri->kesehatan->golongan_darah }}</span>
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">Data tidak tersedia</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0"><i class="bi bi-arrow-up text-success me-2"></i>Tinggi Badan
                                        </h6>
                                        <a href="{{ route('kesehatans.edit', $santri->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </div>
                                    <div class="card-body text-center py-4">
                                        @if ($santri->kesehatan && $santri->kesehatan->tb)
                                            <div class="d-flex justify-content-center align-items-end">
                                                <span class="display-4 fw-bold">{{ $santri->kesehatan->tb }}</span>
                                                <span class="ms-2 text-muted">cm</span>
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">Data tidak tersedia</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0"><i class="bi bi-arrow-down text-warning me-2"></i>Berat Badan
                                        </h6>
                                        <a href="{{ route('kesehatans.edit', $santri->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </div>
                                    <div class="card-body text-center py-4">
                                        @if ($santri->kesehatan && $santri->kesehatan->bb)
                                            <div class="d-flex justify-content-center align-items-end">
                                                <span class="display-4 fw-bold">{{ $santri->kesehatan->bb }}</span>
                                                <span class="ms-2 text-muted">kg</span>
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">Data tidak tersedia</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0"><i class="bi bi-clipboard2-pulse text-danger me-2"></i>Riwayat
                                            Penyakit</h6>
                                        <a href="{{ route('kesehatans.edit', $santri->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        @if ($santri->kesehatan && $santri->kesehatan->riwayat_penyakit)
                                            <p>{{ $santri->kesehatan->riwayat_penyakit }}</p>
                                        @else
                                            <p class="text-muted mb-0">Tidak ada riwayat penyakit</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assistance Data Tab -->
                    <div class="tab-pane fade" id="assistance" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0"><i class="bi bi-card-heading text-success me-2"></i>Informasi
                                            Bantuan</h6>
                                        <a href="{{ route('bantuans.edit', $santri->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-4 text-muted">Status Bantuan</dt>
                                            <dd class="col-sm-8">
                                                @if ($santri->bantuan && $santri->bantuan->nama_bantuan)
                                                    <span class="badge bg-success">Menerima Bantuan</span>
                                                @else
                                                    <span class="badge bg-secondary">Tidak Menerima</span>
                                                @endif
                                            </dd>

                                            <dt class="col-sm-4 text-muted">Nama Bantuan</dt>
                                            <dd class="col-sm-8">{{ $santri->bantuan->nama_bantuan ?? '-' }}</dd>

                                            <dt class="col-sm-4 text-muted">Tingkat</dt>
                                            <dd class="col-sm-8">{{ $santri->bantuan->tingkat ?? '-' }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0"><i class="bi bi-credit-card text-info me-2"></i>Kartu Indonesia
                                            Pintar</h6>
                                        <a href="{{ route('bantuans.edit', $santri->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </div>
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        @if ($santri->bantuan && $santri->bantuan->no_kip)
                                            <div class="text-center">
                                                <div class="mb-3">
                                                    <i class="bi bi-credit-card-2-front fs-1 text-primary"></i>
                                                </div>
                                                <h5>{{ $santri->bantuan->no_kip }}</h5>
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">Tidak memiliki KIP</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Tab -->
                    <div class="tab-pane fade" id="documents" role="tabpanel">
                        @if ($santri->dokumen)
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div
                                            class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><i class="bi bi-file-pdf text-danger me-2"></i>Ijazah</h6>
                                            <a href="{{ route('dokumens.edit', $santri->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        </div>
                                        <div class="card-body text-center">
                                            @if ($santri->dokumen->ijazah)
                                                <div class="mb-3">
                                                    <i class="bi bi-file-earmark-pdf fs-1 text-danger"></i>
                                                </div>
                                                <a href="{{ asset('storage/' . $santri->dokumen->ijazah) }}"
                                                    target="_blank" class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-download me-1"></i> Unduh
                                                </a>
                                            @else
                                                <p class="text-muted mb-0">Dokumen tidak tersedia</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div
                                            class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><i class="bi bi-file-pdf text-danger me-2"></i>Akta
                                                Kelahiran</h6>
                                            <a href="{{ route('dokumens.edit', $santri->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        </div>
                                        <div class="card-body text-center">
                                            @if ($santri->dokumen->akta_kelahiran)
                                                <div class="mb-3">
                                                    <i class="bi bi-file-earmark-pdf fs-1 text-danger"></i>
                                                </div>
                                                <a href="{{ asset('storage/' . $santri->dokumen->akta_kelahiran) }}"
                                                    target="_blank" class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-download me-1"></i> Unduh
                                                </a>
                                            @else
                                                <p class="text-muted mb-0">Dokumen tidak tersedia</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div
                                            class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><i class="bi bi-file-text text-primary me-2"></i>SKHUN</h6>
                                            <a href="{{ route('dokumens.edit', $santri->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        </div>
                                        <div class="card-body text-center">
                                            @if ($santri->dokumen->skhun)
                                                <div class="mb-3">
                                                    <i class="bi bi-file-earmark-text fs-1 text-primary"></i>
                                                </div>
                                                <a href="{{ asset('storage/' . $santri->dokumen->skhun) }}"
                                                    target="_blank" class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-download me-1"></i> Unduh
                                                </a>
                                            @else
                                                <p class="text-muted mb-0">Dokumen tidak tersedia</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div
                                            class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><i
                                                    class="bi bi-file-spreadsheet text-success me-2"></i>Nilai Raport</h6>
                                            <a href="{{ route('dokumens.edit', $santri->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        </div>
                                        <div class="card-body text-center">
                                            @if ($santri->dokumen->nilai_raport)
                                                <div class="mb-3">
                                                    <i class="bi bi-file-earmark-spreadsheet fs-1 text-success"></i>
                                                </div>
                                                <a href="{{ asset('storage/' . $santri->dokumen->nilai_raport) }}"
                                                    target="_blank" class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-download me-1"></i> Unduh
                                                </a>
                                            @else
                                                <p class="text-muted mb-0">Dokumen tidak tersedia</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div
                                            class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><i class="bi bi-people-fill text-info me-2"></i>Kartu
                                                Keluarga</h6>
                                            <a href="{{ route('dokumens.edit', $santri->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        </div>
                                        <div class="card-body text-center">
                                            @if ($santri->dokumen->kk)
                                                <div class="mb-3">
                                                    <i class="bi bi-file-earmark-text fs-1 text-info"></i>
                                                </div>
                                                <a href="{{ asset('storage/' . $santri->dokumen->kk) }}" target="_blank"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-download me-1"></i> Unduh
                                                </a>
                                            @else
                                                <p class="text-muted mb-0">Dokumen tidak tersedia</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div
                                            class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><i class="bi bi-person-badge text-secondary me-2"></i>KTP
                                                Orang Tua</h6>
                                            <a href="{{ route('dokumens.edit', $santri->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        </div>
                                        <div class="card-body text-center">
                                            @if ($santri->dokumen->ktp_ayah || $santri->dokumen->ktp_ibu)
                                                <div class="mb-3">
                                                    <i class="bi bi-file-earmark-person fs-1 text-secondary"></i>
                                                </div>
                                                <div class="d-flex justify-content-center gap-2">
                                                    @if ($santri->dokumen->ktp_ayah)
                                                        <a href="{{ asset('storage/' . $santri->dokumen->ktp_ayah) }}"
                                                            target="_blank" class="btn btn-outline-primary btn-sm">
                                                            <i class="bi bi-gender-male me-1"></i> Ayah
                                                        </a>
                                                    @endif
                                                    @if ($santri->dokumen->ktp_ibu)
                                                        <a href="{{ asset('storage/' . $santri->dokumen->ktp_ibu) }}"
                                                            target="_blank" class="btn btn-outline-primary btn-sm">
                                                            <i class="bi bi-gender-female me-1"></i> Ibu
                                                        </a>
                                                    @endif
                                                </div>
                                            @else
                                                <p class="text-muted mb-0">Dokumen tidak tersedia</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i> Tidak ada dokumen yang diunggah
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        <i class="bi bi-clock-history me-1"></i>
                        Terdaftar pada: {{ $santri->created_at->isoFormat('D MMMM Y HH:mm') }}
                    </small>
                    <small class="text-muted">
                        <i class="bi bi-arrow-repeat me-1"></i>
                        Terakhir diperbarui: {{ $santri->updated_at->isoFormat('D MMMM Y HH:mm') }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <style>
        .blood-type-display {
            width: 100px;
            height: 100px;
            margin: 0 auto;
            border-radius: 50%;
            background-color: #f8d7da;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #dc3545;
        }

        .blood-type {
            font-size: 2.5rem;
            font-weight: bold;
            color: #dc3545;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 0.75rem 1.25rem;
            border-bottom: 3px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            background-color: transparent;
            border-bottom: 3px solid #0d6efd;
        }

        .nav-tabs .nav-link:hover {
            border-bottom: 3px solid #dee2e6;
        }

        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
        }

        .badge.bg-pink {
            background-color: #ffc0cb;
            color: #000;
        }
    </style>
@endsection
