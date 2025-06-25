@extends('layout')
@section('content')
    {{-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Pengumuman Utama</h2>
                <p class="text-muted">Hanya satu pengumuman yang dapat ditampilkan secara aktif</p>
            </div>
            @can('pengumuman-create')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('pengumuman.create') }}">
                        <i class="fas fa-plus"></i> Buat Pengumuman Baru
                    </a>
                </div>
            @endcan
        </div>
    </div> --}}

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-fluid px-0">
        <div class="row mx-0">
            <div class="col-12 px-0">

                @if ($pengumuman)
                    <!-- Card Pengumuman -->
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-header bg-primary text-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">{{ $pengumuman->judul }}</h3>
                                <span class="badge bg-{{ $pengumuman->is_active ? 'success' : 'secondary' }} fs-6">
                                    {{ $pengumuman->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                            <p class="card-subtitle mt-2 mb-0">
                                <i class="far fa-calendar-alt me-2"></i>
                                {{ \Carbon\Carbon::parse($pengumuman->tanggal_rilis)->isoFormat('D MMMM YYYY') }}
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="pengumuman-content">
                                {!! $pengumuman->konten !!}
                            </div>
                        </div>
                        <div class="card-footer bg-light d-flex justify-content-end py-3">
                            <div class="btn-group">
                                @can('pengumuman-show')
                                    <a class="btn btn-info" href="{{ route('pengumuman.show', $pengumuman->id) }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                @endcan

                                @can('pengumuman-edit')
                                    <a class="btn btn-primary" href="{{ route('pengumuman.edit', $pengumuman->id) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                @endcan

                                @can('pengumuman-delete')
                                    <form action="{{ route('pengumuman.destroy', $pengumuman->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="card border-0 shadow-lg text-center py-5">
                        <div class="card-body">
                            <div class="empty-state-icon">
                                <i class="fas fa-bullhorn fa-4x text-primary mb-4"></i>
                            </div>
                            <h3 class="card-title">Pengumuman Belum Diatur</h3>
                            <p class="text-muted mb-4">Anda belum membuat pengumuman. Silakan tentukan pengumuman Kelulusan
                                untuk
                                ditampilkan.</p>
                            @can('pengumuman-create')
                                <a href="{{ route('pengumuman.create') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-plus me-2"></i> Atur Jadwal Pengumuman
                                </a>
                            @endcan
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
        }

        .pengumuman-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .pengumuman-content img {
            max-width: 100%;
            border-radius: 10px;
            margin: 20px 0;
        }

        .btn-group .btn {
            border-radius: 8px;
            margin: 0 5px;
        }

        .empty-state-icon {
            opacity: 0.7;
            margin-bottom: 30px;
        }
    </style>
@endsection
