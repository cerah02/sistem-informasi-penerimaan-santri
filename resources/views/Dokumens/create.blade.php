@extends('layout')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif
    <div class="row mt-4">
        <div class="col-lg-12 text-center mb-4">
            <h2 class="text-primary">Form Upload Dokumen</h2>
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

    <form action="{{ route('dokumens.store') }}" method="POST" enctype="multipart/form-data"
        class="p-4 bg-light shadow-sm rounded">
        @csrf
        <div class="row g-3">
            <!-- ID Santri -->
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

            <!-- Upload Dokumen -->
            <div class="col-md-6">
                <label for="ijazah" class="form-label"><strong>Ijazah</strong></label>
                <input type="file" name="ijazah" id="ijazah" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="akta_kelahiran" class="form-label"><strong>Akta Kelahiran</strong></label>
                <input type="file" name="akta_kelahiran" id="akta_kelahiran" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="nilai_raport" class="form-label"><strong>Nilai Raport</strong></label>
                <input type="file" name="nilai_raport" id="nilai_raport" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="skhun" class="form-label"><strong>SKHUN</strong></label>
                <input type="file" name="skhun" id="skhun" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="foto" class="form-label"><strong>Foto</strong></label>
                <input type="file" name="foto" id="foto" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="kk" class="form-label"><strong>Kartu Keluarga (KK)</strong></label>
                <input type="file" name="kk" id="kk" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="ktp_ayah" class="form-label"><strong>KTP Ayah</strong></label>
                <input type="file" name="ktp_ayah" id="ktp_ayah" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="ktp_ibu" class="form-label"><strong>KTP Ibu</strong></label>
                <input type="file" name="ktp_ibu" id="ktp_ibu" class="form-control" required>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Upload
            </button>
        </div>
    </form>
@endsection
