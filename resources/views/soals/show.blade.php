@extends('soals.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2> Data Soal</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('soals.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ujian Id :</strong>
                {{ $soal->ujian_id}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Pertanyaan:</strong>
                {{ $soal->pertanyaan }}
            </div>
        </div>
    </div>
@endsection
