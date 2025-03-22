@extends('layout')
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



        <div class="card shadow mb-5">
            <div class="card-header bg-light">
                <h5 class="card-title m-0"> Edit Data Santri</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('santris.update', $santri->id) }}" method="POST" class="needs-validation" novalidate>
                    <!-- Add CSRF Token and Method Spoofing -->
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="{{ $santri->nama }}"
                            required>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN:</label>
                        <input type="text" id="nisn" name="nisn" class="form-control" value="{{ $santri->nisn }}"
                            required>
                        @error('nisn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK:</label>
                        <input type="text" id="nik" name="nik" class="form-control" value="{{ $santri->nik }}"
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
                            value="{{ $santri->asal_sekolah }}" required>
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
                                    value="laki-laki" {{ $santri->jenis_kelamin == 'laki-laki' ? 'checked' : '' }}
                                    required>
                                <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan"
                                    name="jenis_kelamin" value="perempuan"
                                    {{ $santri->jenis_kelamin == 'perempuan' ? 'checked' : '' }} required>
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
                        $ttl = explode('|', $santri->ttl, 2);
                        $tempat_lahir = $ttl[0] ?? '';
                        $tanggal_lahir = $ttl[1] ?? '';
                    @endphp

                    <div>
                        <label for="tempat_lahir">Tempat Lahir :</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir"
                            value="{{ old('tempat_lahir', $tempat_lahir) }}" required>
                    </div>

                    <div>
                        <label for="tanggal_lahir">Tanggal Lahir :</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $tanggal_lahir) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi:</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="kondisi_berkecukupan" name="kondisi"
                                    value="Berkecukupan" {{ $santri->kondisi == 'Berkecukupan' ? 'checked' : '' }}
                                    required>
                                <label class="form-check-label" for="kondisi_berkecukupan">Berkecukupan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="kondisi_kurang_mampu" name="kondisi"
                                    value="Kurang Mampu" {{ $santri->kondisi == 'Kurang Mampu' ? 'checked' : '' }}
                                    required>
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
                                <input class="form-check-input" type="radio" id="kondisi_ortu_lengkap"
                                    name="kondisi_ortu" value="Lengkap"
                                    {{ $santri->kondisi_ortu == 'Lengkap' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="kondisi_ortu_lengkap">Lengkap</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="kondisi_ortu_yatim"
                                    name="kondisi_ortu" value="Yatim"
                                    {{ $santri->kondisi_ortu == 'Yatim' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="kondisi_ortu_yatim">Yatim</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="kondisi_ortu_piatu"
                                    name="kondisi_ortu" value="Piatu"
                                    {{ $santri->kondisi_ortu == 'Piatu' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="kondisi_ortu_piatu">Piatu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="kondisi_ortu_yatim_piatu"
                                    name="kondisi_ortu" value="Yatim Piatu"
                                    {{ $santri->kondisi_ortu == 'Yatim Piatu' ? 'checked' : '' }} required>
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
                                <input class="form-check-input" type="radio" id="status_kandung"
                                    name="status_dkluarga" value="Anak Kandung"
                                    {{ $santri->status_dkluarga == 'Anak Kandung' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="status_kandung">Anak Kandung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="status_tiri_ayah"
                                    name="status_dkluarga" value="Anak Tiri Dari Ayah"
                                    {{ $santri->status_dkluarga == 'Anak Tiri Dari Ayah' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="status_tiri_ayah">Anak Tiri Dari Ayah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="status_tiri_ibu"
                                    name="status_dkluarga" value="Anak Tiri Dari Ibu"
                                    {{ $santri->status_dkluarga == 'Anak Tiri Dari Ibu' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="status_tiri_ibu">Anak Tiri Dari Ibu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="status_angkat" name="status_dkluarga"
                                    value="Anak Angkat" {{ $santri->status_dkluarga == 'Anak Angkat' ? 'checked' : '' }}
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
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="tinggal_orang_tua"
                                    name="tempat_tinggal" value="Orang Tua"
                                    {{ $santri->tempat_tinggal == 'Orang Tua' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="tinggal_orang_tua">Orang Tua</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="tinggal_kakek_nenek"
                                    name="tempat_tinggal" value="Kakek/Nenek"
                                    {{ $santri->tempat_tinggal == 'Kakek/Nenek' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="tinggal_kakek_nenek">Kakek/Nenek</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="tinggal_paman_bibi"
                                    name="tempat_tinggal" value="Paman/Bibi"
                                    {{ $santri->tempat_tinggal == 'Paman/Bibi' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="tinggal_paman_bibi">Paman/Bibi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="tinggal_saudara_kandung"
                                    name="tempat_tinggal" value="Saudara Kandung"
                                    {{ $santri->tempat_tinggal == 'Saudara Kandung' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="tinggal_saudara_kandung">Saudara Kandung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="tinggal_kerabat"
                                    name="tempat_tinggal" value="Kerabat"
                                    {{ $santri->tempat_tinggal == 'Kerabat' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="tinggal_kerabat">Kerabat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="tinggal_panti_ponten"
                                    name="tempat_tinggal" value="Panti/Ponten"
                                    {{ $santri->tempat_tinggal == 'Panti/Ponten' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="tinggal_panti_ponten">Panti/Ponten</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="tinggal_lainnya"
                                    name="tempat_tinggal" value="Lainnya"
                                    {{ $santri->tempat_tinggal == 'Lainnya' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="tinggal_lainnya">Lainnya</label>
                            </div>
                            <div id="lainnya_input_container" class="mt-2"
                                style="{{ $santri->tempat_tinggal == 'Lainnya' ? 'display: block;' : 'display: none;' }}">
                                <input type="text" id="lainnya_input" name="tempat_tinggal_lainnya"
                                    class="form-control" placeholder="Silakan isi tempat tinggal lainnya"
                                    value="{{ $santri->tempat_tinggal_lainnya }}">
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
                        <input type="text" id="kewarganegaraan" name="kewarganegaraan" class="form-control"
                            value="{{ $santri->kewarganegaraan }}" required>
                        @error('kewarganegaraan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="anak_ke" class="form-label">Anak Ke:</label>
                        <input type="number" id="anak_ke" name="anak_ke" class="form-control"
                            value="{{ $santri->anak_ke }}" required>
                        @error('anak_ke')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_saudara" class="form-label">Jumlah Saudara:</label>
                        <input type="number" id="jumlah_saudara" name="jumlah_saudara" class="form-control"
                            value="{{ $santri->jumlah_saudara }}" required>
                        @error('jumlah_saudara')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat:</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="3" required>{{ $santri->alamat }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nomor_telpon" class="form-label">Nomor Telepon:</label>
                        <input type="tel" id="nomor_telpon" name="nomor_telpon" class="form-control"
                            value="{{ $santri->nomor_telpon }}" required>
                        @error('nomor_telpon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ $santri->email }}" required>
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
                                    value="SD" {{ $santri->jenjang_pendidikan == 'SD' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jenjang_sd">SD</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="jenjang_mts"
                                    name="jenjang_pendidikan" value="MTS"
                                    {{ $santri->jenjang_pendidikan == 'MTS' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jenjang_mts">MTS</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="jenjang_ma" name="jenjang_pendidikan"
                                    value="MA" {{ $santri->jenjang_pendidikan == 'MA' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jenjang_ma">MA</label>
                            </div>
                        </div>
                        @error('jenjang_pendidikan')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('santris.index') }}" class="btn btn-secondary px-4 me-2">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
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

            // Initialize the lainnya field on page load
            if (lainnyaRadio.checked) {
                lainnyaInputContainer.style.display = 'block';
                lainnyaInput.required = true;
            }
        });
    </script>
@endsection
