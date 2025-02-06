@extends('santris.layout')
@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.<br><br>

                <ul>

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif
        <h2 class="text-center mb-4">Formulir Pendaftaran Santri</h2>
        <form action="{{ route('pendaftarans.update',$new_data[0]['santri_id']) }}" method="POST" class="needs-validation"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" id="nama" name="nama" class="form-control"
                    value="{{ $new_data[0]['nama_santri'] }}" required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nisn" class="form-label">NISN:</label>
                <input type="text" id="nisn" name="nisn" class="form-control" value="{{ $new_data[0]['nisn'] }}"
                    required>
                @error('nisn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nik" class="form-label">NIK:</label>
                <input type="text" id="nik" name="nik" class="form-control" value="{{ $new_data[0]['nik'] }}"
                    required>
                @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="asal_sekolah" class="form-label">Asal Sekolah:</label>
                <input type="text" id="asal_sekolah" name="asal_sekolah" class="form-control"
                    value="{{ $new_data[0]['asal_sekolah'] }}" required>
                @error('asal_sekolah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <input class="form-check-input mr-3" type="radio" id="jenis_kelamin_laki" name="jenis_kelamin"
                    value="Laki-laki"
                    {{ old('jenis_kelamin', $new_data[0]['jenis_kelamin']) == 'laki-laki' ? 'checked' : '' }} required>
                <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>

                <input class="form-check-input ml-2" type="radio" id="jenis_kelamin_perempuan" name="jenis_kelamin"
                    value="Perempuan"
                    {{ old('jenis_kelamin', $new_data[0]['jenis_kelamin']) == 'perempuan' ? 'checked' : '' }} required>
                <label class="form-check-label ml-4" for="jenis_kelamin_perempuan">Perempuan</label>
            </div>

            @error('jenis_kelamin')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
    </div>
    <div class="mb-3">
        <label for="ttl" class="form-label">Tempat Lahir</label>
        <input type="text" id="ttl" name="tempat_lahir" class="form-control" value="<?= htmlspecialchars($new_data[0]['tempat_lahir']) ?>" required>
        @error('tempat_lahir')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?= htmlspecialchars($new_data[0]['tanggal_lahir']) ?>" required>
        @error('tanggal_lahir')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="kondisi" class="form-label">Kondisi:</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="kondisi_berkecukupan" name="kondisi" value="Berkecukupan"
                    {{ old('kondisi', $new_data[0]['kondisi']) == 'Berkecukupan' ? 'checked' : '' }} required>
                <label class="form-check-label" for="kondisi_berkecukupan">Berkecukupan</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="kondisi_kurang_mampu" name="kondisi" value="Kurang Mampu"
                    {{ old('kondisi', $new_data[0]['kondisi']) == 'Kurang Mampu' ? 'checked' : '' }} required>
                <label class="form-check-label" for="kondisi_kurang_mampu">Kurang Mampu</label>
            </div>
        </div>
        @error('kondisi')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Kondisi Orang Tua:</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="kondisi_ortu_lengkap" name="kondisi_ortu"
                    value="Lengkap" {{ old('kondisi_ortu', $new_data[0]['kondisi_ortu']) == 'Lengkap' ? 'checked' : '' }}
                    required>
                <label class="form-check-label" for="kondisi_ortu_lengkap">Lengkap</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="kondisi_ortu_yatim" name="kondisi_ortu"
                    value="Yatim" {{ old('kondisi_ortu', $new_data[0]['kondisi_ortu']) == 'Yatim' ? 'checked' : '' }}
                    required>
                <label class="form-check-label" for="kondisi_ortu_yatim">Yatim</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="kondisi_ortu_piatu" name="kondisi_ortu"
                    value="Piatu" {{ old('kondisi_ortu', $new_data[0]['kondisi_ortu']) == 'Piatu' ? 'checked' : '' }}
                    required>
                <label class="form-check-label" for="kondisi_ortu_piatu">Piatu</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="kondisi_ortu_yatim_piatu" name="kondisi_ortu"
                    value="Yatim Piatu"
                    {{ old('kondisi_ortu', $new_data[0]['kondisi_ortu']) == 'Yatim Piatu' ? 'checked' : '' }} required>
                <label class="form-check-label" for="kondisi_ortu_yatim_piatu">Yatim Piatu</label>
            </div>
        </div>
        @error('kondisi_ortu')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Status dalam Keluarga:</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="status_kandung" name="status_dkluarga"
                    value="Anak Kandung"
                    {{ old('status_dkluarga', $new_data[0]['status_dkluarga']) == 'Anak Kandung' ? 'checked' : '' }}
                    required>
                <label class="form-check-label" for="status_kandung">Anak Kandung</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="status_tiri_ayah" name="status_dkluarga"
                    value="Anak Tiri Dari Ayah"
                    {{ old('status_dkluarga', $new_data[0]['status_dkluarga']) == 'Anak Tiri Dari Ayah' ? 'checked' : '' }}
                    required>
                <label class="form-check-label" for="status_tiri_ayah">Anak Tiri Dari Ayah</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="status_tiri_ibu" name="status_dkluarga"
                    value="Anak Tiri Dari Ibu"
                    {{ old('status_dkluarga', $new_data[0]['status_dkluarga']) == 'Anak Tiri Dari Ibu' ? 'checked' : '' }}
                    required>
                <label class="form-check-label" for="status_tiri_ibu">Anak Tiri Dari Ibu</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="status_angkat" name="status_dkluarga"
                    value="Anak Angkat"
                    {{ old('status_dkluarga', $new_data[0]['status_dkluarga']) == 'Anak Angkat' ? 'checked' : '' }}
                    required>
                <label class="form-check-label" for="status_angkat">Anak Angkat</label>
            </div>
        </div>
        @error('status_dkluarga')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Tempat Tinggal:</label>
        <div>
            <?php
            $tempat_tinggal = $new_data[0]['tempat_tinggal'];
            $options = [
                "Orang Tua" => "tinggal_orang_tua",
                "Kakek/Nenek" => "tinggal_kakek_nenek",
                "Paman/Bibi" => "tinggal_paman_bibi",
                "Saudara Kandung" => "tinggal_saudara_kandung",
                "Kerabat" => "tinggal_kerabat",
                "Panti/Ponten" => "tinggal_panti_ponten",
                "Lainnya" => "tinggal_lainnya"
            ];
            ?>
            
            <?php foreach ($options as $label => $id) : ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="<?= $id ?>" name="tempat_tinggal" 
                        value="<?= $label ?>" <?= ($tempat_tinggal == $label) ? 'checked' : '' ?> required>
                    <label class="form-check-label" for="<?= $id ?>"><?= $label ?></label>
                </div>
            <?php endforeach; ?>
            
            <div id="lainnya_input_container" class="mt-2" style="display: <?= ($tempat_tinggal !== "Orang Tua" && !in_array($tempat_tinggal, array_keys($options))) ? 'block' : 'none' ?>;">
                <input type="text" id="lainnya_input" name="tempat_tinggal_lainnya" class="form-control" 
                    placeholder="Silakan isi tempat tinggal lainnya" value="<?= ($tempat_tinggal !== "Orang Tua" && !in_array($tempat_tinggal, array_keys($options))) ? htmlspecialchars($tempat_tinggal) : '' ?>">
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('input[name="tempat_tinggal"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('lainnya_input_container').style.display = (this.value === "Lainnya") ? 'block' : 'none';
            });
        });
    </script>
    
    <div class="mb-3">
        <label for="kewarganegaraan" class="form-label">Kewarganegaraan:</label>
        <input type="text" id="kewarganegaraan" name="kewarganegaraan" class="form-control"
            value="{{ $new_data[0]['kewarganegaraan'] }}" required>
        @error('kewarganegaraan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="anak_ke" class="form-label">Anak Ke:</label>
        <input type="number" id="anak_ke" name="anak_ke" class="form-control" value="{{ $new_data[0]['anak_ke'] }}"
            required>
        @error('anak_ke')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="jumlah_saudara" class="form-label">Jumlah Saudara:</label>
        <input type="number" id="jumlah_saudara" name="jumlah_saudara" class="form-control"
            value="{{ $new_data[0]['jumlah_saudara'] }}" required>
        @error('jumlah_saudara')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="alamat_santri" class="form-label">Alamat:</label>
        <input id="alamat_santri" type="text" name="alamat_santri" class="form-control" rows="3" value="{{ $new_data[0]['alamat_santri'] }}"
            required>
        @error('alamat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="nomor_telpon" class="form-label">Nomor Telepon:</label>
        <input type="tel" id="nomor_telpon" name="nomor_telpon" class="form-control"
            value="{{ $new_data[0]['nomor_telpon'] }}" required>
        @error('nomor_telpon')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ $new_data[0]['email'] }}"
            required>
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Jenjang Pendidikan:</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="jenjang_sd" name="jenjang_pendidikan" value="SD"
                    {{ old('jenjang_pendidikan', $new_data[0]['jenjang_pendidikan']) == 'SD' ? 'checked' : '' }} required>
                <label class="form-check-label" for="jenjang_sd">SD</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="jenjang_mts" name="jenjang_pendidikan"
                    value="MTS"
                    {{ old('jenjang_pendidikan', $new_data[0]['jenjang_pendidikan']) == 'MTS' ? 'checked' : '' }} required>
                <label class="form-check-label" for="jenjang_mts">MTS</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="jenjang_ma" name="jenjang_pendidikan" value="MA"
                    {{ old('jenjang_pendidikan', $new_data[0]['jenjang_pendidikan']) == 'MA' ? 'checked' : '' }} required>
                <label class="form-check-label" for="jenjang_ma">MA</label>
            </div>
        </div>
        @error('jenjang_pendidikan')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <label for="ijazah" class="form-label"><strong>Ijazah</strong></label>
            <input type="file" name="ijazah" id="ijazah" class="form-control">
            @if ($new_data[0]['ijazah'])
                <embed src="{{ asset($new_data[0]['ijazah']) }}" type="application/pdf" width="100%"
                    height="200px" />
            @endif
        </div>

        <div class="col-md-6">
            <label for="nilai_raport" class="form-label"><strong>Nilai Raport</strong></label>
            <input type="file" name="nilai_raport" id="nilai_raport" class="form-control">
            @if ($new_data[0]['nilai_raport'])
                <embed src="{{ asset($new_data[0]['nilai_raport']) }}" type="application/pdf" width="100%"
                    height="200px" />
            @endif
        </div>

        <div class="col-md-6">
            <label for="skhun" class="form-label"><strong>SKHUN</strong></label>
            <input type="file" name="skhun" id="skhun" class="form-control">
            @if ($new_data[0]['skhun'])
                <embed src="{{ asset($new_data[0]['skhun']) }}" type="application/pdf" width="100%" height="200px" />
            @endif
        </div>

        <div class="col-md-6">
            <label for="foto" class="form-label"><strong>Foto</strong></label>
            <input type="file" name="foto" id="foto" class="form-control">
            @if ($new_data[0]['foto'])
                <img src="{{ asset($new_data[0]['foto']) }}" class="img-fluid mt-2" width="100%" height="200px" />
            @endif
        </div>

        <div class="col-md-6">
            <label for="kk" class="form-label"><strong>Kartu Keluarga (KK)</strong></label>
            <input type="file" name="kk" id="kk" class="form-control">
            @if ($new_data[0]['kk'])
                <embed src="{{ asset($new_data[0]['kk']) }}" type="application/pdf" width="100%" height="200px" />
            @endif
        </div>

        <div class="col-md-6">
            <label for="ktp_ayah" class="form-label"><strong>KTP Ayah</strong></label>
            <input type="file" name="ktp_ayah" id="ktp_ayah" class="form-control">
            @if ($new_data[0]['ktp_ayah'])
                <img src="{{ asset($new_data[0]['ktp_ayah']) }}" width="100%" height="200px" />
            @endif
        </div>

        <div class="col-md-6">
            <label for="ktp_ibu" class="form-label"><strong>KTP Ibu</strong></label>
            <input type="file" name="ktp_ibu" id="ktp_ibu" class="form-control">
            @if ($new_data[0]['ktp_ibu'])
                <embed src="{{ asset($new_data[0]['ktp_ibu']) }}" type="application/pdf" width="100%"
                    height="200px" />
            @endif
        </div>
    </div>

    <div class="mb-3">
        <label for="nama_ayah" class="form-label"><strong>Nama Ayah:</strong></label>
        <input type="text" name="nama_ayah" class="form-control" value="{{ $new_data[0]['nama_ayah'] }}"
            id="nama_ayah" placeholder="Masukan Nama Ayah">
    </div>
    <div class="mb-3">
        <label for="pendidikan_ayah" class="form-label"><strong>Pendidikan Ayah:</strong></label>
        <input type="text" name="pendidikan_ayah" class="form-control" value="{{ $new_data[0]['pendidikan_ayah'] }}"
            id="pendidikan_ayah" placeholder="Masukan Pendidikan Terakhir Ayah">
    </div>
    <div class="mb-3">
        <label for="pekerjaan_ayah" class="form-label"><strong>Pekerjaan Ayah:</strong></label>
        <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ $new_data[0]['pekerjaan_ayah'] }}"
            id="pekerjaan_ayah" placeholder="Masukan Pekerjaan Ayah">
    </div>
    <div class="mb-3">
        <label for="nama_ibu" class="form-label"><strong>Nama Ibu:</strong></label>
        <input type="text" name="nama_ibu" class="form-control" value="{{ $new_data[0]['nama_ibu'] }}"
            id="nama_ibu" placeholder="Masukan Nama Ibu">
    </div>
    <div class="mb-3">
        <label for="pendidikan_ibu" class="form-label"><strong>Pendidikan Ibu:</strong></label>
        <input type="text" name="pendidikan_ibu" class="form-control" value="{{ $new_data[0]['pendidikan_ibu'] }}"
            id="pendidikan_ibu" placeholder="Masukan Pendidikan Terakhir Ibu">
    </div>
    <div class="mb-3">
        <label for="pekerjaan_ibu" class="form-label"><strong>Pekerjaan Ibu:</strong></label>
        <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ $new_data[0]['pekerjaan_ibu'] }}"
            id="pekerjaan_ibu" placeholder="Masukan Pekerjaan Ibu">
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label"><strong>No Hp:</strong></label>
        <input type="text" name="no_hp" class="form-control" value="{{ $new_data[0]['no_hp'] }}" id="no_hp"
            placeholder="Masukan No Hp">
    </div>
    <div class="mb-3">
        <label for="alamat_ortu" class="form-label"><strong>Alamat:</strong></label>
        <input name="alamat_ortu" type="text" class="form-control" value="{{ $new_data[0]['alamat_ortu'] }}" id="alamat_ortu"
            placeholder="Masukan Alamat">
    </div>

    <div class="mb-3">
        <label class="form-label"><strong>Golongan Darah:</strong></label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_a"
                    value="A" {{ old('golongan_darah', $new_data[0]['golongan_darah']) == 'A' ? 'checked' : '' }}>
                <label class="form-check-label" for="golongan_darah_a">A</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_b"
                    value="B" {{ old('golongan_darah', $new_data[0]['golongan_darah']) == 'B' ? 'checked' : '' }}>
                <label class="form-check-label" for="golongan_darah_b">B</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_ab"
                    value="AB" {{ old('golongan_darah', $new_data[0]['golongan_darah']) == 'AB' ? 'checked' : '' }}>
                <label class="form-check-label" for="golongan_darah_ab">AB</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_o"
                    value="O" {{ old('golongan_darah', $new_data[0]['golongan_darah']) == 'O' ? 'checked' : '' }}>
                <label class="form-check-label" for="golongan_darah_o">O</label>
            </div>
        </div>
        @error('golongan_darah')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="tb" class="form-label"><strong>Tinggi Badan:</strong></label>
        <input type="text" name="tb" class="form-control" value="{{ $new_data[0]['tb'] }}" id="tb"
            placeholder="Masukan Tinggi Badan (cm)">
    </div>
    <div class="mb-3">
        <label for="bb" class="form-label"><strong>Berat Badan:</strong></label>
        <input type="text" name="bb" class="form-control" value="{{ $new_data[0]['bb'] }}" id="pekerjaan_ayah"
            placeholder="Masukan Berat Badan (Kg)">
    </div>
    <div class="mb-3">
        <label for="riwayat_penyakit" class="form-label"><strong>Riwayat Penyakit:</strong></label>
        <input type="text" name="riwayat_penyakit" class="form-control"
            value="{{ $new_data[0]['riwayat_penyakit'] }}" id="riwayat_penyakit" placeholder="Masukan Riwayat Penyakit">
    </div>
    <div class="mb-3">
        <div class="form-group">
            <strong>Nama Bantuan:</strong>
            <input type="text" name="nama_bantuan" class="form-control" value="{{ $new_data[0]['nama_bantuan'] }}"
                placeholder="Masukan Nama Bantuan Yang Pernah Diterima">
        </div>
    </div>
    <div class="mb-3">
        <div class="form-group">
            <strong>Tingkat :</strong>
            <input type="text" name="tingkat" class="form-control" value="{{ $new_data[0]['tingkat'] }}"
                placeholder="Masukan Tingkat Bantuan Yang pernah Diterima">
        </div>
    </div>
    <div class="mb-3">
        <div class="form-group">
            <strong>No KIP :</strong>
            <input type="text" name="no_kip" class="form-control" value="{{ $new_data[0]['no_kip'] }}"
                placeholder="Masukan Nomor KIP">
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lainnyaRadio = document.getElementById('tinggal_lainnya');
            const lainnyaInputContainer = document.getElementById('lainnya_input_container');
            const lainnyaInput = document.getElementById('lainnya_input');

            // Show/hide the input field based on the "Lainnya" radio button selection
            lainnyaRadio.addEventListener('change', function() {
                if (lainnyaRadio.checked) {
                    lainnyaInputContainer.style.display = 'block';
                    lainnyaInput.required = true;
                }
            });

            // Ensure the input field is hidden if a different option is selected
            document.querySelectorAll('input[name="tempat_tinggal"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    if (!lainnyaRadio.checked) {
                        lainnyaInputContainer.style.display = 'none';
                        lainnyaInput.value = '';
                        lainnyaInput.required = false;
                    }
                });
            });
        });
    </script>
@endsection
