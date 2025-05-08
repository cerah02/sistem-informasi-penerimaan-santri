@extends('layout')
@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-edit mr-2"></i>Edit Dokumen</h4>
                    <a href="{{ route('dokumens.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Perhatian!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('dokumens.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Data Santri -->
                    <div class="card mb-4 border-primary">
                        <div class="card-header bg-light-primary">
                            <h5 class="mb-0"><i class="fas fa-user-graduate mr-2"></i>Data Santri</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Santri</label>
                                <input type="text" name="santri_id" value="{{ $dokumen->santri_id }}"
                                    class="form-control form-control-lg" placeholder="Masukkan ID Santri">
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen Upload -->
                    <div class="card mb-4 border-info">
                        <div class="card-header bg-light-info">
                            <h5 class="mb-0"><i class="fas fa-file-upload mr-2"></i>Upload Dokumen</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-4">
                                <i class="fas fa-info-circle mr-2"></i>Kosongkan file jika tidak ingin mengubah dokumen
                            </p>

                            <div class="row">
                                <!-- Kolom Pertama -->
                                <div class="col-md-6">
                                    <!-- Ijazah -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">Ijazah</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="ijazah" name="ijazah">
                                            <label class="custom-file-label" for="ijazah">Pilih file...</label>
                                        </div>
                                        @if ($dokumen->ijazah)
                                            <small class="form-text text-muted">
                                                File saat ini: <a href="{{ asset('storage/' . $dokumen->ijazah) }}"
                                                    target="_blank">Lihat</a>
                                            </small>
                                        @endif
                                    </div>

                                    <!-- Nilai Raport -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nilai Raport</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="nilai_raport"
                                                name="nilai_raport">
                                            <label class="custom-file-label" for="nilai_raport">Pilih file...</label>
                                        </div>
                                        @if ($dokumen->nilai_raport)
                                            <small class="form-text text-muted">
                                                File saat ini: <a href="{{ asset('storage/' . $dokumen->nilai_raport) }}"
                                                    target="_blank">Lihat</a>
                                            </small>
                                        @endif
                                    </div>

                                    <!-- SKHUN -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">SKHUN</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="skhun" name="skhun">
                                            <label class="custom-file-label" for="skhun">Pilih file...</label>
                                        </div>
                                        @if ($dokumen->skhun)
                                            <small class="form-text text-muted">
                                                File saat ini: <a href="{{ asset('storage/' . $dokumen->skhun) }}"
                                                    target="_blank">Lihat</a>
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <!-- Kolom Kedua -->
                                <div class="col-md-6">
                                    <!-- Foto -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">Foto</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto" name="foto">
                                            <label class="custom-file-label" for="foto">Pilih file...</label>
                                        </div>
                                        @if ($dokumen->foto)
                                            <small class="form-text text-muted">
                                                File saat ini: <a href="{{ asset('storage/' . $dokumen->foto) }}"
                                                    target="_blank">Lihat</a>
                                            </small>
                                        @endif
                                    </div>

                                    <!-- KK -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">Kartu Keluarga</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="kk" name="kk">
                                            <label class="custom-file-label" for="kk">Pilih file...</label>
                                        </div>
                                        @if ($dokumen->kk)
                                            <small class="form-text text-muted">
                                                File saat ini: <a href="{{ asset('storage/' . $dokumen->kk) }}"
                                                    target="_blank">Lihat</a>
                                            </small>
                                        @endif
                                    </div>

                                    <!-- KTP Ayah -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">KTP Ayah</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="ktp_ayah"
                                                name="ktp_ayah">
                                            <label class="custom-file-label" for="ktp_ayah">Pilih file...</label>
                                        </div>
                                        @if ($dokumen->ktp_ayah)
                                            <small class="form-text text-muted">
                                                File saat ini: <a href="{{ asset('storage/' . $dokumen->ktp_ayah) }}"
                                                    target="_blank">Lihat</a>
                                            </small>
                                        @endif
                                    </div>

                                    <!-- KTP Ibu -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">KTP Ibu</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="ktp_ibu"
                                                name="ktp_ibu">
                                            <label class="custom-file-label" for="ktp_ibu">Pilih file...</label>
                                        </div>
                                        @if ($dokumen->ktp_ibu)
                                            <small class="form-text text-muted">
                                                File saat ini: <a href="{{ asset('storage/' . $dokumen->ktp_ibu) }}"
                                                    target="_blank">Lihat</a>
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .bg-light-primary {
            background-color: #e3f2fd;
        }

        .bg-light-info {
            background-color: #e3f2fd;
        }

        .custom-file-label::after {
            content: "Cari";
        }

        .card-header h5 {
            color: #2c3e50;
        }

        .border-primary {
            border: 1px solid #007bff;
        }

        .border-info {
            border: 1px solid #17a2b8;
        }
    </style>

    <script>
        // Update custom file input label
        document.querySelectorAll('.custom-file-input').forEach(input => {
            input.addEventListener('change', function(e) {
                let fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih file...';
                this.nextElementSibling.textContent = fileName;
            });
        });
    </script>
@endsection
