@extends('ujians.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Data Ujian</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('ujians.index') }}"> Back</a>
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
    <form action="{{ route('ujians.update', $ujian->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Ujian:</strong>
                    <input type="text" name="nama_ujian" value="{{ $ujian->nama_ujian }}" class="form-control"
                        placeholder="Masukkan Nama Ujian">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jenjang Pendidikan :</strong><br>
                    <label>
                        <input type="radio" name="jenjang_pendidikan" value="SD" 
                        {{ $ujian->jenjang_pendidikan == 'SD' ? 'checked' : '' }}> SD
                    </label><br>
                    <label>
                        <input type="radio" name="jenjang_pendidikan" value="MTS" 
                        {{ $ujian->jenjang_pendidikan == 'MTS' ? 'checked' : '' }}> MTS
                    </label><br>
                    <label>
                        <input type="radio" name="jenjang_pendidikan" value="MA" 
                        {{ $ujian->jenjang_pendidikan == 'MA' ? 'checked' : '' }}> MA
                    </label>
                </div>
            </div>            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kategori :</strong>
                    <input type="text" name="kategori" value="{{ $ujian->kategori }}" class="form-control"
                        placeholder="Masukkan Kategori">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Mulai:</strong>
                    <input type="date" name="tanggal_mulai" value="{{ $ujian->tanggal_mulai }}" class="form-control"
                        placeholder="Masukkan Tanggal Mulai">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Selesai:</strong>
                    <input type="date" name="tanggal_selesai" value="{{ $ujian->tanggal_selesai }}" class="form-control"
                        placeholder="Masukkan Tanggal Selesai">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Durasi:</strong>
                    <input type="time" name="durasi" value="{{ $ujian->durasi }}" class="form-control"
                        placeholder="Masukkan Durasi Ujian">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong><br>
                    <label>
                        <input type="radio" name="status" value="Belum Mulai" 
                        {{ $ujian->status == 'Belum Mulai' ? 'checked' : '' }}> Belum Mulai
                    </label><br>
                    <label>
                        <input type="radio" name="status" value="Sedang Berlangsung" 
                        {{ $ujian->status == 'Sedang Berlangsung' ? 'checked' : '' }}> Sedang Berlangsung
                    </label><br>
                    <label>
                        <input type="radio" name="status" value="Selesai" 
                        {{ $ujian->status == 'Selesai' ? 'checked' : '' }}> Selesai
                    </label>
                </div>
            </div>            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection
