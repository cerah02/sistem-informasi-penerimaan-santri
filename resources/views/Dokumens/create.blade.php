@extends('dokumens.layout')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12 text-center mb-4">
            <h2 class="text-primary">Form Dokumen</h2>
        </div>
        <div class="col-lg-12 mb-2 text-end">
            <a class="btn btn-secondary btn-sm" href="{{ route('dokumens.index') }}">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> Mohon periksa kembali data yang Anda masukkan.
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('dokumens.store') }}" method="POST" class="p-4 bg-light shadow-sm rounded">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="santri_id" class="form-label"><strong>Id Santri</strong></label>
                <input type="text" name="santri_id" class="form-control" id="santri_id" placeholder="Masukkan id santri" required>
            </div>
            <div>
                <label for="ijazah">Upload Ijazah:</label>
                <input type="file" name="ijazah" id="ijazah" required>
            </div>
            <div>
                <label for="nilai_raport">Upload Nilai Raport:</label>
                <input type="file" name="nilai_raport" id="nilai_raport" required>
            </div>
            <div>
                <label for="skhun">Upload SKHUN:</label>
                <input type="file" name="skhun" id="skhun" required>
            </div>
            <div>
                <label for="foto">Upload Foto:</label>
                <input type="file" name="foto" id="foto" required>
            </div>
            <div>
                <label for="kk">Upload Kartu Keluarga (KK):</label>
                <input type="file" name="kk" id="kk" required>
            </div>
            <div>
                <label for="ktp_ayah">Upload KTP Ayah:</label>
                <input type="file" name="ktp_ayah" id="ktp_ayah" required>
            </div>
            <div>
                <label for="ktp_ibu">Upload KTP Ibu:</label>
                <input type="file" name="ktp_ibu" id="ktp_ibu" required>
            </div>
            <button type="submit">Upload</button>
        </div>
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Upload 
            </button>
        </div>
    </form>
@endsection
