@extends('ortus.layout')
@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-lg-12 text-center">
            <h2 class="fw-bold">Detail Data Orang Tua</h2>
        </div>
        <div class="col-lg-12 d-flex justify-content-end">
            <a class="btn btn-primary btn-lg" href="{{ route('ortus.index') }}">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow p-4 bg-light rounded">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Santri ID:</strong>
                <p>{{ $ortu->santri_id }}</p>
            </div>
            <div class="col-md-6">
                <strong>Nama Ayah:</strong>
                <p>{{ $ortu->nama_ayah }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Pendidikan Ayah:</strong>
                <p>{{ $ortu->pendidikan_ayah }}</p>
            </div>
            <div class="col-md-6">
                <strong>Pekerjaan Ayah:</strong>
                <p>{{ $ortu->pekerjaan_ayah }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Nama Ibu:</strong>
                <p>{{ $ortu->nama_ibu }}</p>
            </div>
            <div class="col-md-6">
                <strong>Pendidikan Ibu:</strong>
                <p>{{ $ortu->pendidikan_ibu }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Pekerjaan Ibu:</strong>
                <p>{{ $ortu->pekerjaan_ibu }}</p>
            </div>
            <div class="col-md-6">
                <strong>No HP:</strong>
                <p>{{ $ortu->no_hp }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <strong>Alamat:</strong>
                <p>{{ $ortu->alamat }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
