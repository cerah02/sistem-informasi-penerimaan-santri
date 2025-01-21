@extends('kesehatans.layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 text-center mb-4">
            <h2 class="fw-bold">Form Data Kesehatan</h2>
        </div>
        <div class="col-lg-12 d-flex justify-content-end mb-3">
            <a class="btn btn-primary btn-lg" href="{{ route('kesehatans.index') }}">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Whoops!</strong> Data yang Anda inputkan salah.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('kesehatans.store') }}" method="POST" class="shadow p-4 bg-light rounded">
        @csrf
        <div class="mb-3">
            <label for="santri_id" class="form-label"><strong>Id Santri:</strong></label>
            <input type="text" name="santri_id" class="form-control" id="santri_id" placeholder="Masukan Id Santri">
        </div>
        <div class="mb-3">
            <label class="form-label"><strong>Golongan Darah:</strong></label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_a" value="A">
                    <label class="form-check-label" for="golongan_darah_a">A</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_b" value="B">
                    <label class="form-check-label" for="golongan_darah_b">B</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_ab" value="AB">
                    <label class="form-check-label" for="golongan_darah_ab">AB</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_o" value="O">
                    <label class="form-check-label" for="golongan_darah_o">O</label>
                </div>
            </div>
        </div>        
        <div class="mb-3">
            <label for="tb" class="form-label"><strong>Tinggi Badan:</strong></label>
            <input type="text" name="tb" class="form-control" id="tb" placeholder="Masukan Tinggi Badan (cm)">
        </div>
        <div class="mb-3">
            <label for="bb" class="form-label"><strong>Berat Badan:</strong></label>
            <input type="text" name="bb" class="form-control" id="pekerjaan_ayah" placeholder="Masukan Berat Badan (Kg)">
        </div>
        <div class="mb-3">
            <label for="riwayat_penyakit" class="form-label"><strong>Riwayat Penyakit:</strong></label>
            <input type="text" name="riwayat_penyakit" class="form-control" id="riwayat_penyakit" placeholder="Masukan Riwayat Penyakit">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-save"></i> Simpan</button>
        </div>
    </form>
</div>
@endsection
