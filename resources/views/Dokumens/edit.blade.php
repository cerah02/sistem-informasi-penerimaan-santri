@extends('dokumens.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Data dokumen</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dokumens.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Maaf!</strong> Data yang anda Masukan Salah.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('dokumens.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="santri_id">ID Santri:</label>
            <input type="number" name="santri_id" id="santri_id" value="{{ $dokumen->santri_id }}" required>
        </div>

        <div>
            <label for="ijazah">Ijazah (Kosongkan jika tidak ingin mengubah):</label>
            <input type="file" name="ijazah" id="ijazah">
        </div>

        <div>
            <label for="nilai_raport">Nilai Raport (Kosongkan jika tidak ingin mengubah):</label>
            <input type="file" name="nilai_raport" id="nilai_raport">
        </div>

        <div>
            <label for="skhun">SKHUN (Kosongkan jika tidak ingin mengubah):</label>
            <input type="file" name="skhun" id="skhun">
        </div>

        <div>
            <label for="foto">Foto (Kosongkan jika tidak ingin mengubah):</label>
            <input type="file" name="foto" id="foto">
        </div>

        <div>
            <label for="kk">Kartu Keluarga (KK) (Kosongkan jika tidak ingin mengubah):</label>
            <input type="file" name="kk" id="kk">
        </div>

        <div>
            <label for="ktp_ayah">KTP Ayah (Kosongkan jika tidak ingin mengubah):</label>
            <input type="file" name="ktp_ayah" id="ktp_ayah">
        </div>

        <div>
            <label for="ktp_ibu">KTP Ibu (Kosongkan jika tidak ingin mengubah):</label>
            <input type="file" name="ktp_ibu" id="ktp_ibu">
        </div>

        <button type="submit">Simpan Perubahan</button>
    </form>
@endsection
