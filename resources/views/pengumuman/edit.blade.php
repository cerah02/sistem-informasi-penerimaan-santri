@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-lg-12 text-center">
                <h2 class="fw-bold">Edit Data Kesehatan Santri</h2>
            </div>
            <div class="col-lg-12 d-flex justify-content-end">
                <a class="btn btn-secondary btn-lg" href="{{ route('pengumuman.index') }}">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Maaf!</strong> Data yang Anda masukkan salah.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow p-4 bg-light rounded">
            <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul" class="form-label"><strong>Judul :</strong></label>
                            <input type="text" name="judul" value="{{ $pengumuman->judul }}" class="form-control"
                                placeholder="Masukkan ID Santri" id="santri_id">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="konten" class="form-label"><strong>Konten :</strong></label>
                            <textarea name="konten" id="konten" class="form-control" required>{{ $pengumuman->konten }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_rilis" class="form-label"><strong>Tanggal Rilis :</strong></label>
                            <input type="date" name="tanggal_rilis" id="tanggal_rilis" class="form-control"
                                value="{{ \Carbon\Carbon::parse($pengumuman->tanggal_rilis)->format('Y-m-d') }}"
                                required>
                        </div>
                    </div>
                                        
                    <div class="col-md-6">
                        <label for="is_active">Aktif</label>
                        <select name="is_active" id="is_active" class="form-control" required>
                            <option value="1" {{ $pengumuman->is_active ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ !$pengumuman->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg mt-3">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
