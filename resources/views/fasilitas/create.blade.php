@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Form Data Fasilitas</h2>
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

    <div class="card shadow mt-4">
        <div class="card-header">
            <h5 class="card-title m-0">Data Fasilitas</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Nama Fasilitas:</strong>
                            <input type="text" name="nama_fasilitas" class="form-control" placeholder="Nama Fasilitas">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Foto Fasilitas:</strong>
                            <input type="file" name="foto_fasilitas" class="form-control" placeholder="Foto Fasilitas">
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
