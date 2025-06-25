@extends('layout')
@section('content')
    <div class="container mt-4">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">{{ $santri ? 'Edit' : 'Formulir' }} Pendaftaran Santri Baru</h3>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Tampilkan semua error di atas form --}}
            @if ($errors->any())
                <div class="alert alert-danger mx-3 mt-3">
                    <h5><i class="bi bi-exclamation-triangle-fill me-2"></i> Terdapat kesalahan:</h5>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-body">
                {{-- Tambahkan novalidate untuk nonaktifkan validasi browser --}}
                <form id="multiStepForm" action="{{ $santri ? route('santris.update') : route('santris.store') }}"
                    method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @if ($santri)
                        @method('PUT')
                    @endif

                    <!-- Step 1: Data Diri Santri -->
                    <div class="step" id="step-1">
                        <h5 class="mb-4 text-primary"><i class="bi bi-person-vcard me-2"></i>Data Diri Santri</h5>

                        <div class="row g-3">
                            <!-- Personal Information -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="nama" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama', $santri->nama ?? '') }}" placeholder="Nama Lengkap" required>
                                    <label for="nama">Nama Lengkap</label>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="nisn" name="nisn"
                                        class="form-control @error('nisn') is-invalid @enderror"
                                        value="{{ old('nisn', $santri->nisn ?? '') }}" placeholder="NISN" required
                                        maxlength="10" pattern="\d{10}" inputmode="numeric"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)">
                                    <label for="nisn">NISN</label>
                                    @error('nisn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="nik" name="nik"
                                        class="form-control @error('nik') is-invalid @enderror"
                                        value="{{ old('nik', $santri->nik ?? '') }}" placeholder="NIK" required
                                        maxlength="16" pattern="\d{16}" inputmode="numeric"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)">
                                    <label for="nik">NIK</label>
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="asal_sekolah" name="asal_sekolah"
                                        class="form-control @error('asal_sekolah') is-invalid @enderror"
                                        value="{{ old('asal_sekolah', $santri->asal_sekolah ?? '') }}"
                                        placeholder="Asal Sekolah" required>
                                    <label for="asal_sekolah">Asal Sekolah</label>
                                    @error('asal_sekolah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Gender and Birth Information -->
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" id="jenis_kelamin_laki" name="jenis_kelamin"
                                        value="laki-laki"
                                        {{ old('jenis_kelamin', $santri->jenis_kelamin ?? '') == 'laki-laki' ? 'checked' : '' }}
                                        required>
                                    <label class="btn btn-outline-primary" for="jenis_kelamin_laki">
                                        <i class="bi bi-gender-male me-1"></i> Laki-laki
                                    </label>

                                    <input type="radio" class="btn-check" id="jenis_kelamin_perempuan"
                                        name="jenis_kelamin" value="perempuan"
                                        {{ old('jenis_kelamin', $santri->jenis_kelamin ?? '') == 'perempuan' ? 'checked' : '' }}
                                        required>
                                    <label class="btn btn-outline-primary" for="jenis_kelamin_perempuan">
                                        <i class="bi bi-gender-female me-1"></i> Perempuan
                                    </label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="ttl" name="tempat_lahir"
                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        value="{{ old('tempat_lahir', isset($santri) ? explode('|', $santri->ttl)[0] : '') }}"
                                        placeholder="Tempat Lahir" required>
                                    <label for="ttl">Tempat Lahir</label>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        value="{{ old('tanggal_lahir', isset($santri) ? explode('|', $santri->ttl)[1] ?? '' : '') }}"
                                        required>
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status Information -->
                            <div class="col-md-6">
                                <label class="form-label">Kondisi Ekonomi</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" id="kondisi_berkecukupan" name="kondisi"
                                        value="Berkecukupan"
                                        {{ old('kondisi', $santri->kondisi ?? '') == 'Berkecukupan' ? 'checked' : '' }}
                                        required>
                                    <label class="btn btn-outline-primary" for="kondisi_berkecukupan">Berkecukupan</label>

                                    <input type="radio" class="btn-check" id="kondisi_kurang_mampu" name="kondisi"
                                        value="Kurang Mampu"
                                        {{ old('kondisi', $santri->kondisi ?? '') == 'Kurang Mampu' ? 'checked' : '' }}
                                        required>
                                    <label class="btn btn-outline-primary" for="kondisi_kurang_mampu">Kurang
                                        Mampu</label>
                                </div>
                                @error('kondisi')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kondisi Orang Tua</label>
                                <select class="form-select @error('kondisi_ortu') is-invalid @enderror"
                                    name="kondisi_ortu" required>
                                    <option value="">Pilih Kondisi Orang Tua</option>
                                    <option value="Lengkap"
                                        {{ old('kondisi_ortu', $santri->kondisi_ortu ?? '') == 'Lengkap' ? 'selected' : '' }}>
                                        Lengkap</option>
                                    <option value="Yatim"
                                        {{ old('kondisi_ortu', $santri->kondisi_ortu ?? '') == 'Yatim' ? 'selected' : '' }}>
                                        Yatim</option>
                                    <option value="Piatu"
                                        {{ old('kondisi_ortu', $santri->kondisi_ortu ?? '') == 'Piatu' ? 'selected' : '' }}>
                                        Piatu</option>
                                    <option value="Yatim Piatu"
                                        {{ old('kondisi_ortu', $santri->kondisi_ortu ?? '') == 'Yatim Piatu' ? 'selected' : '' }}>
                                        Yatim Piatu</option>
                                </select>
                                @error('kondisi_ortu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status dalam Keluarga</label>
                                <select class="form-select @error('status_dkluarga') is-invalid @enderror"
                                    name="status_dkluarga" required>
                                    <option value="">Pilih Status dalam Keluarga</option>
                                    <option value="Anak Kandung"
                                        {{ old('status_dkluarga', $santri->status_dkluarga ?? '') == 'Anak Kandung' ? 'selected' : '' }}>
                                        Anak Kandung</option>
                                    <option value="Anak Tiri Dari Ayah"
                                        {{ old('status_dkluarga', $santri->status_dkluarga ?? '') == 'Anak Tiri Dari Ayah' ? 'selected' : '' }}>
                                        Anak Tiri Dari Ayah</option>
                                    <option value="Anak Tiri Dari Ibu"
                                        {{ old('status_dkluarga', $santri->status_dkluarga ?? '') == 'Anak Tiri Dari Ibu' ? 'selected' : '' }}>
                                        Anak Tiri Dari Ibu</option>
                                    <option value="Anak Angkat"
                                        {{ old('status_dkluarga', $santri->status_dkluarga ?? '') == 'Anak Angkat' ? 'selected' : '' }}>
                                        Anak Angkat</option>
                                </select>
                                @error('status_dkluarga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tempat Tinggal</label>
                                <select class="form-select @error('tempat_tinggal') is-invalid @enderror"
                                    id="tempat_tinggal" name="tempat_tinggal" required>
                                    <option value="">Pilih Tempat Tinggal</option>
                                    <option value="Orang Tua"
                                        {{ old('tempat_tinggal', $santri->tempat_tinggal ?? '') == 'Orang Tua' ? 'selected' : '' }}>
                                        Orang Tua</option>
                                    <option value="Kakek/Nenek"
                                        {{ old('tempat_tinggal', $santri->tempat_tinggal ?? '') == 'Kakek/Nenek' ? 'selected' : '' }}>
                                        Kakek/Nenek</option>
                                    <option value="Paman/Bibi"
                                        {{ old('tempat_tinggal', $santri->tempat_tinggal ?? '') == 'Paman/Bibi' ? 'selected' : '' }}>
                                        Paman/Bibi</option>
                                    <option value="Saudara Kandung"
                                        {{ old('tempat_tinggal', $santri->tempat_tinggal ?? '') == 'Saudara Kandung' ? 'selected' : '' }}>
                                        Saudara Kandung</option>
                                    <option value="Kerabat"
                                        {{ old('tempat_tinggal', $santri->tempat_tinggal ?? '') == 'Kerabat' ? 'selected' : '' }}>
                                        Kerabat</option>
                                    <option value="Panti/Ponten"
                                        {{ old('tempat_tinggal', $santri->tempat_tinggal ?? '') == 'Panti/Ponten' ? 'selected' : '' }}>
                                        Panti/Ponten</option>
                                    <option value="Lainnya"
                                        {{ old('tempat_tinggal', $santri->tempat_tinggal ?? '') == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                                <div id="lainnya_input_container" class="mt-2"
                                    style="display: {{ old('tempat_tinggal', $santri->tempat_tinggal ?? '') == 'Lainnya' ? 'block' : 'none' }};">
                                    <input type="text" id="lainnya_input" name="tempat_tinggal_lainnya"
                                        class="form-control" placeholder="Silakan isi tempat tinggal lainnya"
                                        value="{{ old('tempat_tinggal_lainnya', $santri->tempat_tinggal_lainnya ?? '') }}">
                                </div>
                                @error('tempat_tinggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Contact Information -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="kewarganegaraan" name="kewarganegaraan"
                                        class="form-control @error('kewarganegaraan') is-invalid @enderror"
                                        value="{{ old('kewarganegaraan', $santri->kewarganegaraan ?? '') }}"
                                        placeholder="Kewarganegaraan" required>
                                    <label for="kewarganegaraan">Kewarganegaraan</label>
                                    @error('kewarganegaraan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="number" id="anak_ke" name="anak_ke"
                                        class="form-control @error('anak_ke') is-invalid @enderror"
                                        value="{{ old('anak_ke', $santri->anak_ke ?? '') }}" placeholder="Anak Ke-"
                                        required min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <label for="anak_ke">Anak Ke-</label>
                                    @error('anak_ke')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="number" id="jumlah_saudara" name="jumlah_saudara"
                                        class="form-control @error('jumlah_saudara') is-invalid @enderror"
                                        value="{{ old('jumlah_saudara', $santri->jumlah_saudara ?? '') }}"
                                        placeholder="Jumlah Saudara" required min="1"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <label for="jumlah_saudara">Jumlah Saudara</label>
                                    @error('jumlah_saudara')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                        placeholder="Alamat Lengkap" style="height: 100px" required>{{ old('alamat', $santri->alamat ?? '') }}</textarea>
                                    <label for="alamat">Alamat Lengkap</label>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" id="nomor_telpon" name="nomor_telpon"
                                        class="form-control @error('nomor_telpon') is-invalid @enderror"
                                        value="{{ old('nomor_telpon', $santri->nomor_telpon ?? '') }}"
                                        placeholder="Nomor Telepon"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                    <label for="nomor_telpon"><i class="bi bi-telephone me-1 text-primary"></i>Nomor
                                        Telepon</label>
                                    @error('nomor_telpon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $santri->email ?? '') }}" placeholder="Alamat Email"
                                        required>
                                    <label for="email">Alamat Email</label>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jenjang Pendidikan</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" id="jenjang_sd" name="jenjang_pendidikan"
                                        value="SD"
                                        {{ old('jenjang_pendidikan', $santri->jenjang_pendidikan ?? '') == 'SD' ? 'checked' : '' }}
                                        required>
                                    <label class="btn btn-outline-primary" for="jenjang_sd">SD</label>

                                    <input type="radio" class="btn-check" id="jenjang_mts" name="jenjang_pendidikan"
                                        value="MTS"
                                        {{ old('jenjang_pendidikan', $santri->jenjang_pendidikan ?? '') == 'MTS' ? 'checked' : '' }}
                                        required>
                                    <label class="btn btn-outline-primary" for="jenjang_mts">MTS</label>

                                    <input type="radio" class="btn-check" id="jenjang_ma" name="jenjang_pendidikan"
                                        value="MA"
                                        {{ old('jenjang_pendidikan', $santri->jenjang_pendidikan ?? '') == 'MA' ? 'checked' : '' }}
                                        required>
                                    <label class="btn btn-outline-primary" for="jenjang_ma">MA</label>
                                </div>
                                @error('jenjang_pendidikan')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="button" class="btn btn-primary next-step">
                                Selanjutnya <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>


                    <script>
                        document.getElementById('tempat_tinggal').addEventListener('change', function() {
                            const container = document.getElementById('lainnya_input_container');
                            container.style.display = this.value === 'Lainnya' ? 'block' : 'none';
                        });
                    </script>

                    <!-- Step 2: Upload Berkas -->
                    <div class="step d-none" id="step-2">
                        <h5 class="mb-4 text-primary"><i class="bi bi-cloud-upload me-2"></i>Upload Berkas Santri</h5>

                        <div class="row g-4">
                            <!-- Ijazah -->
                            <div class="col-md-6">
                                <div class="border p-3 rounded">
                                    <label for="ijazah" class="form-label fw-bold">
                                        <i class="bi bi-file-pdf me-1 text-danger"></i>Ijazah
                                        @if (empty($santri->dokumen->ijazah))
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    @if (!empty($santri->dokumen) && $santri->dokumen->ijazah)
                                        <div class="alert alert-light d-flex align-items-center p-2 mb-3">
                                            <i class="bi bi-paperclip me-2"></i>
                                            <a href="{{ asset('storage/' . $santri->dokumen->ijazah) }}" target="_blank"
                                                class="text-decoration-none">
                                                Lihat Dokumen
                                            </a>
                                        </div>
                                    @endif

                                    <div class="file-upload-input">
                                        <input type="file" name="ijazah" id="ijazah"
                                            class="form-control @error('ijazah') is-invalid @enderror"
                                            {{ empty($santri->dokumen->ijazah) ? 'nullable' : '' }}>
                                        <small class="text-muted">Format: PDF (Maks. 2MB)</small>
                                        @error('ijazah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Akta Kelahiran -->
                            <div class="col-md-6">
                                <div class="border p-3 rounded">
                                    <label for="akta_kelahiran" class="form-label fw-bold">
                                        <i class="bi bi-file-pdf me-1 text-danger"></i>Akta Kelahiran
                                        @if (empty($santri->dokumen->akta_kelahiran))
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    @if (!empty($santri->dokumen) && $santri->dokumen->akta_kelahiran)
                                        <div class="alert alert-light d-flex align-items-center p-2 mb-3">
                                            <i class="bi bi-paperclip me-2"></i>
                                            <a href="{{ asset('storage/' . $santri->dokumen->akta_kelahiran) }}"
                                                target="_blank" class="text-decoration-none">
                                                Lihat Dokumen
                                            </a>
                                        </div>
                                    @endif

                                    <div class="file-upload-input">
                                        <input type="file" name="akta_kelahiran" id="akta_kelahiran"
                                            class="form-control @error('ijazah') is-invalid @enderror"
                                            {{ empty($santri->dokumen->akta_kelahiran) ? 'required' : '' }}>
                                        <small class="text-muted">Format: PDF (Maks. 2MB)</small>
                                        @error('akta_kelahiran')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Nilai Raport -->
                            <div class="col-md-6">
                                <div class="border p-3 rounded">
                                    <label for="nilai_raport" class="form-label fw-bold">
                                        <i class="bi bi-file-spreadsheet me-1 text-success"></i>Nilai Raport
                                        @if (empty($santri->dokumen->nilai_raport))
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    @if (!empty($santri->dokumen) && $santri->dokumen->nilai_raport)
                                        <div class="alert alert-light d-flex align-items-center p-2 mb-3">
                                            <i class="bi bi-paperclip me-2"></i>
                                            <a href="{{ asset('storage/' . $santri->dokumen->nilai_raport) }}"
                                                target="_blank" class="text-decoration-none">
                                                Lihat Dokumen
                                            </a>
                                        </div>
                                    @endif

                                    <div class="file-upload-input">
                                        <input type="file" name="nilai_raport" id="nilai_raport"
                                            class="form-control @error('nilai_raport') is-invalid @enderror"
                                            {{ empty($santri->dokumen->nilai_raport) ? 'nullable' : '' }}>
                                        <small class="text-muted">Format: PDF (Maks. 2MB)</small>
                                        @error('nilai_raport')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- SKHUN -->
                            <div class="col-md-6">
                                <div class="border p-3 rounded">
                                    <label for="skhun" class="form-label fw-bold">
                                        <i class="bi bi-file-text me-1 text-primary"></i>SKHUN
                                        @if (empty($santri->dokumen->skhun))
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    @if (!empty($santri->dokumen) && $santri->dokumen->skhun)
                                        <div class="alert alert-light d-flex align-items-center p-2 mb-3">
                                            <i class="bi bi-paperclip me-2"></i>
                                            <a href="{{ asset('storage/' . $santri->dokumen->skhun) }}" target="_blank"
                                                class="text-decoration-none">
                                                Lihat Dokumen
                                            </a>
                                        </div>
                                    @endif

                                    <div class="file-upload-input">
                                        <input type="file" name="skhun" id="skhun"
                                            class="form-control @error('skhun') is-invalid @enderror"
                                            {{ empty($santri->dokumen->skhun) ? 'nullable' : '' }}>
                                        <small class="text-muted">Format: PDF (Maks. 2MB)</small>
                                        @error('skhun')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Foto -->
                            <div class="col-md-6">
                                <div class="border p-3 rounded">
                                    <label for="foto" class="form-label fw-bold">
                                        <i class="bi bi-camera me-1 text-warning"></i>Foto
                                        @if (empty($santri->dokumen->foto))
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    @if (!empty($santri->dokumen) && $santri->dokumen->foto)
                                        <div class="alert alert-light d-flex align-items-center p-2 mb-3">
                                            <i class="bi bi-paperclip me-2"></i>
                                            <a href="{{ asset('storage/' . $santri->dokumen->foto) }}" target="_blank"
                                                class="text-decoration-none">
                                                Lihat Foto
                                            </a>
                                        </div>
                                    @endif

                                    <div class="file-upload-input">
                                        <input type="file" name="foto" id="foto"
                                            class="form-control @error('foto') is-invalid @enderror" accept="image/*"
                                            {{ empty($santri->dokumen->foto) ? 'required' : '' }}>
                                        <small class="text-muted">Format: JPG/PNG (Maks. 2MB)</small>
                                        @error('foto')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Kartu Keluarga -->
                            <div class="col-md-6">
                                <div class="border p-3 rounded">
                                    <label for="kk" class="form-label fw-bold">
                                        <i class="bi bi-people-fill me-1 text-info"></i>Kartu Keluarga
                                        @if (empty($santri->dokumen->kk))
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    @if (!empty($santri->dokumen) && $santri->dokumen->kk)
                                        <div class="alert alert-light d-flex align-items-center p-2 mb-3">
                                            <i class="bi bi-paperclip me-2"></i>
                                            <a href="{{ asset('storage/' . $santri->dokumen->kk) }}" target="_blank"
                                                class="text-decoration-none">
                                                Lihat Dokumen
                                            </a>
                                        </div>
                                    @endif

                                    <div class="file-upload-input">
                                        <input type="file" name="kk" id="kk"
                                            class="form-control @error('kk') is-invalid @enderror"
                                            {{ empty($santri->dokumen->kk) ? 'required' : '' }}>
                                        <small class="text-muted">Format: PDF (Maks. 2MB)</small>
                                        @error('kk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- KTP Ayah -->
                            <div class="col-md-6">
                                <div class="border p-3 rounded">
                                    <label for="ktp_ayah" class="form-label fw-bold">
                                        <i class="bi bi-person-badge me-1 text-secondary"></i>KTP Ayah
                                        @if (empty($santri->dokumen->ktp_ayah))
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    @if (!empty($santri->dokumen) && $santri->dokumen->ktp_ayah)
                                        <div class="alert alert-light d-flex align-items-center p-2 mb-3">
                                            <i class="bi bi-paperclip me-2"></i>
                                            <a href="{{ asset('storage/' . $santri->dokumen->ktp_ayah) }}"
                                                target="_blank" class="text-decoration-none">
                                                Lihat Dokumen
                                            </a>
                                        </div>
                                    @endif

                                    <div class="file-upload-input">
                                        <input type="file" name="ktp_ayah" id="ktp_ayah"
                                            class="form-control @error('ktp_ayah') is-invalid @enderror"
                                            {{ empty($santri->dokumen->ktp_ayah) ? 'required' : '' }}>
                                        <small class="text-muted">Format: PDF (Maks. 2MB)</small>
                                        @error('ktp_ayah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- KTP Ibu -->
                            <div class="col-md-6">
                                <div class="border p-3 rounded">
                                    <label for="ktp_ibu" class="form-label fw-bold">
                                        <i class="bi bi-person-badge me-1 text-secondary"></i>KTP Ibu
                                        @if (empty($santri->dokumen->ktp_ibu))
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    @if (!empty($santri->dokumen) && $santri->dokumen->ktp_ibu)
                                        <div class="alert alert-light d-flex align-items-center p-2 mb-3">
                                            <i class="bi bi-paperclip me-2"></i>
                                            <a href="{{ asset('storage/' . $santri->dokumen->ktp_ibu) }}" target="_blank"
                                                class="text-decoration-none">
                                                Lihat Dokumen
                                            </a>
                                        </div>
                                    @endif

                                    <div class="file-upload-input">
                                        <input type="file" name="ktp_ibu" id="ktp_ibu"
                                            class="form-control @error('ktp_ibu') is-invalid @enderror"
                                            {{ empty($santri->dokumen->ktp_ibu) ? 'required' : '' }}>
                                        <small class="text-muted">Format: PDF (Maks. 2MB)</small>
                                        @error('ktp_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary prev-step">
                                <i class="bi bi-arrow-left me-2"></i>Sebelumnya
                            </button>
                            <button type="button" class="btn btn-primary next-step">
                                Selanjutnya <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Data Orang Tua -->
                    <div class="step d-none" id="step-3">
                        <h5 class="mb-4 text-primary"><i class="bi bi-people-fill me-2"></i>Data Orang Tua/Wali</h5>

                        <div class="row g-3">
                            <!-- Data Ayah -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="nama_ayah"
                                        class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah"
                                        placeholder="Nama Ayah"
                                        value="{{ old('nama_ayah', $santri->ortu->nama_ayah ?? '') }}" required>
                                    <label for="nama_ayah"><i class="bi bi-gender-male me-1 text-primary"></i>Nama
                                        Ayah</label>
                                    @error('nama_ayah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="nama_ibu"
                                        class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu"
                                        placeholder="Nama Ibu"
                                        value="{{ old('nama_ibu', $santri->ortu->nama_ibu ?? '') }}" required>
                                    <label for="nama_ibu"><i class="bi bi-gender-female me-1 text-danger"></i>Nama
                                        Ibu</label>
                                    @error('nama_ibu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="pendidikan_ayah" class="form-label">Pendidikan Terakhir Ayah</label>
                                <select class="form-select @error('pendidikan_ayah') is-invalid @enderror"
                                    name="pendidikan_ayah" id="pendidikan_ayah" required>
                                    <option value="">Pilih Pendidikan Terakhir Ayah</option>
                                    <option value="Tidak Sekolah"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'Tidak Sekolah' ? 'selected' : '' }}>
                                        Tidak Sekolah</option>
                                    <option value="PAUD"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'PAUD' ? 'selected' : '' }}>
                                        PAUD</option>
                                    <option value="TK/RA"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'TK/RA' ? 'selected' : '' }}>
                                        TK/RA</option>
                                    <option value="SD/Sederajat"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'SD/Sederajat' ? 'selected' : '' }}>
                                        SD / MI / Sederajat</option>
                                    <option value="SMP/Sederajat"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'SMP/Sederajat' ? 'selected' : '' }}>
                                        SMP / MTs / Sederajat</option>
                                    <option value="SMA/Sederajat"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'SMA/Sederajat' ? 'selected' : '' }}>
                                        SMA / MA / SMK / Sederajat</option>
                                    <option value="Diploma I"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'Diploma I' ? 'selected' : '' }}>
                                        D1 / Sederajat</option>
                                    <option value="Diploma II"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'Diploma II' ? 'selected' : '' }}>
                                        D2 / Sederajat</option>
                                    <option value="Diploma III"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'Diploma III' ? 'selected' : '' }}>
                                        D3 / Sederajat</option>
                                    <option value="Strata I"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'Strata I' ? 'selected' : '' }}>
                                        S1 / D4</option>
                                    <option value="Strata II"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'Strata II' ? 'selected' : '' }}>
                                        S2</option>
                                    <option value="Strata III"
                                        {{ old('pendidikan_ayah', $santri->ortu->pendidikan_ayah ?? '') == 'Strata III' ? 'selected' : '' }}>
                                        S3</option>
                                </select>
                                @error('pendidikan_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pendidikan_ibu" class="form-label">Pendidikan Terakhir Ibu</label>
                                <select class="form-select @error('pendidikan_ibu') is-invalid @enderror"
                                    name="pendidikan_ibu" id="pendidikan_ibu" required>
                                    <option value="">Pilih Pendidikan Terakhir Ibu</option>
                                    <option value="Tidak Sekolah"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'Tidak Sekolah' ? 'selected' : '' }}>
                                        Tidak Sekolah</option>
                                    <option value="PAUD"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'PAUD' ? 'selected' : '' }}>
                                        PAUD</option>
                                    <option value="TK/RA"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'TK/RA' ? 'selected' : '' }}>
                                        TK/RA</option>
                                    <option value="SD/Sederajat"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'SD/Sederajat' ? 'selected' : '' }}>
                                        SD / MI / Sederajat</option>
                                    <option value="SMP/Sederajat"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'SMP/Sederajat' ? 'selected' : '' }}>
                                        SMP / MTs / Sederajat</option>
                                    <option value="SMA/Sederajat"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'SMA/Sederajat' ? 'selected' : '' }}>
                                        SMA / MA / SMK / Sederajat</option>
                                    <option value="Diploma I"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'Diploma I' ? 'selected' : '' }}>
                                        D1 / Sederajat</option>
                                    <option value="Diploma II"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'Diploma II' ? 'selected' : '' }}>
                                        D2 / Sederajat</option>
                                    <option value="Diploma III"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'Diploma III' ? 'selected' : '' }}>
                                        D3 / Sederajat</option>
                                    <option value="Strata I"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'Strata I' ? 'selected' : '' }}>
                                        S1 / D4</option>
                                    <option value="Strata II"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'Strata II' ? 'selected' : '' }}>
                                        S2</option>
                                    <option value="Strata III"
                                        {{ old('pendidikan_ibu', $santri->ortu->pendidikan_ibu ?? '') == 'Strata III' ? 'selected' : '' }}>
                                        S3</option>
                                </select>
                                @error('pendidikan_ibu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="pekerjaan_ayah"
                                        class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                        id="pekerjaan_ayah" placeholder="Pekerjaan Ayah"
                                        value="{{ old('pekerjaan_ayah', $santri->ortu->pekerjaan_ayah ?? '') }}"
                                        required>
                                    <label for="pekerjaan_ayah"><i class="bi bi-briefcase me-1 text-success"></i>Pekerjaan
                                        Ayah</label>
                                    @error('pekerjaan_ayah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Data Ibu -->

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="pekerjaan_ibu"
                                        class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                        id="pekerjaan_ibu" placeholder="Pekerjaan Ibu"
                                        value="{{ old('pekerjaan_ibu', $santri->ortu->pekerjaan_ibu ?? '') }}" required>
                                    <label for="pekerjaan_ibu"><i
                                            class="bi bi-briefcase me-1 text-success"></i>Pekerjaan</label>
                                    @error('pekerjaan_ibu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kontak dan Alamat -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" name="no_hp"
                                        class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                        placeholder="Nomor HP" value="{{ old('no_hp', $santri->ortu->no_hp ?? '') }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                    <label for="no_hp"><i class="bi bi-phone me-1 text-warning"></i>Nomor HP</label>
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea name="alamat_ortu" class="form-control @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu"
                                        placeholder="Alamat Orang Tua" style="height: 100px" required>{{ old('alamat_ortu', $santri->ortu->alamat_ortu ?? '') }}</textarea>
                                    <label for="alamat_ortu"><i class="bi bi-house-door me-1 text-secondary"></i>Alamat
                                        Orang Tua
                                        Lengkap</label>
                                    @error('alamat_ortu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary prev-step">
                                <i class="bi bi-arrow-left me-2"></i>Sebelumnya
                            </button>
                            <button type="button" class="btn btn-primary next-step">
                                Selanjutnya <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: Data Kesehatan -->
                    <div class="step d-none" id="step-4">
                        <h5 class="mb-4 text-primary"><i class="bi bi-heart-pulse me-2"></i>Data Kesehatan Santri</h5>

                        <div class="row g-3">
                            <!-- Golongan Darah -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="bi bi-droplet me-1 text-danger"></i>Golongan
                                    Darah</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="golongan_darah" id="golongan_darah_a"
                                        value="A"
                                        {{ old('golongan_darah', $santri->kesehatan->golongan_darah ?? '') == 'A' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger d-flex align-items-center"
                                        for="golongan_darah_a">
                                        <i class="bi bi-bloodletter fs-5 me-2"></i>A
                                    </label>

                                    <input type="radio" class="btn-check" name="golongan_darah" id="golongan_darah_b"
                                        value="B"
                                        {{ old('golongan_darah', $santri->kesehatan->golongan_darah ?? '') == 'B' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger d-flex align-items-center"
                                        for="golongan_darah_b">
                                        <i class="bi bi-bloodletter fs-5 me-2"></i>B
                                    </label>

                                    <input type="radio" class="btn-check" name="golongan_darah" id="golongan_darah_ab"
                                        value="AB"
                                        {{ old('golongan_darah', $santri->kesehatan->golongan_darah ?? '') == 'AB' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger d-flex align-items-center"
                                        for="golongan_darah_ab">
                                        <i class="bi bi-bloodletter fs-5 me-2"></i>AB
                                    </label>

                                    <input type="radio" class="btn-check" name="golongan_darah" id="golongan_darah_o"
                                        value="O"
                                        {{ old('golongan_darah', $santri->kesehatan->golongan_darah ?? '') == 'O' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger d-flex align-items-center"
                                        for="golongan_darah_o">
                                        <i class="bi bi-bloodletter fs-5 me-2"></i>O
                                    </label>
                                </div>
                                @error('golongan_darah')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Tinggi Badan -->
                            <div class="col-md-10">
                                <div class="form-floating">
                                    <input type="number" name="tb"
                                        class="form-control @error('tb') is-invalid @enderror" id="tb"
                                        placeholder="Tinggi Badan" step="0.1"
                                        value="{{ old('tb', $santri->kesehatan->tb ?? '') }}" required>
                                    <label for="tb"><i class="bi bi-arrow-up me-1 text-success"></i>Tinggi
                                        Badan</label>
                                    <div class="position-absolute end-0 top-0 mt-2 me-3">
                                        <span class="badge bg-secondary">cm</span>
                                    </div>
                                    @error('tb')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Berat Badan -->
                            <div class="col-md-10">
                                <div class="form-floating">
                                    <input type="number" name="bb"
                                        class="form-control @error('bb') is-invalid @enderror" id="bb"
                                        placeholder="Berat Badan" step="0.1"
                                        value="{{ old('bb', $santri->kesehatan->bb ?? '') }}" required>
                                    <label for="bb"><i class="bi bi-arrow-down me-1 text-warning"></i>Berat
                                        Badan</label>
                                    <div class="position-absolute end-0 top-0 mt-2 me-3">
                                        <span class="badge bg-secondary">kg</span>
                                    </div>
                                    @error('bb')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Riwayat Penyakit -->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea name="riwayat_penyakit" class="form-control @error('riwayat_penyakit') is-invalid @enderror"
                                        id="riwayat_penyakit" placeholder="Riwayat Penyakit" style="height: 100px">{{ old('riwayat_penyakit', $santri->kesehatan->riwayat_penyakit ?? '') }}</textarea>
                                    <label for="riwayat_penyakit">
                                        <i class="bi bi-clipboard2-pulse me-1 text-danger"></i>Riwayat Penyakit
                                    </label>
                                    <small class="text-muted">Kosongkan jika tidak ada</small>
                                    @error('riwayat_penyakit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary prev-step">
                                <i class="bi bi-arrow-left me-2"></i>Sebelumnya
                            </button>
                            <button type="button" class="btn btn-primary next-step">
                                <i class="bi bi-arrow-right ms-2"></i>Selanjutnya
                            </button>
                        </div>
                    </div>

                    <!-- Step 5: Data Bantuan -->
                    <div class="step d-none" id="step-5">
                        <h5 class="mb-4 text-primary"><i class="bi bi-hand-thumbs-up me-2"></i>Data Bantuan Pendidikan
                        </h5>

                        <div class="row g-3">
                            <!-- Nama Bantuan -->
                            <div class="col-md-6">
                                <label for="nama_bantuan" class="form-label">Nama Bantuan</label>
                                <select name="nama_bantuan" id="nama_bantuan"
                                    class="form-select @error('nama_bantuan') is-invalid @enderror" required>
                                    <option value="">Pilih Nama Bantuan</option>
                                    <option value="PIP"
                                        {{ old('nama_bantuan', optional($santri->bantuan)->nama_bantuan) == 'PIP' ? 'selected' : '' }}>
                                        PIP (Program Indonesia Pintar)</option>
                                    <option value="KIP"
                                        {{ old('nama_bantuan', optional($santri->bantuan)->nama_bantuan) == 'KIP' ? 'selected' : '' }}>
                                        KIP (Kartu Indonesia Pintar)</option>
                                    <option value="BSM"
                                        {{ old('nama_bantuan', optional($santri->bantuan)->nama_bantuan) == 'BSM' ? 'selected' : '' }}>
                                        BSM (Bantuan Siswa Miskin)</option>
                                    <option value="PKH"
                                        {{ old('nama_bantuan', optional($santri->bantuan)->nama_bantuan) == 'PKH' ? 'selected' : '' }}>
                                        PKH (Program Keluarga Harapan)</option>
                                    <option value="Baznas"
                                        {{ old('nama_bantuan', optional($santri->bantuan)->nama_bantuan) == 'Baznas' ? 'selected' : '' }}>
                                        Baznas</option>
                                    <option value="Yayasan"
                                        {{ old('nama_bantuan', optional($santri->bantuan)->nama_bantuan) == 'Yayasan' ? 'selected' : '' }}>
                                        Yayasan</option>
                                    <option value="Beasiswa Swasta"
                                        {{ old('nama_bantuan', optional($santri->bantuan)->nama_bantuan) == 'Beasiswa Swasta' ? 'selected' : '' }}>
                                        Beasiswa Swasta</option>
                                    <option value="Lainnya"
                                        {{ old('nama_bantuan', optional($santri->bantuan)->nama_bantuan) == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                                <div id="nama_bantuan_lainnya_container" class="mt-2"
                                    style="display: {{ old('nama_bantuan', optional($santri->bantuan)->nama_bantuan) == 'Lainnya' ? 'block' : 'none' }};">
                                    <input type="text" name="nama_bantuan_lainnya" id="nama_bantuan_lainnya"
                                        class="form-control" placeholder="Silakan isi nama bantuan lainnya"
                                        value="{{ old('nama_bantuan_lainnya', optional($santri->bantuan)->nama_bantuan_lainnya ?? '') }}">
                                </div>
                                <small class="text-muted">Contoh: PIP, KIP, BSM, PKH, Baznas, Yayasan</small>
                                @error('nama_bantuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Tingkat Bantuan -->
                            <div class="col-md-6">
                                <label for="tingkat" class="form-label">Tingkat Bantuan</label>
                                <select name="tingkat" id="tingkat"
                                    class="form-select @error('tingkat') is-invalid @enderror" required>
                                    <option value="">Pilih Tingkat Bantuan</option>
                                    <option value="Internasional"
                                        {{ old('tingkat', optional($santri->bantuan)->tingkat) == 'Internasional' ? 'selected' : '' }}>
                                        Internasional</option>
                                    <option value="Nasional"
                                        {{ old('tingkat', optional($santri->bantuan)->tingkat) == 'Nasional' ? 'selected' : '' }}>
                                        Nasional</option>
                                    <option value="Provinsi"
                                        {{ old('tingkat', optional($santri->bantuan)->tingkat) == 'Provinsi' ? 'selected' : '' }}>
                                        Provinsi</option>
                                    <option value="Kabupaten/Kota"
                                        {{ old('tingkat', optional($santri->bantuan)->tingkat) == 'Kabupaten/Kota' ? 'selected' : '' }}>
                                        Kabupaten / Kota</option>
                                    <option value="Kecamatan"
                                        {{ old('tingkat', optional($santri->bantuan)->tingkat) == 'Kecamatan' ? 'selected' : '' }}>
                                        Kecamatan</option>
                                    <option value="Desa/Kelurahan"
                                        {{ old('tingkat', optional($santri->bantuan)->tingkat) == 'Desa/Kelurahan' ? 'selected' : '' }}>
                                        Desa / Kelurahan</option>
                                    <option value="Lembaga/Swasta"
                                        {{ old('tingkat', optional($santri->bantuan)->tingkat) == 'Lembaga/Swasta' ? 'selected' : '' }}>
                                        Lembaga / Swasta</option>
                                </select>
                                @error('tingkat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Nomor KIP -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="no_kip" maxlength="6"
                                        class="form-control @error('no_kip') is-invalid @enderror" id="no_kip"
                                        placeholder="Nomor KIP"
                                        value="{{ old('no_kip', $santri->bantuan->no_kip ?? '') }}">
                                    <label for="no_kip">
                                        <i class="bi bi-credit-card me-1 text-info"></i>Nomor KIP
                                    </label>
                                    <small class="text-muted">Jika ada kartu kip mohon di isi</small>
                                    @error('no_kip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary prev-step">
                                <i class="bi bi-arrow-left me-2"></i>Sebelumnya
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-2"></i>Simpan Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Fungsi untuk menampilkan/menyembunyikan step
                let currentStep = 1;
                const totalSteps = 5;
                const form = document.getElementById('multiStepForm');

                function showStep(step) {
                    document.querySelectorAll('.step').forEach(el => {
                        el.classList.add('d-none');
                    });
                    const current = document.getElementById(`step-${step}`);
                    if (current) current.classList.remove('d-none');
                }

                // Navigasi step
                document.querySelectorAll('.next-step').forEach(button => {
                    button.addEventListener('click', function() {
                        if (currentStep < totalSteps) {
                            currentStep++;
                            showStep(currentStep);
                        }
                    });
                });

                document.querySelectorAll('.prev-step').forEach(button => {
                    button.addEventListener('click', function() {
                        if (currentStep > 1) {
                            currentStep--;
                            showStep(currentStep);
                        }
                    });
                });

                // Auto-open step dengan error
                const errorFields = @json($errors->keys());
                const fieldStepMap = {
                    // Step 1
                    'nama': 1,
                    'nisn': 1,
                    'nik': 1,
                    'asal_sekolah': 1,
                    'jenis_kelamin': 1,
                    'tempat_lahir': 1,
                    'tanggal_lahir': 1,
                    'kondisi': 1,
                    'kondisi_ortu': 1,
                    'status_dkluarga': 1,
                    'tempat_tinggal': 1,
                    'kewarganegaraan': 1,
                    'anak_ke': 1,
                    'jumlah_saudara': 1,
                    'alamat': 1,
                    'nomor_telpon': 1,
                    'email': 1,
                    'jenjang_pendidikan': 1,

                    // Step 2
                    'ijazah': 2,
                    'akta_kelahiran': 2,
                    'nilai_raport': 2,
                    'skhun': 2,
                    'foto': 2,
                    'kk': 2,
                    'ktp_ayah': 2,
                    'ktp_ibu': 2,

                    // Step 3
                    'nama_ayah': 3,
                    'pendidikan_ayah': 3,
                    'pekerjaan_ayah': 3,
                    'nama_ibu': 3,
                    'pendidikan_ibu': 3,
                    'pekerjaan_ibu': 3,
                    'no_hp': 3,
                    'alamat_ortu': 3,

                    // Step 4
                    'golongan_darah': 4,
                    'tb': 4,
                    'bb': 4,
                    'riwayat_penyakit': 4,

                    // Step 5
                    'nama_bantuan': 5,
                    'tingkat': 5,
                    'no_kip': 5
                };

                if (errorFields.length > 0) {
                    const firstErrorField = errorFields[0];
                    if (fieldStepMap.hasOwnProperty(firstErrorField)) {
                        currentStep = fieldStepMap[firstErrorField];
                    }
                }

                showStep(currentStep);

                // Validasi file sebelum submit
                form.addEventListener('submit', function(e) {
                    let isValid = true;
                    const fileInputs = form.querySelectorAll('input[type="file"]');

                    fileInputs.forEach(input => {
                        if (input.hasAttribute('required') && !input.files.length) {
                            isValid = false;
                            // Buka step 2 jika ada file yang wajib diisi
                            currentStep = 2;
                            showStep(currentStep);

                            // Tambahkan kelas error
                            input.classList.add('is-invalid');
                            if (!input.nextElementSibling || !input.nextElementSibling.classList
                                .contains('invalid-feedback')) {
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'invalid-feedback';
                                errorDiv.textContent = 'File ini wajib diupload';
                                input.parentNode.appendChild(errorDiv);
                            }
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                    }
                });

                // Tempat tinggal lainnya
                document.getElementById('tempat_tinggal').addEventListener('change', function() {
                    const container = document.getElementById('lainnya_input_container');
                    container.style.display = this.value === 'Lainnya' ? 'block' : 'none';
                });

                document.getElementById('nama_bantuan').addEventListener('change', function() {
                    const container = document.getElementById('nama_bantuan_lainnya_container');
                    container.style.display = this.value === 'Lainnya' ? 'block' : 'none';
                });
            });
        </script>
        <style>
            .file-upload-input {
                position: relative;
            }

            .file-upload-input input[type="file"] {
                padding: 0.375rem 0.75rem;
            }

            .file-upload-input small {
                font-size: 0.8em;
                display: block;
                margin-top: 0.25rem;
            }

            .alert-light a {
                color: #333;
                transition: color 0.2s;
            }

            .alert-light a:hover {
                color: #0d6efd;
                text-decoration: underline;
            }

            .form-floating label {
                padding-left: 2.5rem;
            }

            .form-floating>.bi {
                position: absolute;
                left: 1rem;
                top: 50%;
                transform: translateY(-50%);
                z-index: 3;
            }

            .form-floating>.form-control:focus~.bi {
                color: #0d6efd;
            }
        </style>
    @endsection
