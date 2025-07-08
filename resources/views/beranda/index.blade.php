@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Edit Konten Beranda</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('beranda.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        @foreach ($contents as $key => $content)
                            <div class="col-12">
                                @if (str_contains($key, 'image'))
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-image me-1"></i>{{ ucfirst(str_replace('_', ' ', $key)) }}
                                        </label>
                                        <input type="file" name="{{ $key }}" class="form-control mb-2">

                                        <!-- Preview gambar saat ini -->
                                        @if ($content->value)
                                            <img src="{{ asset($content->value) }}" alt="{{ $key }}"
                                                class="img-thumbnail" style="max-height: 150px;">
                                            <small class="form-text text-muted d-block mt-1">
                                                Biarkan kosong jika tidak ingin mengganti gambar.
                                            </small>
                                        @endif
                                    </div>
                                @else
                                    <div class="form-floating">
                                        <input type="text" name="{{ $key }}" class="form-control"
                                            id="{{ $key }}"
                                            placeholder="{{ ucfirst(str_replace('_', ' ', $key)) }}"
                                            value="{{ $content->value }}">
                                        <label for="{{ $key }}">
                                            <i class="bi bi-pencil me-1"></i>{{ ucfirst(str_replace('_', ' ', $key)) }}
                                        </label>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
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

    .form-floating label {
        padding-left: 2.5rem;
    }
</style>
