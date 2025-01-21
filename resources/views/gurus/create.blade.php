@extends('gurus.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Form Data Guru</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('gurus.index') }}"> Kembali</a>
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

    <form action="{{ route('gurus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Nama:</strong>
                    <input type="text" name="nama" class="form-control" placeholder="Nama">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Jenis Kelamin:</strong>
                    <input type="text" name="jenis_kelamin" class="form-control" placeholder="Jenis Kelamin">
                </div>
            </div>
            <div class="mb-3">
                <label for="ttl" class="form-label">Tempat Lahir</label>
                <input type="text" id="ttl" name="tempat_lahir" class="form-control" required>
                @error('tanggal_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
                @error('tanggal_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Alamat:</strong>
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>NIP:</strong>
                    <input type="text" name="nip" class="form-control" placeholder="NIP">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Nomor Telpon:</strong>
                    <input type="text" name="no_telpon" class="form-control" placeholder="Nomor Telpon">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Status Guru:</strong>
                    <input type="text" name="status_guru" class="form-control" placeholder="Status Guru">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Foto:</strong>
                    <input type="file" name="foto" class="form-control" placeholder="Foto">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection