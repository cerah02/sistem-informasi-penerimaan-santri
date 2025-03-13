@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2> Data Fasilitas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('fasilitas.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Fasilitas:</strong>
                {{ $guru->nama_fasilitas }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Foto Fasilitas:</strong>
                {{ $guru->foto_fasilitas }}
            </div>
        </div>
    </div>
@endsection
