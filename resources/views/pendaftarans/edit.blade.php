@extends('pendaftarans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Data Pendaftaran</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('pendaftarans.index') }}"> Back</a>
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
    <form action="{{ route('pendaftarans.update', $pendaftaran->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Santri Id :</strong>
                    <input type="text" name="santri_id" value="{{ $pendaftaran->santri_id }}" class="form-control"
                        placeholder="Santri Id">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Pendaftaran :</strong>
                    <input type="text" name="tanggal_pendaftaran" value="{{ $pendaftaran->tanggal_pendaftaran }}" class="form-control"
                        placeholder="Tanggal Pendaftaran">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status :</strong>
                    <input type="text" name="status" value="{{ $pendaftaran->status }}" class="form-control"
                        placeholder="Status">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection
