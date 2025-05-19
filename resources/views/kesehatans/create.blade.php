@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Form Data Kesehatan Santri</h3>
                <a class="btn btn-light btn-sm" href="{{ route('kesehatans.index') }}">
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

                <form action="{{ route('kesehatans.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <!-- Input Santri -->
                        <div class="col-md-6">
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

                        <!-- Golongan Darah -->
                        <div class="col-12">
                            <label class="form-label fw-bold">
                                <i class="bi bi-droplet me-1 text-danger"></i>Golongan Darah
                            </label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="golongan_darah" id="golongan_darah_a"
                                    value="A" {{ old('golongan_darah') == 'A' ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger d-flex align-items-center" for="golongan_darah_a">
                                    <i class="bi bi-bloodletter fs-5 me-2"></i>A
                                </label>

                                <input type="radio" class="btn-check" name="golongan_darah" id="golongan_darah_b"
                                    value="B" {{ old('golongan_darah') == 'B' ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger d-flex align-items-center" for="golongan_darah_b">
                                    <i class="bi bi-bloodletter fs-5 me-2"></i>B
                                </label>

                                <input type="radio" class="btn-check" name="golongan_darah" id="golongan_darah_ab"
                                    value="AB" {{ old('golongan_darah') == 'AB' ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger d-flex align-items-center" for="golongan_darah_ab">
                                    <i class="bi bi-bloodletter fs-5 me-2"></i>AB
                                </label>

                                <input type="radio" class="btn-check" name="golongan_darah" id="golongan_darah_o"
                                    value="O" {{ old('golongan_darah') == 'O' ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger d-flex align-items-center" for="golongan_darah_o">
                                    <i class="bi bi-bloodletter fs-5 me-2"></i>O
                                </label>
                            </div>
                        </div>

                        <!-- Tinggi Badan -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="tb" class="form-control" id="tb"
                                    placeholder="Tinggi Badan" step="0.1" value="{{ old('tb') }}" required>
                                <label for="tb">
                                    <i class="bi bi-arrow-up me-1 text-success"></i>Tinggi Badan (cm)
                                </label>
                            </div>
                        </div>

                        <!-- Berat Badan -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="bb" class="form-control" id="bb"
                                    placeholder="Berat Badan" step="0.1" value="{{ old('bb') }}" required>
                                <label for="bb">
                                    <i class="bi bi-arrow-down me-1 text-warning"></i>Berat Badan (kg)
                                </label>
                            </div>
                        </div>

                        <!-- Riwayat Penyakit -->
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="riwayat_penyakit" class="form-control" id="riwayat_penyakit" placeholder="Riwayat Penyakit"
                                    style="height: 100px">{{ old('riwayat_penyakit') }}</textarea>
                                <label for="riwayat_penyakit">
                                    <i class="bi bi-clipboard2-pulse me-1 text-danger"></i>Riwayat Penyakit
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
        .form-select {
            border-radius: 8px;
        }

        .btn-lg {
            border-radius: 10px;
        }

        .btn-outline-danger {
            transition: all 0.3s ease;
        }

        .btn-check:checked+.btn-outline-danger {
            background-color: #dc3545;
            color: white !important;
        }
    </style>
@endsection
