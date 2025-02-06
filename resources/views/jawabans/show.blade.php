@extends('jawabans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2> Data Jawaban</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('jawabans.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Santri Id :</strong>
                {{ $jawaban->santri_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Soal Id :</strong>
                {{ $jawaban->soal_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jawaban :</strong>
                {{ $jawaban->jawaban }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status Jawaban :</strong>
                {{ $jawaban->status_jawaban }}
            </div>
        </div>
    </div>
@endsection
