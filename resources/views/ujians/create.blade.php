@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Form Data Ujian</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('ujians.index') }}"> Kembali</a>
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

    <!-- Card untuk form -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Tambah Data Ujian</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('ujians.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Nama Ujian:</strong>
                            <input type="text" name="nama_ujian" class="form-control" placeholder="Masukkan Nama Ujian">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Jenjang Pendidikan:</strong><br>
                            <label>
                                <input type="text" name="jenjang_pendidikan" value="{{$jenjang}}" required readonly>
                            </label><br>
                           
                        </div>
                    </div>            
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Kategori:</strong>
                            <input type="text" name="kategori" class="form-control" placeholder="Masukkan Kategori Ujian">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Tanggal Mulai:</strong>
                            <input type="date" name="tanggal_mulai" class="form-control" placeholder="Masukkan Tanggal Mulai Ujian">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Tanggal Selesai:</strong>
                            <input type="date" name="tanggal_selesai" class="form-control" placeholder="Masukkan Tanggal Selesai Ujian">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Durasi:</strong>
                            <input type="time" name="durasi" class="form-control" placeholder="Masukkan Durasi Ujian">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Status Ujian:</strong><br>
                            <label>
                                <input type="radio" name="status" value="Belum Mulai" required> Belum Mulai
                            </label><br>
                            <label>
                                <input type="radio" name="status" value="Sedang Berlangsung" required> Sedang Berlangsung
                            </label><br>
                            <label>
                                <input type="radio" name="status" value="Selesai" required> Selesai
                            </label>
                        </div>
                    </div>            
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End of Card -->
@endsection