@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Form Data Guru</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('gurus.index') }}"> Kembali</a>
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

    <?php $ttl = explode(' ', $guru->ttl, 2);
    ?>
    <form action="{{ route('gurus.update', $guru->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Nama:</strong>
                    <input type="text" name="nama" value="{{ $guru->nama }}" class="form-control"
                        placeholder="Nama">
                </div>
            </div>
            <div class="col-md-12">
                <label class="form-label">Jenis Kelamin:</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="jenis_kelamin_laki" name="jenis_kelamin"
                            value="Laki-laki" {{ $guru->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan" name="jenis_kelamin"
                            value="Perempuan" {{ $guru->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                    </div>
                </div>
                @error('jenis_kelamin')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            @php
                $ttl = explode('|', $guru->ttl, 2);
                $tempat_lahir = $ttl[0] ?? '';
                $tanggal_lahir = $ttl[1] ?? '';
            @endphp

            <div>
                <label for="tempat_lahir">Tempat Lahir :</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $tempat_lahir) }}"
                    required>
            </div>

            <div>
                <label for="tanggal_lahir">Tanggal Lahir :</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                    value="{{ old('tanggal_lahir', $tanggal_lahir) }}" required>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Alamat:</strong>
                    <input type="text" name="alamat" value="{{ $guru->alamat }}" class="form-control"
                        placeholder="Alamat">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>NIP:</strong>
                    <input type="text" name="nip" value="{{ $guru->nip }}" class="form-control"
                        placeholder="NIP">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" value="{{ $guru->email }}" class="form-control"
                        placeholder="Email">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>No Telpon:</strong>
                    <input type="text" name="no_telpon" value="{{ $guru->no_telpon }}" class="form-control"
                        placeholder="No Telpon">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Status Guru:</strong>
                    <input type="text" name="status_guru" value="{{ $guru->status_guru }}" class="form-control"
                        placeholder="Status Guru">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Foto Guru:</strong>
                    <input type="file" name="foto" value="{{ $guru->foto }}" class="form-control"
                        placeholder="Foto Guru">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection
