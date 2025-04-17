@extends('layout')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Formulir Pendaftaran Santri</h2>

        <form id="multiStepForm" action="{{ route('santris.store') }}" method="POST" novalidate>
            @csrf

            {{-- STEP 1: Data Santri --}}
            <div class="step" id="step-1">
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
                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" required>
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" required>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-primary next-step">Selanjutnya</button>
                </div>
            </div>

            {{-- STEP 2: Kondisi dan Keluarga --}}
            <div class="step d-none" id="step-2">
                <h5 class="mb-3">2. Kondisi dan Keluarga</h5>
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
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step">Sebelumnya</button>
                    <button type="button" class="btn btn-primary next-step">Selanjutnya</button>
                </div>
            </div>

            {{-- STEP 3: Alamat dan Kontak --}}
            <div class="step d-none" id="step-3">
                <h5 class="mb-3">3. Alamat dan Kontak</h5>
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
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step">Sebelumnya</button>
                    <button type="button" class="btn btn-primary next-step">Selanjutnya</button>
                </div>
            </div>

            {{-- STEP 4: Pendidikan dan Submit --}}
            <div class="step d-none" id="step-4">
                <h5 class="mb-3">4. Pendidikan</h5>
                <div class="mb-3">
                    <label>Jenjang Pendidikan:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenjang_pendidikan" value="SD"
                            required>
                        <label class="form-check-label">SD</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenjang_pendidikan" value="MTS"
                            required>
                        <label class="form-check-label">MTS</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenjang_pendidikan" value="MA"
                            required>
                        <label class="form-check-label">MA</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tahun_masuk" class="form-label">Tahun Masuk:</label>
                    <input type="text" name="tahun_masuk" class="form-control" value="{{ date('Y') }}" readonly>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step">Sebelumnya</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

        </form>
    </div>

    {{-- SCRIPT langsung di sini --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const totalSteps = 4;

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
@endsection
