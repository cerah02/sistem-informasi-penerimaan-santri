@extends('jawabans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Jawaban</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('jawabans.index') }}"> Back</a>
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
    <form action="{{ route('jawabans.update', $jawaban->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Santri:</strong>
                    <input type="text" name="santri_id" value="{{ $jawaban->santri_id }}" class="form-control"
                        placeholder="Santri Id">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Soal :</strong>
                    <input type="text" name="soal_id" value="{{ $jawaban->soal_id }}" class="form-control"
                        placeholder="Soal Id">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jawaban :</strong>
                    <input type="text" name="jawaban" value="{{ $jawaban->jawaban }}" class="form-control"
                        placeholder="Jawaban">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status Jawaban:</strong><br>
                    <label>
                        <input type="radio" name="status_jawaban" value="Benar" 
                        {{ $jawaban->status_jawaban == 'Benar' ? 'checked' : '' }}> Benar
                    </label><br>
                    <label>
                        <input type="radio" name="status_jawaban" value="Salah" 
                        {{ $jawaban->status_jawaban == 'Salah' ? 'checked' : '' }}> Salah
                    </label>
                </div>
            </div>            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection
