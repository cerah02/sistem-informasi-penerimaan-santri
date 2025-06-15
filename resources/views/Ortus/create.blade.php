@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Form Data Orang Tua/Wali Santri</h3>
                <a class="btn btn-light btn-sm" href="{{ route('ortus.index') }}">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Validasi Gagal!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('ortus.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <!-- Input Santri -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select name="santri_id" id="santri_id" class="form-select" required>
                                    <option value="">Pilih Santri</option>
                                    @foreach ($santris as $santri)
                                        <option value="{{ $santri->id }}"
                                            {{ old('santri_id') == $santri->id ? 'selected' : '' }}>
                                            {{ $santri->id }} - {{ $santri->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="santri_id" class="form-label">
                                    <i class="bi bi-person-circle me-1"></i>Nama Santri
                                </label>
                            </div>
                        </div>

                        <!-- Data Ayah -->
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="nama_ayah" class="form-control" id="nama_ayah"
                                    placeholder="Nama Ayah" value="{{ old('nama_ayah') }}" required>
                                <label for="nama_ayah">
                                    <i class="bi bi-gender-male me-1 text-primary"></i>Nama Ayah
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="pendidikan_ayah" class="form-control" id="pendidikan_ayah"
                                    placeholder="Pendidikan Ayah" value="{{ old('pendidikan_ayah') }}" required>
                                <label for="pendidikan_ayah">
                                    <i class="bi bi-mortarboard me-1 text-info"></i>Pendidikan Ayah
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="pekerjaan_ayah" class="form-control" id="pekerjaan_ayah"
                                    placeholder="Pekerjaan Ayah" value="{{ old('pekerjaan_ayah') }}" required>
                                <label for="pekerjaan_ayah">
                                    <i class="bi bi-briefcase me-1 text-success"></i>Pekerjaan Ayah
                                </label>
                            </div>
                        </div>

                        <!-- Data Ibu -->
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="nama_ibu" class="form-control" id="nama_ibu"
                                    placeholder="Nama Ibu" value="{{ old('nama_ibu') }}" required>
                                <label for="nama_ibu">
                                    <i class="bi bi-gender-female me-1 text-danger"></i>Nama Ibu
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="pendidikan_ibu" class="form-control" id="pendidikan_ibu"
                                    placeholder="Pendidikan Ibu" value="{{ old('pendidikan_ibu') }}" required>
                                <label for="pendidikan_ibu">
                                    <i class="bi bi-mortarboard me-1 text-info"></i>Pendidikan Ibu
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="pekerjaan_ibu" class="form-control" id="pekerjaan_ibu"
                                    placeholder="Pekerjaan Ibu" value="{{ old('pekerjaan_ibu') }}" required>
                                <label for="pekerjaan_ibu">
                                    <i class="bi bi-briefcase me-1 text-success"></i>Pekerjaan Ibu
                                </label>
                            </div>
                        </div>

                        <!-- Kontak dan Alamat -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" name="no_hp" class="form-control" id="no_hp"
                                    placeholder="Nomor HP" value="{{ old('no_hp') }}" required>
                                <label for="no_hp">
                                    <i class="bi bi-phone me-1 text-warning"></i>Nomor HP
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <textarea name="alamat_ortu" class="form-control" id="alamat_ortu" placeholder="Alamat Orang Tua" style="height: 100px"
                                    required>{{ old('alamat_ortu') }}</textarea>
                                <label for="alamat_ortu">
                                    <i class="bi bi-house-door me-1 text-secondary"></i>Alamat Lengkap
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-save me-2"></i>Simpan Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .form-floating label {
            padding-left: 2.5rem;
        }

        .card {
            border-radius: 15px;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
        }

        .form-control,
        .form-select,
        .form-floating>textarea {
            border-radius: 8px;
        }

        .btn-lg {
            border-radius: 10px;
        }

        .text-primary {
            color: #0d6efd !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-success {
            color: #198754 !important;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .text-info {
            color: #0dcaf0 !important;
        }

        .text-secondary {
            color: #6c757d !important;
        }
    </style>
@endsection
