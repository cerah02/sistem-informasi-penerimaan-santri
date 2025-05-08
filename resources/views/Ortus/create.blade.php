@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <h2 class="fw-bold">Form Data Orang Tua</h2>
            </div>
            <div class="col-lg-12 d-flex justify-content-end mb-3">
                <a class="btn btn-primary btn-lg" href="{{ route('ortus.index') }}">
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

        <form action="{{ route('ortus.store') }}" method="POST" class="shadow p-4 bg-light rounded">
            @csrf
            <div class="col-md-6">
                <label for="santri_id" class="form-label"><strong>ID Santri</strong></label>
                <select name="santri_id" id="santri_id" class="form-control" required>
                    <option value="">-- Pilih Santri --</option>
                    @foreach ($santris as $santri)
                        <option value="{{ $santri->id }}">
                            {{ $santri->id }} - {{ $santri->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_ayah" class="form-label"><strong>Nama Ayah:</strong></label>
                <input type="text" name="nama_ayah" class="form-control" id="nama_ayah" placeholder="Masukan Nama Ayah">
            </div>
            <div class="mb-3">
                <label for="pendidikan_ayah" class="form-label"><strong>Pendidikan Ayah:</strong></label>
                <input type="text" name="pendidikan_ayah" class="form-control" id="pendidikan_ayah"
                    placeholder="Masukan Pendidikan Terakhir Ayah">
            </div>
            <div class="mb-3">
                <label for="pekerjaan_ayah" class="form-label"><strong>Pekerjaan Ayah:</strong></label>
                <input type="text" name="pekerjaan_ayah" class="form-control" id="pekerjaan_ayah"
                    placeholder="Masukan Pekerjaan Ayah">
            </div>
            <div class="mb-3">
                <label for="nama_ibu" class="form-label"><strong>Nama Ibu:</strong></label>
                <input type="text" name="nama_ibu" class="form-control" id="nama_ibu" placeholder="Masukan Nama Ibu">
            </div>
            <div class="mb-3">
                <label for="pendidikan_ibu" class="form-label"><strong>Pendidikan Ibu:</strong></label>
                <input type="text" name="pendidikan_ibu" class="form-control" id="pendidikan_ibu"
                    placeholder="Masukan Pendidikan Terakhir Ibu">
            </div>
            <div class="mb-3">
                <label for="pekerjaan_ibu" class="form-label"><strong>Pekerjaan Ibu:</strong></label>
                <input type="text" name="pekerjaan_ibu" class="form-control" id="pekerjaan_ibu"
                    placeholder="Masukan Pekerjaan Ibu">
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label"><strong>No Hp:</strong></label>
                <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Masukan No Hp">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label"><strong>Alamat:</strong></label>
                <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukan Alamat"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-save"></i> Simpan</button>
            </div>
        </form>
    </div>
@endsection
