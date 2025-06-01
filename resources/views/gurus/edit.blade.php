@extends('layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4  z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-white text-capitalize ps-3">Form Edit Data Guru</h4>
                                </div>
                                <div class="col-4 text-end">
                                    <a class="btn btn-sm btn-light mb-0 me-3" href="{{ route('gurus.index') }}">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if ($errors->any())
                            <div class="alert alert-danger mx-3">
                                <strong>Maaf!</strong> Terdapat kesalahan dalam input data.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @php
                            $ttl = explode('|', $guru->ttl, 2);
                            $tempat_lahir = $ttl[0] ?? '';
                            $tanggal_lahir = $ttl[1] ?? '';
                        @endphp

                        <form action="{{ route('gurus.update', $guru->id) }}" method="POST" enctype="multipart/form-data"
                            class="px-3">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Personal Information Column -->
                                <div class="col-md-5">
                                    <div class="my-3">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ $guru->nama }}" required>
                                    </div>

                                    <div class="my-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <div class="d-flex gap-5">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="jenis_kelamin_laki"
                                                    name="jenis_kelamin" value="Laki-laki"
                                                    {{ $guru->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan"
                                                    name="jenis_kelamin" value="Perempuan"
                                                    {{ $guru->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="jenis_kelamin_perempuan">Perempuan</label>
                                            </div>
                                        </div>
                                        @error('jenis_kelamin')
                                            <div class="text-danger text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="my-3">
                                                <label>Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="form-control"
                                                    value="{{ old('tempat_lahir', $tempat_lahir) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="my-3">
                                                <label>Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" class="form-control"
                                                    value="{{ old('tanggal_lahir', $tanggal_lahir) }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-3">
                                        <label>Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="3">{{ $guru->alamat }}</textarea>
                                    </div>
                                </div>

                                <!-- Professional Information Column -->
                                <div class="col-md-6">
                                    <div class="my-3">
                                        <label>NIP</label>
                                        <input type="text" name="nip" class="form-control"
                                            value="{{ $guru->nip }}">
                                    </div>

                                    <div class="my-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $guru->email }}">
                                    </div>

                                    <div class="my-3">
                                        <label>No. Telepon</label>
                                        <input type="tel" name="no_telpon" class="form-control"
                                            value="{{ $guru->no_telpon }}">
                                    </div>

                                    <div class="my-3">
                                        <label>Status Guru</label>
                                        <select name="status_guru" class="form-control">
                                            <option value="Aktif" {{ $guru->status_guru == 'Aktif' ? 'selected' : '' }}>
                                                Aktif</option>
                                            <option value="Non-Aktif"
                                                {{ $guru->status_guru == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif
                                            </option>
                                            <option value="Cuti" {{ $guru->status_guru == 'Cuti' ? 'selected' : '' }}>
                                                Cuti</option>
                                        </select>
                                    </div>

                                    <div class="my-3">
                                        <label class="form-label">Foto Profil</label>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" id="foto" name="foto"
                                                        onchange="previewImage(this)">
                                                </div>
                                                @if ($guru->foto)
                                                    <small class="form-text text-muted">
                                                        File saat ini: <a href="{{ asset('storage/' . $guru->foto) }}"
                                                            target="_blank">Lihat</a>
                                                    </small>
                                                @endif
                                            </div>
                                            @if ($guru->foto)
                                                <div class="ms-3">
                                                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Profil"
                                                        class="rounded-circle"
                                                        style="width: 60px; height: 60px; object-fit: cover;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    if (!preview) {
                        const img = document.createElement('img');
                        img.id = 'imagePreview';
                        img.src = e.target.result;
                        img.className = 'rounded-circle ms-3';
                        img.style = 'width: 60px; height: 60px; object-fit: cover;';
                        input.closest('.d-flex').appendChild(img);
                    } else {
                        preview.src = e.target.result;
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Add active class to nav-link
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                if (link.href === window.location.href) {
                    link.classList.add('active');
                }
            });
        });
    </script>
@endsection
