@extends('kesehatans.layout')
@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-lg-12 text-center">
            <h2 class="fw-bold">Edit Data Kesehatan Santri</h2>
        </div>
        <div class="col-lg-12 d-flex justify-content-end">
            <a class="btn btn-secondary btn-lg" href="{{ route('kesehatans.index') }}">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Maaf!</strong> Data yang Anda masukkan salah.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow p-4 bg-light rounded">
        <form action="{{ route('kesehatans.update', $kesehatan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="santri_id" class="form-label"><strong>Santri ID:</strong></label>
                        <input type="text" name="santri_id" value="{{ $kesehatan->santri_id }}" class="form-control"
                            placeholder="Masukkan ID Santri" id="santri_id">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="golongan_darah" class="form-label"><strong>Golongan Darah:</strong></label>
                        <input type="text" name="golongan_darah" value="{{ $kesehatan->golongan_darah }}" class="form-control"
                            placeholder="Masukkan Golongan Darah" id="golongan_darah">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tb" class="form-label"><strong>Tinggi Badan:</strong></label>
                        <input type="text" name="tb" value="{{ $kesehatan->tb }}" class="form-control"
                            placeholder="Masukkan Tinggi Badan (cm)" id="tinggi_badan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bb" class="form-label"><strong>Berat Badan:</strong></label>
                        <input type="bb" name="pekerjaan_ayah" value="{{ $kesehatan->bb }}" class="form-control"
                            placeholder="Masukkan Berat Badan" id="berat_badan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="riwayat_penyakit" class="form-label"><strong>Riwayat Penyakit:</strong></label>
                        <input type="text" name="riwayat_penyakit" value="{{ $kesehatan->riwayat_penyakit }}" class="form-control"
                            placeholder="Masukkan Riwayat Penyakit" id="riwayat_penyakit">
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-lg mt-3">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
