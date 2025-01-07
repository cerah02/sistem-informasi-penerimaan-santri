@extends('ujians.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Data Ujian</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('ujians.index') }}"> Back</a>
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
    <form action="{{ route('ujians.update', $ujian->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Mata Pelajaran:</strong>
                    <input type="text" name="mata_pelajaran" value="{{ $ujian->mata_pelajaran }}" class="form-control"
                        placeholder="Mata Pelajaran">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Ujian :</strong>
                    <input type="text" name="tanggal_ujian" value="{{ $ujian->tanggal_ujian }}" class="form-control"
                        placeholder="Tanggal Ujian">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deskripsi :</strong>
                    <input type="text" name="deskripsi" value="{{ $ujian->deskripsi }}" class="form-control"
                        placeholder="Deskripsi">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection
