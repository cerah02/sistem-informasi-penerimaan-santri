@extends('kelas.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Form Data Kelas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('kelas.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Data Yang Anda Inputkan Salah.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kelas.store') }}" method="POST">
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
                    <strong>Deskripsi:</strong>
                    <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="id_guru">Pilih Guru:</label>
                    <select name="id_guru" id="id_guru" class="form-control">
                        <option value="">-- Pilih Guru --</option>
                        @foreach ($gurus as $key => $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection
