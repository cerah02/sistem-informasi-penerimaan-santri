@extends('layout')
@section('content')
    <div class="container mt-4">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Detail Data Santri</h3>
            </div>

            <div class="card-body">
                <!-- Data Diri -->
                <div class="mb-5">
                    <h5 class="text-primary mb-4"><i class="bi bi-person-vcard me-2"></i>Data Diri Santri</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Nama Lengkap</dt>
                                <dd class="col-sm-8">{{ $santri->nama }}</dd>

                                <dt class="col-sm-4">NISN</dt>
                                <dd class="col-sm-8">{{ $santri->nisn }}</dd>

                                <dt class="col-sm-4">NIK</dt>
                                <dd class="col-sm-8">{{ $santri->nik }}</dd>

                                <dt class="col-sm-4">Jenis Kelamin</dt>
                                <dd class="col-sm-8">{{ ucfirst($santri->jenis_kelamin) }}</dd>

                                <dt class="col-sm-4">TTL</dt>
                                <dd class="col-sm-8">
                                    {{ $santri->ttl }}
                                </dd>
                                <dt class="col-sm-4">Keadaan Ekonomi</dt>
                                <dd class="col-sm-8">{{ $santri->kondisi }}</dd>
                                <dt class="col-sm-4">Kondisi Orang Tua</dt>
                                <dd class="col-sm-8">{{ $santri->kondisi_ortu }}</dd>
                                <dt class="col-sm-4">Status Dikeluarga</dt>
                                <dd class="col-sm-8">{{ $santri->status_dkluarga }}</dd>
                                <dt class="col-sm-4">Anak Ke-</dt>
                                <dd class="col-sm-8">{{ $santri->anak_ke }} Dari {{ $santri->jumlah_saudara }} Saudara</dd>
                            </dl>
                        </div>

                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Asal Sekolah</dt>
                                <dd class="col-sm-8">{{ $santri->asal_sekolah }}</dd>

                                <dt class="col-sm-4">Alamat</dt>
                                <dd class="col-sm-8">{{ $santri->alamat }}</dd>

                                <dt class="col-sm-4">No. Telepon</dt>
                                <dd class="col-sm-8">{{ $santri->nomor_telpon }}</dd>

                                <dt class="col-sm-4">Email</dt>
                                <dd class="col-sm-8">{{ $santri->email }}</dd>

                                <dt class="col-sm-4">Jenjang</dt>
                                <dd class="col-sm-8">{{ $santri->jenjang_pendidikan }}</dd>

                                <dt class="col-sm-4">Tahun Daftar</dt>
                                <dd class="col-sm-8">{{ $santri->tahun_masuk }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div class="mb-5">
                    <h5 class="text-primary mb-4"><i class="bi bi-people-fill me-2"></i>Data Orang Tua/Wali</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-secondary">Ayah</h6>
                            <dl class="row">
                                <dt class="col-sm-4">Nama</dt>
                                <dd class="col-sm-8">{{ $santri->ortu->nama_ayah ?? '-' }}</dd>

                                <dt class="col-sm-4">Pendidikan</dt>
                                <dd class="col-sm-8">{{ $santri->ortu->pendidikan_ayah ?? '-' }}</dd>

                                <dt class="col-sm-4">Pekerjaan</dt>
                                <dd class="col-sm-8">{{ $santri->ortu->pekerjaan_ayah ?? '-' }}</dd>
                            </dl>
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-secondary">Ibu</h6>
                            <dl class="row">
                                <dt class="col-sm-4">Nama</dt>
                                <dd class="col-sm-8">{{ $santri->ortu->nama_ibu ?? '-' }}</dd>

                                <dt class="col-sm-4">Pendidikan</dt>
                                <dd class="col-sm-8">{{ $santri->ortu->pendidikan_ibu ?? '-' }}</dd>

                                <dt class="col-sm-4">Pekerjaan</dt>
                                <dd class="col-sm-8">{{ $santri->ortu->pekerjaan_ibu ?? '-' }}</dd>
                            </dl>
                        </div>

                        <div class="col-md-12">
                            <dl class="row">
                                <dt class="col-sm-2">Alamat Orang Tua</dt>
                                <dd class="col-sm-10">{{ $santri->ortu->alamat ?? '-' }}</dd>

                                <dt class="col-sm-2">No. HP</dt>
                                <dd class="col-sm-10">{{ $santri->ortu->no_hp ?? '-' }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Data Kesehatan -->
                <div class="mb-5">
                    <h5 class="text-primary mb-4"><i class="bi bi-heart-pulse me-2"></i>Data Kesehatan</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <dl class="row">
                                <dt class="col-sm-6">Gol. Darah</dt>
                                <dd class="col-sm-6">{{ $santri->kesehatan->golongan_darah ?? '-' }}</dd>

                                <dt class="col-sm-6">Tinggi Badan</dt>
                                <dd class="col-sm-6">
                                    {{ $santri->kesehatan->tb ?? '-' }} cm
                                </dd>

                                <dt class="col-sm-6">Berat Badan</dt>
                                <dd class="col-sm-6">
                                    {{ $santri->kesehatan->bb ?? '-' }} kg
                                </dd>
                            </dl>
                        </div>

                        <div class="col-md-8">
                            <dt>Riwayat Penyakit</dt>
                            <dd>{{ $santri->kesehatan->riwayat_penyakit ?? 'Tidak ada riwayat penyakit' }}</dd>
                        </div>
                    </div>
                </div>

                <!-- Data Bantuan -->
                @if ($santri->bantuan)
                    <div class="mb-5">
                        <h5 class="text-primary mb-4"><i class="bi bi-hand-thumbs-up me-2"></i>Data Bantuan</h5>
                        <dl class="row">
                            <dt class="col-sm-3">Nama Bantuan</dt>
                            <dd class="col-sm-9">{{ $santri->bantuan->nama_bantuan }}</dd>

                            <dt class="col-sm-3">Tingkat Bantuan</dt>
                            <dd class="col-sm-9">{{ $santri->bantuan->tingkat }}</dd>

                            <dt class="col-sm-3">No. KIP</dt>
                            <dd class="col-sm-9">{{ $santri->bantuan->no_kip ?? '-' }}</dd>
                        </dl>
                    </div>
                @endif

                <!-- Berkas -->
                <div class="mb-4">
                    <h5 class="text-primary mb-4"><i class="bi bi-files me-2"></i>Dokumen</h5>
                    <div class="row g-3">
                        @if ($santri->dokumen)
                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="bi bi-file-pdf text-danger me-2"></i>Foto</h6>
                                        @if ($santri->dokumen->foto)
                                            <a href="{{ asset('storage/' . $santri->dokumen->foto) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                Lihat Dokumen
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="bi bi-file-pdf text-danger me-2"></i>Ijazah</h6>
                                        @if ($santri->dokumen->ijazah)
                                            <a href="{{ asset('storage/' . $santri->dokumen->ijazah) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                Lihat Dokumen
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="bi bi-file-pdf text-danger me-2"></i>Nilai Raport</h6>
                                        @if ($santri->dokumen->nilai_raport)
                                            <a href="{{ asset('storage/' . $santri->dokumen->nilai_raport) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                Lihat Dokumen
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="bi bi-file-pdf text-danger me-2"></i>Skhun</h6>
                                        @if ($santri->dokumen->skhun)
                                            <a href="{{ asset('storage/' . $santri->dokumen->skhun) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                Lihat Dokumen
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="bi bi-file-text text-primary me-2"></i>KK</h6>
                                        @if ($santri->dokumen->kk)
                                            <a href="{{ asset('storage/' . $santri->dokumen->kk) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                Lihat Dokumen
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="bi bi-file-text text-primary me-2"></i>KTP Ayah</h6>
                                        @if ($santri->dokumen->ktp_ayah)
                                            <a href="{{ asset('storage/' . $santri->dokumen->ktp_ayah) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                Lihat Dokumen
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="bi bi-file-text text-primary me-2"></i>KTP Ibu</h6>
                                        @if ($santri->dokumen->ktp_ibu)
                                            <a href="{{ asset('storage/' . $santri->dokumen->ktp_ibu) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                Lihat Dokumen
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Tambahkan dokumen lainnya dengan pola yang sama -->
                        @else
                            <div class="col-12">
                                <div class="alert alert-warning">
                                    Tidak ada dokumen yang diupload
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('pendaftarans.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        dt {
            font-weight: 500;
            color: #666;
        }

        dd {
            margin-bottom: 0.8rem;
            color: #333;
        }

        .card-header {
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .card {
            border-radius: 0.5rem;
        }
    </style>
@endsection
