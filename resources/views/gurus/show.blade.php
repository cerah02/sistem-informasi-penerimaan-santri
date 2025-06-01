@extends('layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="text-white text-capitalize ps-3">Detail Data Guru</h3>
                                </div>
                                <div class="col-4 text-end">
                                    <a class="btn btn-sm btn-light mb-0 me-3" href="{{ route('gurus.index') }}">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="row px-3">
                            <!-- Profile Column -->
                            <div class="col-md-4 text-center">
                                <div class="position-relative">
                                    @if ($guru->foto)
                                        <img src="{{ asset('storage/' . $guru->foto) }}"
                                            class="img-fluid rounded-circle shadow-lg"
                                            style="width: 200px; height: 200px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                                            style="width: 200px; height: 200px; margin: 0 auto;">
                                            <i class="fas fa-user text-white" style="font-size: 5rem;"></i>
                                        </div>
                                    @endif
                                    <h4 class="mt-3 mb-0">{{ $guru->nama }}</h4>
                                    <p class="text-muted">{{ $guru->status_guru }}</p>
                                </div>

                                <div class="d-flex justify-content-center gap-2 mt-3">
                                    <a href="{{ route('gurus.edit', $guru->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('gurus.destroy', $guru->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Details Column -->
                            <div class="col-md-8">
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <h5 class="font-weight-bolder">Informasi Pribadi</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column py-2">
                                                    <span class="text-sm text-muted">Jenis Kelamin</span>
                                                    <span class="font-weight-bold">{{ $guru->jenis_kelamin }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column py-2">
                                                    <span class="text-sm text-muted">NIP</span>
                                                    <span class="font-weight-bold">{{ $guru->nip ?? '-' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column py-2">
                                            <span class="text-sm text-muted">Alamat</span>
                                            <span class="font-weight-bold">{{ $guru->alamat }}</span>
                                        </div>

                                        <h5 class="font-weight-bolder mt-4">Kontak Informasi</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column py-2">
                                                    <span class="text-sm text-muted">Email</span>
                                                    <span class="font-weight-bold">{{ $guru->email }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column py-2">
                                                    <span class="text-sm text-muted">No. Telepon</span>
                                                    <span class="font-weight-bold">{{ $guru->no_telpon ?? '-' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="font-weight-bolder mt-4">Informasi Profesional</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column py-2">
                                                    <span class="text-sm text-muted">Status Guru</span>
                                                    <span
                                                        class="badge 
                                                        @if ($guru->status_guru == 'Aktif') badge-success 
                                                        @elseif($guru->status_guru == 'Non-Aktif') badge-danger 
                                                        @else badge-warning @endif">
                                                        {{ $guru->status_guru }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column py-2">
                                                    <span class="text-sm text-muted">TTL</span>
                                                    <span class="font-weight-bold">
                                                        @php
                                                            $ttl = explode('|', $guru->ttl, 2);
                                                            $tempat_lahir = $ttl[0] ?? '';
                                                            $tanggal_lahir = $ttl[1] ?? '';
                                                            echo $tempat_lahir .
                                                                ', ' .
                                                                ($tanggal_lahir
                                                                    ? \Carbon\Carbon::parse($tanggal_lahir)->format(
                                                                        'd F Y',
                                                                    )
                                                                    : '-');
                                                        @endphp
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-body {
            padding: 1.5rem;
        }

        .flex-column {
            padding: 0.5rem 0;
        }

        .text-muted {
            font-size: 0.875rem;
        }

        .font-weight-bold {
            font-weight: 600;
        }
    </style>
@endsection
