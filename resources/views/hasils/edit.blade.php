@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Hasil Ujian Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('hasils.index') }}"> Kembali</a>
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
    <form action="{{ route('hasils.update', $hasil->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Nama Santri (read-only) -->
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Nama Santri:</strong>
                    <input type="text" class="form-control" value="{{ $hasil->santri->nama ?? 'N/A' }}" readonly>
                    <input type="hidden" name="santri_id" value="{{ $hasil->santri_id }}">
                </div>
            </div>

            <!-- Nama Ujian (read-only) -->
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Nama Ujian:</strong>
                    <input type="text" class="form-control" value="{{ $hasil->ujian->nama_ujian ?? 'N/A' }}" readonly>
                    <input type="hidden" name="ujian_id" value="{{ $hasil->ujian_id }}">
                </div>
            </div>

            <!-- Jumlah Soal (read-only) -->
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Jumlah Soal:</strong>
                    <input type="text" class="form-control" name="jumlah_soal" value="{{ $hasil->jumlah_soal }}"
                        readonly>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Jawaban Benar :</strong>
                    <input type="text" name="jawaban_benar" value="{{ $hasil->jawaban_benar }}" class="form-control"
                        placeholder="Jawaban Benar">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Jawaban Salah :</strong>
                    <input type="text" name="jawaban_salah" value="{{ $hasil->jawaban_salah }}" class="form-control"
                        placeholder="Jawaban Salah">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nilai ujian:</strong>
                    <input type="text" name="total_nilai_kategori" value="{{ $hasil->total_nilai_kategori }}" class="form-control"
                        placeholder="Nilai Ujian">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Keterangan :</strong>
                    <input type="text" name="keterangan" value="{{ $hasil->keterangan }}" class="form-control"
                        placeholder="Keteranagan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection
