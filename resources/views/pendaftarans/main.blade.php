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
        <form action="{{ route('pendaftaransantri.simpan') }}" method="POST" class="needs-validation"
            enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nisn" class="form-label">NISN:</label>
                <input type="text" id="nisn" name="nisn" class="form-control" required>
                @error('nisn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nik" class="form-label">NIK:</label>
                <input type="text" id="nik" name="nik" class="form-control" required>
                @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="asal_sekolah" class="form-label">Asal Sekolah:</label>
                <input type="text" id="asal_sekolah" name="asal_sekolah" class="form-control" required>
                @error('asal_sekolah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin:</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="jenis_kelamin_laki" name="jenis_kelamin"
                            value="Laki-laki" required>
                        <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan" name="jenis_kelamin"
                            value="Perempuan" required>
                        <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                    </div>
                </div>
                @error('jenis_kelamin')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ttl" class="form-label">Tempat Lahir</label>
                <input type="text" id="ttl" name="tempat_lahir" class="form-control" required>
                @error('tanggal_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
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
                        <input class="form-check-input" type="radio" id="kondisi_berkecukupan" name="kondisi"
                            value="Berkecukupan" required>
                        <label class="form-check-label" for="kondisi_berkecukupan">Berkecukupan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="kondisi_kurang_mampu" name="kondisi"
                            value="Kurang Mampu" required>
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
                            value="Lengkap" required>
                        <label class="form-check-label" for="kondisi_ortu_lengkap">Lengkap</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="kondisi_ortu_yatim" name="kondisi_ortu"
                            value="Yatim" required>
                        <label class="form-check-label" for="kondisi_ortu_yatim">Yatim</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="kondisi_ortu_piatu" name="kondisi_ortu"
                            value="Piatu" required>
                        <label class="form-check-label" for="kondisi_ortu_piatu">Piatu</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="kondisi_ortu_yatim_piatu" name="kondisi_ortu"
                            value="Yatim Piatu" required>
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
                            value="Anak Kandung" required>
                        <label class="form-check-label" for="status_kandung">Anak Kandung</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="status_tiri_ayah" name="status_dkluarga"
                            value="Anak Tiri Dari Ayah" required>
                        <label class="form-check-label" for="status_tiri_ayah">Anak Tiri Dari Ayah</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="status_tiri_ibu" name="status_dkluarga"
                            value="Anak Tiri Dari Ibu" required>
                        <label class="form-check-label" for="status_tiri_ibu">Anak Tiri Dari Ibu</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="status_angkat" name="status_dkluarga"
                            value="Anak Angkat" required>
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
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="tinggal_orang_tua" name="tempat_tinggal"
                            value="Orang Tua" required>
                        <label class="form-check-label" for="tinggal_orang_tua">Orang Tua</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="tinggal_kakek_nenek" name="tempat_tinggal"
                            value="Kakek/Nenek" required>
                        <label class="form-check-label" for="tinggal_kakek_nenek">Kakek/Nenek</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="tinggal_paman_bibi" name="tempat_tinggal"
                            value="Paman/Bibi" required>
                        <label class="form-check-label" for="tinggal_paman_bibi">Paman/Bibi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="tinggal_saudara_kandung"
                            name="tempat_tinggal" value="Saudara Kandung" required>
                        <label class="form-check-label" for="tinggal_saudara_kandung">Saudara Kandung</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="tinggal_kerabat" name="tempat_tinggal"
                            value="Kerabat" required>
                        <label class="form-check-label" for="tinggal_kerabat">Kerabat</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="tinggal_panti_ponten" name="tempat_tinggal"
                            value="Panti/Ponten" required>
                        <label class="form-check-label" for="tinggal_panti_ponten">Panti/Ponten</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="tinggal_lainnya" name="tempat_tinggal"
                            value="Lainnya" required>
                        <label class="form-check-label" for="tinggal_lainnya">Lainnya</label>
                    </div>
                    <div id="lainnya_input_container" class="mt-2" style="display: none;">
                        <input type="text" id="lainnya_input" name="tempat_tinggal" class="form-control"
                            placeholder="Silakan isi tempat tinggal lainnya">
                    </div>
                </div>
                @error('tempat_tinggal')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="kewarganegaraan" class="form-label">Kewarganegaraan:</label>
                <input type="text" id="kewarganegaraan" name="kewarganegaraan" class="form-control" required>
                @error('kewarganegaraan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="anak_ke" class="form-label">Anak Ke:</label>
                <input type="number" id="anak_ke" name="anak_ke" class="form-control" required>
                @error('anak_ke')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jumlah_saudara" class="form-label">Jumlah Saudara:</label>
                <input type="number" id="jumlah_saudara" name="jumlah_saudara" class="form-control" required>
                @error('jumlah_saudara')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nomor_telpon" class="form-label">Nomor Telepon:</label>
                <input type="tel" id="nomor_telpon" name="nomor_telpon" class="form-control" required>
                @error('nomor_telpon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
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
                        <input class="form-check-input" type="radio" id="jenjang_sd" name="jenjang_pendidikan"
                            value="SD" required>
                        <label class="form-check-label" for="jenjang_sd">SD</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="jenjang_mts" name="jenjang_pendidikan"
                            value="MTS" required>
                        <label class="form-check-label" for="jenjang_mts">MTS</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="jenjang_ma" name="jenjang_pendidikan"
                            value="MA" required>
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
                <!-- Upload Dokumen -->
                <div class="col-md-6">
                    <label for="ijazah" class="form-label"><strong>Ijazah</strong></label>
                    <input type="file" name="ijazah" id="ijazah" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="nilai_raport" class="form-label"><strong>Nilai Raport</strong></label>
                    <input type="file" name="nilai_raport" id="nilai_raport" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="skhun" class="form-label"><strong>SKHUN</strong></label>
                    <input type="file" name="skhun" id="skhun" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="foto" class="form-label"><strong>Foto</strong></label>
                    <input type="file" name="foto" id="foto" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="kk" class="form-label"><strong>Kartu Keluarga (KK)</strong></label>
                    <input type="file" name="kk" id="kk" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="ktp_ayah" class="form-label"><strong>KTP Ayah</strong></label>
                    <input type="file" name="ktp_ayah" id="ktp_ayah" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="ktp_ibu" class="form-label"><strong>KTP Ibu</strong></label>
                    <input type="file" name="ktp_ibu" id="ktp_ibu" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="nama_ayah" class="form-label"><strong>Nama Ayah:</strong></label>
                <input type="text" name="nama_ayah" class="form-control" id="nama_ayah"
                    placeholder="Masukan Nama Ayah">
            </div>
            <div class="mb-3">
                <label for="pendidikan_ayah" class="form-label"><strong>Pendidikan Ayah:</strong></label>
                <input type="text" name="pendidikan_ayah" class="form-control" id="pendidikan_ayah"
                    placeholder="Masukan Pendidikan Terakhir Ayah">
            </div>
            <div class="mb-3">
                <label for="pekerjaan_ayah" class="form-label"><strong>Pekerjaan Ayah:</strong></label>
                <input type="text" name="pekerjaan_ayah" class="form-control" id="pekerjaan_ayah"
                    placeholder="Masukan Pekerjaan Ayah">
            </div>
            <div class="mb-3">
                <label for="nama_ibu" class="form-label"><strong>Nama Ibu:</strong></label>
                <input type="text" name="nama_ibu" class="form-control" id="nama_ibu"
                    placeholder="Masukan Nama Ibu">
            </div>
            <div class="mb-3">
                <label for="pendidikan_ibu" class="form-label"><strong>Pendidikan Ibu:</strong></label>
                <input type="text" name="pendidikan_ibu" class="form-control" id="pendidikan_ibu"
                    placeholder="Masukan Pendidikan Terakhir Ibu">
            </div>
            <div class="mb-3">
                <label for="pekerjaan_ibu" class="form-label"><strong>Pekerjaan Ibu:</strong></label>
                <input type="text" name="pekerjaan_ibu" class="form-control" id="pekerjaan_ibu"
                    placeholder="Masukan Pekerjaan Ibu">
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label"><strong>No Hp:</strong></label>
                <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Masukan No Hp">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label"><strong>Alamat:</strong></label>
                <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukan Alamat"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Golongan Darah:</strong></label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_a" value="A">
                        <label class="form-check-label" for="golongan_darah_a">A</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_b" value="B">
                        <label class="form-check-label" for="golongan_darah_b">B</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_ab" value="AB">
                        <label class="form-check-label" for="golongan_darah_ab">AB</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="golongan_darah" id="golongan_darah_o" value="O">
                        <label class="form-check-label" for="golongan_darah_o">O</label>
                    </div>
                </div>
            </div>  
            <div class="mb-3">
                <label for="tb" class="form-label"><strong>Tinggi Badan:</strong></label>
                <input type="text" name="tb" class="form-control" id="tb"
                    placeholder="Masukan Tinggi Badan (cm)">
            </div>
            <div class="mb-3">
                <label for="bb" class="form-label"><strong>Berat Badan:</strong></label>
                <input type="text" name="bb" class="form-control" id="pekerjaan_ayah"
                    placeholder="Masukan Berat Badan (Kg)">
            </div>
            <div class="mb-3">
                <label for="riwayat_penyakit" class="form-label"><strong>Riwayat Penyakit:</strong></label>
                <input type="text" name="riwayat_penyakit" class="form-control" id="riwayat_penyakit"
                    placeholder="Masukan Riwayat Penyakit">
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <strong>Nama Bantuan:</strong>
                    <input type="text" name="nama_bantuan" class="form-control"
                        placeholder="Masukan Nama Bantuan Yang Pernah Diterima">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <strong>Tingkat :</strong>
                    <input type="text" name="tingkat" class="form-control"
                        placeholder="Masukan Tingkat Bantuan Yang pernah Diterima">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <strong>No KIP :</strong>
                    <input type="text" name="no_kip" class="form-control" placeholder="Masukan Nomor KIP">
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
