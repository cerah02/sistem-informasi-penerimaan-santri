@extends('kesehatans.layout')
@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-lg-12 text-center">
            <h2 class="fw-bold">Detail Data Orang Tua</h2>
        </div>
        <div class="col-lg-12 d-flex justify-content-end">
            <a class="btn btn-primary btn-lg" href="{{ route('kesehatans.index') }}">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow p-4 bg-light rounded">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Santri ID:</strong>
                <p>{{ $kesehatan->santri_id }}</p>
            </div>
            <div class="col-md-6">
                <strong>Golongan Darah:</strong>
                <p>{{ $kesehatan->golongan_darah }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Tinggi Badan:</strong>
                <p>{{ $kesehatan->tb }}</p>
            </div>
            <div class="col-md-6">
                <strong>Berat Badan:</strong>
                <p>{{ $kesehatan->bb }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Riwayat Penyakit:</strong>
                <p>{{ $kesehatan->riwayat_penyakit }}</p>
            </div>
    </div>
</div>
@endsection
