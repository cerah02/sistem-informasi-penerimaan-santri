@extends('jawabans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Form Data Jawaban</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('jawabans.index') }}"> Kembali</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Maaf!</strong> Data yang anda masukkan salah.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jawabans.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Soal Id:</strong>
                    <input type="text" name="soal_id" class="form-control" placeholder="Soal">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Jawaban:</strong>
                    <input type="text" name="jawaban" class="form-control" placeholder="Jawaban">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Is Benar:</strong>
                    <input type="text" name="is_benar" class="form-control" placeholder="Is Benar">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection