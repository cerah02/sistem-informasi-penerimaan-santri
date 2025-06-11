@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Form Data Agenda</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('agendas.index') }}"> Kembali</a>
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
            <h5 class="card-title m-0">Data agenda</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('agendas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Nama Agenda:</strong>
                            <input type="text" name="nama_agenda" class="form-control" placeholder="Nama Agenda">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Jam Pelaksanaan:</strong>
                            <input type="time" name="jam_agenda" class="form-control" placeholder="Jam Agenda">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Tanggal Pelaksanaan:</strong>
                            <input type="date" name="tanggal_agenda" class="form-control" placeholder="Tanggal Agenda">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Tempat Agenda:</strong>
                            <input type="text" name="tempat_agenda" class="form-control" placeholder="Tempat Agenda">
                        </div>
                    </div>
                    {{-- <div class="col-md-12">
                        <div class="form-group">
                            <strong>Status Agenda:</strong>
                            <input type="text" name="status_agenda" class="form-control" placeholder="Status Agenda">
                        </div>
                    </div> --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Foto:</strong>
                            <input type="file" name="foto_agenda" class="form-control" placeholder="Foto">
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
