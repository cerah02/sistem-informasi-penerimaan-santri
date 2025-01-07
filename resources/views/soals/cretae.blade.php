@extends('soals.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Form Data Soal</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('soals.index') }}"> Kembali</a>
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

    <form action="{{ route('soals.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Ujian Id:</strong>
                    <input type="text" name="ujian_id" class="form-control" placeholder="Ujian Id">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Pertanyaan:</strong>
                    <input type="text" name="pertanyaan" class="form-control" placeholder="Pertanyaan">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection