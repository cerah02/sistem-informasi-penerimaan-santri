@extends('layout')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-3xl font-bold text-primary">Edit Notifikasi</h2>
            <a href="{{ route('notifikasi.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <div class="card border-0 shadow-lg">
            <div class="card-body p-5">
                <form action="{{ route('notifikasi.update', $notif->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="form-label fw-bold text-muted">
                            <i class="bi bi-pencil-square me-2"></i>Judul Notifikasi
                        </label>
                        <input type="text" name="title"
                            class="form-control form-control-lg @error('title') is-invalid @enderror"
                            value="{{ old('title', $notif->data['title']) }}" placeholder="Masukkan judul notifikasi">
                        @error('title')
                            <div class="invalid-feedback mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label fw-bold text-muted">
                            <i class="bi bi-chat-text me-2"></i>Isi Pesan
                        </label>
                        <textarea name="message" class="form-control form-control-lg @error('message') is-invalid @enderror" rows="5"
                            placeholder="Tulis isi pesan notifikasi">{{ old('message', $notif->data['message']) }}</textarea>
                        @error('message')
                            <div class="invalid-feedback mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
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
</style>
