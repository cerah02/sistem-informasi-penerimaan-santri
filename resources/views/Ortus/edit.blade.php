@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-lg-12 text-center">
            <h2 class="fw-bold">Edit Data Orang Tua</h2>
        </div>
        <div class="col-lg-12 d-flex justify-content-end">
            <a class="btn btn-secondary btn-lg" href="{{ route('ortus.index') }}">
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
        <form action="{{ route('ortus.update', $ortu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="santri_id" class="form-label"><strong>Santri ID:</strong></label>
                        <input type="text" name="santri_id" value="{{ $ortu->santri_id }}" class="form-control"
                            placeholder="Masukkan ID Santri" id="santri_id">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_ayah" class="form-label"><strong>Nama Ayah:</strong></label>
                        <input type="text" name="nama_ayah" value="{{ $ortu->nama_ayah }}" class="form-control"
                            placeholder="Masukkan Nama Ayah" id="nama_ayah">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pendidikan_ayah" class="form-label"><strong>Pendidikan Ayah:</strong></label>
                        <input type="text" name="pendidikan_ayah" value="{{ $ortu->pendidikan_ayah }}" class="form-control"
                            placeholder="Masukkan Pendidikan Terakhir Ayah" id="pendidikan_ayah">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pekerjaan_ayah" class="form-label"><strong>Pekerjaan Ayah:</strong></label>
                        <input type="text" name="pekerjaan_ayah" value="{{ $ortu->pekerjaan_ayah }}" class="form-control"
                            placeholder="Masukkan Pekerjaan Ayah" id="pekerjaan_ayah">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_ibu" class="form-label"><strong>Nama Ibu:</strong></label>
                        <input type="text" name="nama_ibu" value="{{ $ortu->nama_ibu }}" class="form-control"
                            placeholder="Masukkan Nama Ibu" id="nama_ibu">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pendidikan_ibu" class="form-label"><strong>Pendidikan Ibu:</strong></label>
                        <input type="text" name="pendidikan_ibu" value="{{ $ortu->pendidikan_ibu }}" class="form-control"
                            placeholder="Masukkan Pendidikan Terakhir Ibu" id="pendidikan_ibu">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pekerjaan_ibu" class="form-label"><strong>Pekerjaan Ibu:</strong></label>
                        <input type="text" name="pekerjaan_ibu" value="{{ $ortu->pekerjaan_ibu }}" class="form-control"
                            placeholder="Masukkan Pekerjaan Ibu" id="pekerjaan_ibu">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_hp" class="form-label"><strong>No HP:</strong></label>
                        <input type="text" name="no_hp" value="{{ $ortu->no_hp }}" class="form-control"
                            placeholder="Masukkan Nomor HP" id="no_hp">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="alamat" class="form-label"><strong>Alamat:</strong></label>
                        <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat" id="alamat" rows="3">{{ $ortu->alamat }}</textarea>
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
