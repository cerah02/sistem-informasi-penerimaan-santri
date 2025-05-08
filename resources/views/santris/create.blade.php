@extends('layout')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Formulir Pendaftaran Santri</h2>

        <form id="multiStepForm" action="{{ route('santris.store') }}" method="POST">
            @csrf

            <h5 class="mb-3">1. Data Santri</h5>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN:</label>
                <input type="text" name="nisn" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nik" class="form-label">NIK:</label>
                <input type="text" name="nik" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="asal_sekolah" class="form-label">Asal Sekolah:</label>
                <input type="text" name="asal_sekolah" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jenis Kelamin:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki" required>
                    <label class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan" required>
                    <label class="form-check-label">Perempuan</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir:</label>
                <input type="text" name="tempat_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Kondisi:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="kondisi" value="Berkecukupan" required>
                    <label class="form-check-label">Berkecukupan</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="kondisi" value="Kurang Mampu" required>
                    <label class="form-check-label">Kurang Mampu</label>
                </div>
            </div>

            <div class="mb-3">
                <label>Kondisi Orang Tua:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi_ortu" value="Lengkap" required>
                    <label class="form-check-label">Lengkap</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi_ortu" value="Yatim" required>
                    <label class="form-check-label">Yatim</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi_ortu" value="Piatu" required>
                    <label class="form-check-label">Piatu</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi_ortu" value="Yatim Piatu" required>
                    <label class="form-check-label">Yatim Piatu</label>
                </div>
                @error('kondisi_ortu')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Tempat Tinggal:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempat_tinggal" value="Orang Tua" required>
                    <label class="form-check-label">Orang Tua</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempat_tinggal" value="Kakek/Nenek" required>
                    <label class="form-check-label">Kakek/Nenek</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempat_tinggal" value="Paman/Bibi" required>
                    <label class="form-check-label">Paman/Bibi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempat_tinggal" value="Saudara Kandung"
                        required>
                    <label class="form-check-label">Saudara Kandung</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempat_tinggal" value="Kerabat" required>
                    <label class="form-check-label">Kerabat</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempat_tinggal" value="Panti/Ponten" required>
                    <label class="form-check-label">Panti/Ponten</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempat_tinggal" value="Lainnya" required>
                    <label class="form-check-label">Lainnya</label>
                </div>
                <div id="lainnya_input_container" class="mt-2" style="display: none;">
                    <input type="text" id="lainnya_input" name="tempat_tinggal_lainnya" class="form-control"
                        placeholder="Silakan isi tempat tinggal lainnya">
                </div>
                @error('tempat_tinggal')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <script>
                document.querySelectorAll('input[name="tempat_tinggal"]').forEach(function(elem) {
                    elem.addEventListener('change', function() {
                        var lainnyaInputContainer = document.getElementById('lainnya_input_container');
                        if (this.value === 'Lainnya') {
                            lainnyaInputContainer.style.display = 'block';
                        } else {
                            lainnyaInputContainer.style.display = 'none';
                        }
                    });
                });
            </script>

            <div class="mb-3">
                <label>Status dalam Keluarga:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status_dkluarga" value="Anak Kandung" required>
                    <label class="form-check-label">Anak Kandung</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status_dkluarga" value="Anak Tiri Dari Ayah"
                        required>
                    <label class="form-check-label">Anak Tiri Dari Ayah</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status_dkluarga" value="Anak Tiri Dari Ibu"
                        required>
                    <label class="form-check-label">Anak Tiri Dari Ibu</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status_dkluarga" value="Anak Angkat" required>
                    <label class="form-check-label">Anak Angkat</label>
                </div>
                @error('status_dkluarga')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="anak_ke">Anak Ke-:</label>
                <input type="number" id="anak_ke" name="anak_ke"
                    class="form-control @error('anak_ke') is-invalid @enderror" placeholder="Anak Ke-" required>
                @error('anak_ke')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jumlah_saudara">Jumlah Saudara:</label>
                <input type="number" id="jumlah_saudara" name="jumlah_saudara"
                    class="form-control @error('jumlah_saudara') is-invalid @enderror" placeholder="Jumlah Saudara"
                    required>
                @error('jumlah_saudara')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="kewarganegaraan">Kewarganegaraan:</label>
                <input type="text" id="kewarganegaraan" name="kewarganegaraan"
                    class="form-control @error('kewarganegaraan') is-invalid @enderror" placeholder="Kewarganegaraan"
                    required>
                @error('kewarganegaraan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <textarea name="alamat" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="nomor_telpon" class="form-label">Nomor Telepon:</label>
                <input type="tel" name="nomor_telpon" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jenjang Pendidikan:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenjang_pendidikan" value="SD" required>
                    <label class="form-check-label">SD</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenjang_pendidikan" value="MTS" required>
                    <label class="form-check-label">MTS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenjang_pendidikan" value="MA" required>
                    <label class="form-check-label">MA</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="tahun_masuk" class="form-label">Tahun Masuk:</label>
                <input type="text" name="tahun_masuk" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
@endsection
