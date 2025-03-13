@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Data Fasilitas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('fasilitas.index') }}"> Kembali</a>
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

    <form action="{{ route('fasilitas.update',$fasilitas->id) }}" method="POST">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Nama Fasilitas:</strong>
                    <input type="text" name="nama_fasilitas" value="{{$fasilitas->nama_fasilitas}}" class="form-control" placeholder="Nama Fasilitas">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Foto fasilitas:</strong>
                    <input type="file" name="foto_fasilitas" value="{{$fasilitas->foto_fasilitas}}" class="form-control" placeholder="Foto Fasilitas">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection