@extends('layout')
@section('content')
    <div class="container mt-4">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Formulir Pendaftaran Santri Baru</h3>
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

            <div class="card-body">
                <form id="multiStepForm" action="{{ route('admin_pendaftaran_santri_simpan') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Step 1: Data Diri Santri -->
                    <div class="step" id="step-1">
                        <h5 class="mb-4 text-primary"><i class="bi bi-person-vcard me-2"></i>Data Diri Santri</h5>

                        <div class="row g-3">
                            <!-- Personal Information -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="nama" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                        placeholder="Nama Lengkap" required>
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
                                        class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}"
                                        placeholder="NISN" required>
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
                                        class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}"
                                        placeholder="NIK" required>
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
                                        value="{{ old('asal_sekolah') }}" placeholder="Asal Sekolah" required>
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
                                        value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'checked' : '' }}
                                        required>
                                    <label class="btn btn-outline-primary" for="jenis_kelamin_laki">
                                        <i class="bi bi-gender-male me-1"></i> Laki-laki
                                    </label>

                                    <input type="radio" class="btn-check" id="jenis_kelamin_perempuan"
                                        name="jenis_kelamin" value="perempuan"
                                        {{ old('jenis_kelamin') == 'perempuan' ? 'checked' : '' }} required>
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
                                    <input type="text" id="tempat_lahir" name="tempat_lahir"
                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        value="{{ old('tempat_lahir') }}" placeholder="Tempat Lahir" required>
                                    <label for="tempat_lahir">Tempat Lahir</label>
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
                                        value="{{ old('tanggal_lahir') }}" required>
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
                                        value="Berkecukupan" {{ old('kondisi') == 'Berkecukupan' ? 'checked' : '' }}
                                        required>
                                    <label class="btn btn-outline-primary" for="kondisi_berkecukupan">Berkecukupan</label>

                                    <input type="radio" class="btn-check" id="kondisi_kurang_mampu" name="kondisi"
                                        value="Kurang Mampu" {{ old('kondisi') == 'Kurang Mampu' ? 'checked' : '' }}
                                        required>
                                    <label class="btn btn-outline-primary" for="kondisi_kurang_mampu">Kurang Mampu</label>
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
                                    <option value="Lengkap" {{ old('kondisi_ortu') == 'Lengkap' ? 'selected' : '' }}>
                                        Lengkap</option>
                                    <option value="Yatim" {{ old('kondisi_ortu') == 'Yatim' ? 'selected' : '' }}>
                                        Yatim</option>
                                    <option value="Piatu" {{ old('kondisi_ortu') == 'Piatu' ? 'selected' : '' }}>
                                        Piatu</option>
                                    <option value="Yatim Piatu"
                                        {{ old('kondisi_ortu') == 'Yatim Piatu' ? 'selected' : '' }}>
                                        Yatim Piatu</option>
                                </select>
                                @error('kondisi_ortu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Sisakan bagian form lainnya yang relevan sesuai controller -->

                            <!-- Step 2: Upload Berkas -->
                            <div class="step d-none" id="step-2">
                                <h5 class="mb-4 text-primary"><i class="bi bi-cloud-upload me-2"></i>Upload Berkas Santri
                                </h5>

                                <div class="row g-4">
                                    <!-- Akta Kelahiran -->
                                    <div class="col-md-6">
                                        <div class="border p-3 rounded">
                                            <label for="akta_kelahiran" class="form-label fw-bold">
                                                <i class="bi bi-file-pdf me-1 text-danger"></i>Akta Kelahiran
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="file-upload-input">
                                                <input type="file" name="akta_kelahiran" id="akta_kelahiran"
                                                    class="form-control @error('akta_kelahiran') is-invalid @enderror"
                                                    required>
                                                <small class="text-muted">Format: PDF/JPG/PNG (Maks. 5MB)</small>
                                                @error('akta_kelahiran')
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
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="file-upload-input">
                                                <input type="file" name="foto" id="foto"
                                                    class="form-control @error('foto') is-invalid @enderror"
                                                    accept="image/*" required>
                                                <small class="text-muted">Format: JPG/PNG (Maks. 5MB)</small>
                                                @error('foto')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- KK -->
                                    <div class="col-md-6">
                                        <div class="border p-3 rounded">
                                            <label for="kk" class="form-label fw-bold">
                                                <i class="bi bi-people-fill me-1 text-info"></i>Kartu Keluarga
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="file-upload-input">
                                                <input type="file" name="kk" id="kk"
                                                    class="form-control @error('kk') is-invalid @enderror" required>
                                                <small class="text-muted">Format: PDF/JPG/PNG (Maks. 5MB)</small>
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
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="file-upload-input">
                                                <input type="file" name="ktp_ayah" id="ktp_ayah"
                                                    class="form-control @error('ktp_ayah') is-invalid @enderror" required>
                                                <small class="text-muted">Format: PDF/JPG/PNG (Maks. 5MB)</small>
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
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="file-upload-input">
                                                <input type="file" name="ktp_ibu" id="ktp_ibu"
                                                    class="form-control @error('ktp_ibu') is-invalid @enderror" required>
                                                <small class="text-muted">Format: PDF/JPG/PNG (Maks. 5MB)</small>
                                                @error('ktp_ibu')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sisakan bagian dokumen lainnya sesuai kebutuhan -->
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

                            <!-- Step-step berikutnya (Data Orang Tua, Kesehatan, Bantuan) tetap dipertahankan -->

                            <!-- ... (Lanjutkan dengan step-step berikutnya) ... -->

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Pertahankan logika multi-step form
            document.addEventListener('DOMContentLoaded', function() {
                let currentStep = 1;
                const totalSteps = 5;

                function showStep(step) {
                    document.querySelectorAll('.step').forEach(el => el.classList.add('d-none'));
                    const current = document.getElementById(`step-${step}`);
                    if (current) current.classList.remove('d-none');
                }

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

                showStep(currentStep);
            });
        </script>

        <style>
            /* Pertahankan styling yang diperlukan */
            .file-upload-input input[type="file"] {
                padding: 0.375rem 0.75rem;
            }

            .form-floating label {
                padding-left: 2.5rem;
            }
        </style>
    @endsection
