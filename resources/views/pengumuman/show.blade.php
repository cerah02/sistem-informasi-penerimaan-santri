@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-lg-12 text-center">
                <h2 class="fw-bold">Detail Data Orang Tua</h2>
            </div>
            <div class="col-lg-12 d-flex justify-content-end">
                <a class="btn btn-primary btn-lg" href="{{ route('pengumuman.index') }}">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card shadow p-4 bg-light rounded">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Judul:</strong>
                    <p>{{ $pengumuman->judul }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Konten :</strong>
                    <p>{{ $pengumuman->konten }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Tanggal Rilis:</strong>
                    <p>{{ $pengumuman->tanggal_rilis }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Status:</strong>
                    <p>{{ $pengumuman->is_active }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
