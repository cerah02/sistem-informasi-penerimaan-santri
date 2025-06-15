@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Riwayat Bantuan Calon Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('bantuans.index') }}"> Kembali</a>
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
    <form action="{{ route('bantuans.update', $bantuan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Id Santri :</strong>
                    <input type="text" name="santri_id" value="{{ $bantuan->santri_id }}" class="form-control"
                        placeholder="Masukan Id Santri">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Bantuan :</strong>
                    <input type="text" name="nama_bantuan" value="{{ $bantuan->nama_bantuan }}" class="form-control"
                        placeholder="Masukan Nama Bantuan yang Pernah Diterima">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tingkat :</strong>
                    <input type="text" name="tingkat" value="{{ $bantuan->tingkat}}" class="form-control"
                        placeholder="Masukan Tingkat Bantuan Yang Pernah Diterima">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>No KIP :</strong>
                    <input type="text" name="no_kip" value="{{ $bantuan->no_kip}}" class="form-control" maxlength="6"
                        placeholder="Masukan No KIP Jika Ada">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection
