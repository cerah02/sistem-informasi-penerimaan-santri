@extends('layout')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Form Riwayat Bantuan Calon Santri</h3>
                <a class="btn btn-light btn-sm" href="{{ route('bantuans.index') }}">
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

                <form action="{{ route('bantuans.store') }}" method="POST">
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

                        <!-- Input Nama Bantuan -->
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="nama_bantuan" class="form-control" id="nama_bantuan"
                                    placeholder="Masukan Nama Bantuan" value="{{ old('nama_bantuan') }}" required>
                                <label for="nama_bantuan">
                                    <i class="bi bi-award me-1"></i>Nama Bantuan
                                </label>
                            </div>
                        </div>

                        <!-- Input Tingkat Bantuan -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="tingkat" class="form-control" id="tingkat"
                                    placeholder="Masukan Tingkat Bantuan" value="{{ old('tingkat') }}" required>
                                <label for="tingkat">
                                    <i class="bi bi-bar-chart-line me-1"></i>Tingkat Bantuan
                                </label>
                            </div>
                        </div>

                        <!-- Input Nomor KIP -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="no_kip" class="form-control" id="no_kip"
                                    placeholder="Masukan Nomor KIP" value="{{ old('no_kip') }}">
                                <label for="no_kip">
                                    <i class="bi bi-credit-card me-1"></i>Nomor KIP
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
@endsection

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
</style>
