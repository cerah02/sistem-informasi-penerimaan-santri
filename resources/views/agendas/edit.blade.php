@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Data Agenda</h2>
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

    <form action="{{ route('agendas.update',$agenda->id) }}" method="POST">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Nama Agenda:</strong>
                    <input type="text" name="nama_agenda" value="{{$agenda->nama_agenda}}" class="form-control" placeholder="Nama Agenda">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Jam Agenda:</strong>
                    <input type="time" name="jam_agenda" value="{{$agenda->jam_agenda}}" class="form-control" placeholder="jam Agenda">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Tanggal Agenda:</strong>
                    <input type="date" name="tanggal_agenda" value="{{$agenda->tanggal_agenda}}" class="form-control" placeholder="Tanggal Agenda">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Tempat Agenda:</strong>
                    <input type="text" name="tempat_agenda" value="{{$agenda->tempat_agenda}}" class="form-control" placeholder="Tempat Agenda">
                </div>
            </div>
            {{-- <div class="col-md-12">
                <div class="form-group">
                    <strong>Status Agenda:</strong>
                    <input type="text" name="status_agenda" value="{{$agenda->status_agenda}}" class="form-control" placeholder="Status Agenda">
                </div>
            </div> --}}
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Foto agenda:</strong>
                    <input type="file" name="foto_agenda" value="{{$agenda->foto_agenda}}" class="form-control" placeholder="Foto Agenda">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection