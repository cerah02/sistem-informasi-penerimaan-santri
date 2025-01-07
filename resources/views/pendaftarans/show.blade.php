@extends('pendaftarans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2> Data Pendaftaran Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('pendaftarans.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Santri Id :</strong>
                {{ $pendaftaran->santri_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Pendaftaran :</strong>
                {{ $pendaftaran->tanggal_pendaftaran }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status :</strong>
                {{ $pendaftaran->status }}
            </div>
        </div>
    </div>
@endsection
