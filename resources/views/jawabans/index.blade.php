@extends('layout')

@section('content')
    <div class="container">
        <h2 class="mb-4">Jawaban Santri</h2>

        {{-- Filter --}}
        <form id="filterForm" class="row mb-4" method="GET" action="{{ route('jawabans.index') }}">
            <div class="col-md-4">
                <select name="jenjang" class="form-control" onchange="$('#filterForm').submit()">
                    <option value="">-- Filter Jenjang --</option>
                    @foreach ($jenjangs as $jenjang)
                        <option value="{{ $jenjang }}" {{ request('jenjang') == $jenjang ? 'selected' : '' }}>
                            {{ $jenjang }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="ujian_id" class="form-control" onchange="$('#filterForm').submit()">
                    <option value="">-- Filter Ujian --</option>
                    @foreach ($ujians as $ujian)
                        <option value="{{ $ujian->id }}" {{ request('ujian_id') == $ujian->id ? 'selected' : '' }}>
                            {{ $ujian->nama_ujian }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        {{-- Cards --}}
        <div class="row">
            @forelse ($hasils as $hasil)
                <div class="col-md-4">
                    <div class="card mb-3 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hasil->santri->nama }}</h5>
                            <p class="card-text">
                                <strong>Nama Ujian:</strong> {{ $hasil->ujian->nama_ujian }}<br>
                                <strong>Benar:</strong> {{ $hasil->jawaban_benar }} |
                                <strong>Salah:</strong> {{ $hasil->jawaban_salah }}
                            </p>
                            <button class="btn btn-primary btn-sm lihat-jawaban" data-santri-id="{{ $hasil->santri_id }}"
                                data-ujian-id="{{ $hasil->ujian_id }}" data-bs-toggle="modal"
                                data-bs-target="#jawabanModal">
                                Lihat Jawaban
                            </button>
                            <div id="jawaban-{{ $hasil->santri_id }}-{{ $hasil->ujian_id }}" class="mt-3"
                                style="display: none;"></div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Data tidak ditemukan.</div>
                </div>
            @endforelse
        </div>
        <div class="modal fade" id="jawabanModal" tabindex="-1" aria-labelledby="jawabanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="jawabanModalLabel">Detail Jawaban Santri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body" id="modalJawabanContent">
                        <!-- Jawaban akan di-load lewat AJAX -->
                        <div class="text-center">Memuat data...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.lihat-jawaban').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const santriId = this.getAttribute('data-santri-id');
                    const ujianId = this.getAttribute('data-ujian-id');

                    const url = `/jawabans/detail?santri_id=${santriId}&ujian_id=${ujianId}`;

                    const modalBody = document.getElementById('modalJawabanContent');
                    modalBody.innerHTML = '<div class="text-center">Memuat data...</div>';

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            modalBody.innerHTML = html;
                        })
                        .catch(() => {
                            modalBody.innerHTML =
                                '<div class="text-danger text-center">Gagal memuat jawaban.</div>';
                        });
                });
            });
        });
    </script>
@endsection
