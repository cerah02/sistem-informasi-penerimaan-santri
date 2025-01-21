@extends('bantuans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Form Riwayat Bantuan Calon Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('bantuans.index') }}"> Kembali</a>
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

    <form action="{{ route('bantuans.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Id Santri:</strong>
                    <label for="nama_snatri"></label>
                    <input type="text" name="nama_snatri" id="nama_snatri" class="form-control" placeholder="Masukan Id Santri">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Nama Bantuan:</strong>
                    <input type="text" name="nama_bantuan" class="form-control" placeholder="Masukan Nama Bantuan Yang Pernah Diterima">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Tingkat :</strong>
                    <input type="text" name="tingkat" class="form-control" placeholder="Masukan Tingkat Bantuan Yang pernah Diterima">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>No KIP :</strong>
                    <input type="text" name="no_kip" class="form-control" placeholder="Masukan Nomor KIP">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection