@extends('layout')
@section('content')
    <div class="container mt-4">
        {{-- Tombol Tambah Data --}}
        <div class="row mb-4">
            <div class="col-12 text-end">
                <a href="{{ route('ujians_create', $jenjang) }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Data Ujian
                </a>
            </div>
        </div>

        @php
            // Group ujian berdasarkan jenjang pendidikan
            $groupedUjians = $ujians->groupBy('jenjang_pendidikan');
        @endphp

        @foreach ($groupedUjians as $jenjang => $ujiansInJenjang)
            {{-- Judul Jenjang --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="text-center text-primary mb-4">
                        📚 Daftar Jadwal Ujian Untuk Jenjang {{ $jenjang }}
                    </h2>
                </div>
            </div>

            {{-- Card Ujian --}}
            <div class="row">
                @foreach ($ujiansInJenjang as $ujian)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0">
                            <div
                                class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">{{ $ujian->nama_ujian }}</h5>
                                <div>
                                    <a href="{{ route('ujians.edit', $ujian->id) }}" class="text-white me-2">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="{{ route('ujian.delete', $ujian->id) }}" class="text-white"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus ujian ini?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><strong>Kategori:</strong> {{ $ujian->kategori }}</p>
                                <p class="card-text"><strong>Tanggal Mulai:</strong>
                                    {{ date('d M Y', strtotime($ujian->tanggal_mulai)) }}
                                </p>

                                <p class="card-text"><strong>Tanggal Selesai:</strong>
                                    {{ date('d M Y', strtotime($ujian->tanggal_selesai)) }}
                                </p>
                                <p class="card-text"><strong>Durasi:</strong> {{ $ujian->durasi / 60 }} menit</p>
                                <p class="card-text">
                                    <strong>Status:</strong>
                                    <span
                                        class="badge 
                                        @if ($ujian->status == 'Aktif') bg-success 
                                        @elseif($ujian->status == 'Tidak Aktif') bg-danger 
                                        @else bg-warning @endif">
                                        {{ $ujian->status }}
                                    </span>
                                </p>
                                <a href="{{ route('form_buat_soal', $ujian->id) }}" class="btn btn-outline-primary">
                                    Lihat Soal
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

<style>
    .card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        font-size: 1.2rem;
        letter-spacing: 0.5px;
    }

    h2.text-primary {
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        padding-bottom: 10px;
    }

    h2.text-primary::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: #007bff;
        margin: 10px auto 0;
    }

    /* Style untuk tombol Tambah Data Ujian */
    .btn-primary {
        padding: 10px 25px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }

    /* Style untuk ikon di card header */
    .card-header a {
        text-decoration: none;
        font-size: 1.2rem;
    }

    .card-header a:hover {
        opacity: 0.8;
    }
</style>
