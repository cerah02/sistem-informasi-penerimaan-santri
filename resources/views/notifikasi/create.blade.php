@extends('layout')

@section('content')
    <div class="container mt-5">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-3xl font-bold text-primary">
                <i class="bi bi-bell-fill me-2"></i>Buat Notifikasi Baru
            </h2>
            <a href="{{ route('notifikasi.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <!-- Card Container -->
        <div class="card border-0 shadow-lg">
            <div class="card-body p-5">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <h5 class="alert-heading">
                            <i class="bi bi-exclamation-octagon-fill me-2"></i>Terjadi Kesalahan!
                        </h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('admin.notifikasi.store') }}" method="POST">
                    @csrf

                    <!-- Recipient Selection -->
                    <div class="mb-4">
                        <label for="santri_id" class="form-label fw-bold text-muted">
                            <i class="bi bi-person-fill me-2"></i>Penerima Notifikasi
                        </label>
                        <select class="form-select form-select-lg @error('santri_id') is-invalid @enderror" name="santri_id"
                            required>
                            <option value="" disabled selected>Pilih Santri</option>
                            @foreach ($santris as $santri)
                                <option value="{{ $santri->user->id }}"
                                    {{ old('santri_id') == $santri->user->id ? 'selected' : '' }}>
                                    {{ $santri->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('santri_id')
                            <div class="invalid-feedback mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Title Input -->
                    <div class="mb-4">
                        <label for="title" class="form-label fw-bold text-muted">
                            <i class="bi bi-pencil-square me-2"></i>Judul Notifikasi
                        </label>
                        <input type="text" name="title"
                            class="form-control form-control-lg @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" placeholder="Masukkan judul notifikasi">
                        @error('title')
                            <div class="invalid-feedback mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Message Input -->
                    <div class="mb-4">
                        <label for="message" class="form-label fw-bold text-muted">
                            <i class="bi bi-chat-text me-2"></i>Isi Pesan
                        </label>
                        <textarea name="message" class="form-control form-control-lg @error('message') is-invalid @enderror" rows="5"
                            placeholder="Tulis isi pesan notifikasi">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary btn-lg py-3">
                            <i class="bi bi-save-fill me-2"></i>Simpan Notifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    .card {
        border-radius: 15px;
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .form-control-lg {
        border-radius: 10px;
        padding: 1rem 1.5rem;
    }

    .btn-lg {
        padding: 0.8rem 2rem;
        border-radius: 10px;
        font-size: 1.1rem;
    }

    .text-3xl {
        font-size: 1.75rem;
    }
</style>
