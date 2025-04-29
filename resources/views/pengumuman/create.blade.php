@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 text-center mb-4">
            <h2 class="fw-bold">Form Data Pengumuman</h2>
        </div>
        <div class="col-lg-12 d-flex justify-content-end mb-3">
            <a class="btn btn-primary btn-lg" href="{{ route('pengumuman.index') }}">
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

    <form action="{{ route('pengumuman.store') }}" method="POST" class="shadow p-4 bg-light rounded">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label"><strong>Judul:</strong></label>
            <input type="text" name="judul" class="form-control" id="judul" placeholder="Masukan Judul Pengumuman">
        </div>
        <div class="mb-3">
            <label for="konten" class="form-label"><strong>Konten:</strong></label>
            <textarea name="konten" id="konten" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="tanggal_liris" class="form-label"><strong>Tanggal Liris:</strong></label>
            <input type="date" name="tanggal_rilis" class="form-control" id="tanggal_liris" placeholder="Masukan Waktu Ditampilkan">
        </div>
        <div class="mb-3">
            <label for="is_active">Aktif</label>
            <select name="is_active" id="is_active" class="form-control" required>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-save"></i> Simpan</button>
        </div>
    </form>
</div>
@endsection
