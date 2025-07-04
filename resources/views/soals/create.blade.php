@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Form Data Soal</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('form_buat_soal', $id) }}"> Kembali</a>
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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('soals.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            @foreach ($ujians as $key => $ujian)
                                <h2><input type="hidden" name="ujian_id" id="ujian_id"
                                        value="{{ $ujian->id }}">{{ $ujian->nama_ujian }}</h2>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Pertanyaan:</strong>
                            <input type="text" name="pertanyaan" class="form-control" placeholder="Pertanyaan">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Jawaban A:</strong>
                            <input type="text" name="jawaban_a" class="form-control" placeholder="Masukkan Jawaban A">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Jawaban B:</strong>
                            <input type="text" name="jawaban_b" class="form-control" placeholder="Masukkan Jawaban B">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Jawaban C:</strong>
                            <input type="text" name="jawaban_c" class="form-control" placeholder="Masukkan Jawaban C">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Jawaban D:</strong>
                            <input type="text" name="jawaban_d" class="form-control" placeholder="Masukkan Jawaban D">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Jawaban E:</strong>
                            <input type="text" name="jawaban_e" class="form-control" placeholder="Masukkan Jawaban E">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Jawaban Yang Benar:</strong><br>
                            <label><input type="radio" name="jawaban_benar" value="A" required> A</label><br>
                            <label><input type="radio" name="jawaban_benar" value="B" required> B</label><br>
                            <label><input type="radio" name="jawaban_benar" value="C" required> C</label><br>
                            <label><input type="radio" name="jawaban_benar" value="D" required> D</label><br>
                            <label><input type="radio" name="jawaban_benar" value="E" required> E</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Status Soal:</strong><br>
                            <label><input type="radio" name="status" value="dipilih" required> Pilih</label><br>
                            <label><input type="radio" name="status" value="tidak dipilih" required> Tidak Dipilih</label><br>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
