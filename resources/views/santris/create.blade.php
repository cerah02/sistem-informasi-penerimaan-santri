@extends('santris.layout')
@section('content')
<div class="row mt-4">
    <div class="col-lg-12 text-center mb-4">
        <h2 class="text-primary">Form Data Santri</h2>
        <p class="text-muted">Isi form di bawah ini dengan data yang benar dan lengkap</p>
    </div>
    <div class="col-lg-12 mb-2 text-end">
        <a class="btn btn-secondary btn-sm" href="{{ route('santris.index') }}">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Perhatian!</strong> Mohon periksa kembali data yang Anda masukkan.
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action="{{ route('santris.store') }}" method="POST" class="p-4 bg-white border rounded shadow-sm">
    @csrf
    <div class="row g-4">
        <div class="col-md-6">
            <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama lengkap santri" required>
        </div>
        <div class="col-md-6">
            <label for="nisn" class="form-label fw-bold">NISN</label>
            <input type="text" name="nisn" class="form-control" id="nisn" placeholder="Masukkan NISN" required>
        </div>
        <div class="col-md-6">
            <label for="nik" class="form-label fw-bold">NIK</label>
            <input type="text" name="nik" class="form-control" id="nik" placeholder="Masukkan NIK" required>
        </div>
        <div class="col-md-6">
            <label for="asal_sekolah" class="form-label fw-bold">Asal Sekolah</label>
            <input type="text" name="asal_sekolah" class="form-control" id="asal_sekolah" placeholder="Masukkan asal sekolah" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Jenis Kelamin</label>
            <div class="d-flex">
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_laki" value="laki-laki" required>
                    <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_perempuan" value="Perempuan" required>
                    <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="ttl" class="form-label fw-bold">Tempat Tanggal Lahir</label>
            <input type="text" name="ttl" class="form-control" id="ttl" placeholder="Masukkan tempat tanggal lahir" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Kondisi Ekonomi</label>
            <div class="d-flex flex-column">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi" id="kondisi_berkecukupan" value="Berkecukupan" required>
                    <label class="form-check-label" for="kondisi_berkecukupan">Berkecukupan</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi" id="kondisi_kurang_mampu" value="Kurang Mampu" required>
                    <label class="form-check-label" for="kondisi_kurang_mampu">Kurang Mampu</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Keadaan Orang Tua</label>
            <div class="d-flex flex-column">
                @foreach(["Lengkap", "Yatim", "Piatu", "Yatim Piatu"] as $status)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kondisi_ortu" id="ortu_{{ strtolower(str_replace(' ', '_', $status)) }}" value="{{ $status }}" required>
                        <label class="form-check-label" for="ortu_{{ strtolower(str_replace(' ', '_', $status)) }}">{{ $status }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Status Di Keluarga:</label>
            <div class="d-flex flex-column">
                @foreach(["Anak Kandung", "Anak Tiri Dari Ayah", "Anak Tiri Dari Ibu", "Anak Angkat"] as $status)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_dkluarga" id="kluarga_{{ strtolower(str_replace(' ', '_', $status)) }}" value="{{ $status }}" required>
                        <label class="form-check-label" for="kluarga{{ strtolower(str_replace(' ', '_', $status)) }}">{{ $status }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Tinggal Bersama:</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tempat_tinggal" id="orang_tua" value="Orang Tua" required>
            <label class="form-check-label" for="orang_tua">
                Orang Tua
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tempat_tinggal" id="kerabat" value="Kerabat" required>
            <label class="form-check-label" for="kerabat">
                Kerabat
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tempat_tinggal" id="panti" value="Panti" required>
            <label class="form-check-label" for="panti">
                Panti
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tempat_tinggal" id="saudara_kandung" value="Saudara Kandung" required>
            <label class="form-check-label" for="saudara_kandung">
                Saudara Kandung
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tinggal" id="lainnya" value="Lainnya" required>
            <label class="form-check-label" for="lainnya">
                Lainnya
            </label>
        </div>
    </div>
        </div>
        <div class="col-md-6">
            <label for="kewarganegaraan" class="form-label fw-bold">Kewarganegaraan</label>
            <input type="text" name="kewarganegaraan" class="form-control" id="kewarganegaraan" placeholder="Masukkan Kewarganegaraan" required>
        </div>
        <div class="col-md-6">
            <label for="anak_ke" class="form-label"><strong>Anak Ke-... dari ...</strong></label>
            <div class="input-group">
                <input type="number" name="anak_ke" class="form-control" id="anak_ke" placeholder="Anak Ke-" value="{{ old('anak_ke') }}" required>
                <span class="input-group-text">dari</span>
                <input type="number" name="jumlah_saudara" class="form-control" id="jumlah_saudara" placeholder="Jumlah Saudara" value="{{ old('jumlah_saudara') }}" required>
            </div>
            @error('anak_ke')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            @error('jumlah_saudara')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="alamat" class="form-label fw-bold">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat lengkap" rows="3" required></textarea>
        </div>
        <div class="col-md-6">
            <label for="nomor_telpon" class="form-label fw-bold">Nomor Telepon</label>
            <input type="tel" name="nomor_telpon" class="form-control" id="nomor_telpon" placeholder="Masukkan nomor telepon" required>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" required>
        </div>
        <div class="col-md-6">
            <label for="jenjang_pendidikan" class="form-label fw-bold">Jenjang Pendidikan Yang Didaftar</label>
            <select name="jenjang_pendidikan" id="jenjang_pendidikan" class="form-select" required>
                <option selected disabled value="">Pilih jenjang pendidikan</option>
                @foreach(["SD", "MTS", "MA"] as $jenjang)
                    <option value="{{ $jenjang }}">{{ $jenjang }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary btn-lg px-5"><i class="bi bi-save"></i> Simpan</button>
    </div>
</form>
@endsection
