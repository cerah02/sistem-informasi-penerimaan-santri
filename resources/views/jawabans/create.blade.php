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
                    <strong>ID Santri:</strong>
                    <input type="text" name="santri_id" class="form-control" placeholder="Masukkan ID Santri">
                </div>
            </div>
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
                    <strong>Status Jawaban:</strong><br>
                    <label>
                        <input type="radio" name="status_jawaban" value="Benar" required> Benar
                    </label><br>
                    <label>
                        <input type="radio" name="status_jawaban" value="Salah" required> Salah
                    </label>
                </div>
            </div>            
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection