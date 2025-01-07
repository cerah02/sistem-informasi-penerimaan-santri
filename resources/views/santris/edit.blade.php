@extends('santris.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Edit Data Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('santris.index') }}"> Back</a>
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
    <form action="{{ route('santris.update', $santri->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Lengkap :</strong>
                    <input type="text" name="nama" value="{{ $santri->nama }}" class="form-control"
                        placeholder="Nama">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>NISN :</strong>
                    <input type="text" name="nisn" value="{{ $santri->nisn }}" class="form-control"
                        placeholder="NISN">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>NIK :</strong>
                    <input type="text" name="nik" value="{{ $santri->nik }}" class="form-control"
                        placeholder="NIK">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Asal Sekolah:</strong>
                    <input type="text" name="asal_sekolah" value="{{ $santri->nama }}" class="form-control"
                        placeholder="Asal Sekolah">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jenis Kelamin :</strong>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option value="laki-laki" {{ $santri->jenis_kelamin == "laki-laki" ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ $santri->jenis_kelamin == "perempuan" ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> Tempat Tanggal Lahir :</strong>
                    <input type="text" name="ttl" value="{{ $santri->ttl }}" class="form-control"
                        placeholder="Tempat Tanggal Lahir">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kondisi Ekonomi :</strong>
                    <select name="kondisi" id="kondisi" class="form-control">
                        <option value="Berkecukupan" {{ $santri->kondisi == "Berkecukupan" ? 'selected' : '' }}>Berkecukupan</option>
                        <option value="Kurang Mampu" {{ $santri->kondisi == "Kurang Mampu" ? 'selected' : '' }}>Kurang Mampu</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Keadaan Orang Tua :</strong>
                    <select name="kondisi_ortu" id="kondisi_ortu" class="form-control">
                        <option value="Lengkap" {{ $santri->kondisi_ortu == "Lengkap" ? 'selected' : '' }}>Lengkap</option>
                        <option value="Yatim" {{ $santri->kondisi_ortu == "Yatim" ? 'selected' : '' }}>Yatim</option>
                        <option value="Piatu" {{ $santri->kondisi_ortu == "Piatu" ? 'selected' : '' }}>Piatu</option>
                        <option value="Yatim Piatu" {{ $santri->kondisi_ortu == "Yatim Piatu" ? 'selected' : '' }}>Yatim Piatu</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> Status Dalam Keluarga :</strong>
                    <select name="status_dkluarga" id="status_dkluarga" class="form-control">
                        <option value="Anak Kandung" {{ $santri->status_dkluarga == "Anak Kandung" ? 'selected' : '' }}>Anak Kandung</option>
                        <option value="Anak Tiri Dari Ayah" {{ $santri->status_dkluarga == "Anak Tiri Dari Ayah" ? 'selected' : '' }}>Anak Tiri Dari Ayah</option>
                        <option value="Anak Tiri Dari Ibu" {{ $santri->status_dkluarga == "Anak Tiri Dari Ibu" ? 'selected' : '' }}>Anak Tiri Dari Ibu</option>
                        <option value="Anak Angkat" {{ $santri->status_dkluarga == "Anak Angkat" ? 'selected' : '' }}>Anak Angkat</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> Tinggal Bersama:</strong>
                    <select name="tinggal" id="tinggal" class="form-control">
                        <option value="Orang Tua" {{ $santri->status_dkluarga == "Orang Tua" ? 'selected' : '' }}>Orang Tua</option>
                        <option value="Anak Tiri Dari Ayah" {{ $santri->status_dkluarga == "Anak Tiri Dari Ayah" ? 'selected' : '' }}>Anak Tiri Dari Ayah</option>
                        <option value="Anak Tiri Dari Ibu" {{ $santri->status_dkluarga == "Anak Tiri Dari Ibu" ? 'selected' : '' }}>Anak Tiri Dari Ibu</option>
                        <option value="Anak Angkat" {{ $santri->status_dkluarga == "Anak Angkat" ? 'selected' : '' }}>Anak Angkat</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kewarganegaraan :</strong>
                    <input type="text" name="kewarganegaraan" value="{{ $santri->kewarganegaraan }}" class="form-control"
                        placeholder="Kewarganegaraan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Anak Ke- :</strong>
                    <input type="text" name="anak_ke" value="{{ $santri->anak_ke }}" class="form-control"
                        placeholder="Anak Ke-">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Alamat :</strong>
                    <input type="text" name="alamat" value="{{ $santri->alamat }}" class="form-control"
                        placeholder="Alamat">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor Telpon :</strong>
                    <input type="text" name="nomor_telpon" value="{{ $santri->nomor_telpon }}" class="form-control"
                        placeholder="Nama">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email :</strong>
                    <input type="text" name="email" value="{{ $santri->email }}" class="form-control"
                        placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jenjang Pendidikan Yang Didaftar :</strong>
                    <input type="text" name="jenjang_pendidikan" value="{{ $santri->jenjang_pendidikan }}" class="form-control"
                        placeholder="Jenjang Pendidikan yang Didaftar">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection
