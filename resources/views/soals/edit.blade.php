@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Data Soal</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('soals_get',$soal->ujian_id) }}"> Back</a>
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
    
    <div class="card mt-4">
        <div class="card-body">
            <form action="{{ route('soals.update', $soal->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Ujian Id:</strong>
                            <input type="text" name="ujian_id" value="{{ $soal->ujian_id}}" class="form-control"
                                placeholder="Ujian Id">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Pertanyaan :</strong>
                            <input type="text" name="pertanyaan" value="{{ $soal->pertanyaan }}" class="form-control"
                                placeholder="Pertanyaan">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Jawaban A :</strong>
                            <input type="text" name="jawaban_a" value="{{ $soal->jawaban_a }}" class="form-control"
                                placeholder="Jawaban A">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Jawaban B :</strong>
                            <input type="text" name="jawaban_b" value="{{ $soal->jawaban_b }}" class="form-control"
                                placeholder="Jawaban B">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Jawaban C :</strong>
                            <input type="text" name="jawaban_c" value="{{ $soal->jawaban_c }}" class="form-control"
                                placeholder="Jawaban C">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Jawaban D :</strong>
                            <input type="text" name="jawaban_d" value="{{ $soal->jawaban_d}}" class="form-control"
                                placeholder="Jawaban D">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Jawaban E :</strong>
                            <input type="text" name="jawaban_e" value="{{ $soal->jawaban_e }}" class="form-control"
                                placeholder="Jawaban E">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Jawaban Benar :</strong><br>
                            <label>
                                <input type="radio" name="jawaban_benar" value="A" 
                                {{ $soal->jawaban_benar == 'A' ? 'checked' : '' }}> A
                            </label><br>
                            <label>
                                <input type="radio" name="jawaban_benar" value="B" 
                                {{ $soal->jawaban_benar == 'B' ? 'checked' : '' }}> B
                            </label><br>
                            <label>
                                <input type="radio" name="jawaban_benar" value="C" 
                                {{ $soal->jawaban_benar == 'C' ? 'checked' : '' }}> C
                            </label><br>
                            <label>
                                <input type="radio" name="jawaban_benar" value="D" 
                                {{ $soal->jawaban_benar == 'D' ? 'checked' : '' }}> D
                            </label><br>
                            <label>
                                <input type="radio" name="jawaban_benar" value="E" 
                                {{ $soal->jawaban_benar == 'E' ? 'checked' : '' }}> E
                            </label>
                        </div>
                    </div>            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Status Soal :</strong><br>
                            <label>
                                <input type="radio" name="status" value="dipilih" 
                                {{ $soal->status == 'dipilih' ? 'checked' : '' }}> Dipilih
                            </label><br>
                            <label>
                                <input type="radio" name="status" value="tidak dipilih" 
                                {{ $soal->status == 'tidak dipilih' ? 'checked' : '' }}> Tidak Dipilih
                            </label><br>
                        </div>
                    </div>            
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
