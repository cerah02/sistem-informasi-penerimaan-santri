@extends('pendaftarans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Form Data Pendaftaran</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('pendaftarans.index') }}"> Kembali</a>
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

    <form action="{{ route('pendaftarans.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Santri ID:</strong>
                    <input type="text" name="santri_id" class="form-control" placeholder="Santri Id">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Tanggal Pendaftaran:</strong>
                    <input type="text" name="tanggal_pendaftaran" class="form-control" placeholder="Tanggal Pendaftaran">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <input type="text" name="status" class="form-control" placeholder="Status">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection