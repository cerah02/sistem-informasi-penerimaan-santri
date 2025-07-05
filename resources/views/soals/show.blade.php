@extends('layout')
@section('content')
    <div class="row mt-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h2>Data Soal</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3 text-end">
                        <a class="btn btn-secondary" href="{{ route('soals_get',$soal->ujian_id) }}">Back</a>
                    </div>
                    <div class="mb-2">
                        <strong>Pertanyaan:</strong>
                        <p class="form-control-plaintext border rounded p-1">{{ $soal->pertanyaan }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Jawaban A:</strong>
                        <p class="form-control-plaintext border rounded p-1">{{ $soal->jawaban_a }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Jawaban B:</strong>
                        <p class="form-control-plaintext border rounded p-1">{{ $soal->jawaban_b }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Jawaban C:</strong>
                        <p class="form-control-plaintext border rounded p-1">{{ $soal->jawaban_c }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Jawaban D:</strong>
                        <p class="form-control-plaintext border rounded p-1">{{ $soal->jawaban_d }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Jawaban E:</strong>
                        <p class="form-control-plaintext border rounded p-1">{{ $soal->jawaban_e }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Status Soal:</strong>
                        <p class="form-control-plaintext border rounded p-1 bg-success text-white">{{ $soal->status }}</p>
                    </div>

                    <div class="mb-2">
                        <strong>Jawaban Yang Benar:</strong>
                        <p class="form-control-plaintext border rounded p-1 bg-success text-white">{{ $soal->jawaban_benar }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
