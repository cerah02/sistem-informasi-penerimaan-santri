@extends('bantuans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2> Riwayat Bantuan Calon Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('bantuans.index') }}"> Kembali</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Id Santri:</strong>
                {{ $bantuan->santri_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Bantuan:</strong>
                {{ $bantuan->nama_bantuan }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tingkat:</strong>
                {{ $bantuan->tingkat }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NO KIP:</strong>
                {{ $bantuan->no_kip }}
            </div>
        </div>
    </div>
@endsection
