@extends('layout')
@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h4>Formulir Edit Pendaftaran Santri</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pendaftarans.update', $pendaftaran->id) }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            value="{{ old('nama', $pendaftaran->santri->nama ?? '') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pendaftaran" class="form-label">Tanggal Pendaftaran:</label>
                        <input type="date" id="tanggal_pendaftaran" name="tanggal_pendaftaran" class="form-control"
                            value="{{ old('tanggal_pendaftaran', \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('Y-m-d')) }}"
                            required>
                        @error('tanggal_pendaftaran')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="status_proses" name="status" value="proses"
                                {{ old('status', $pendaftaran->status) == 'proses' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="status_proses">Proses</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="status_diterima" name="status"
                                value="diterima" {{ old('status', $pendaftaran->status) == 'diterima' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="status_diterima">Diterima</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="status_ditolak" name="status"
                                value="ditolak" {{ old('status', $pendaftaran->status) == 'ditolak' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="status_ditolak">Ditolak</label>
                        </div>

                        @error('status')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection