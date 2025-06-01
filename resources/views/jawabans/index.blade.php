@extends('layout')

@section('content')
    <div class="card shadow-sm border-0 mb-4 h-100">
        <div class="container py-4">
            <h2 class="mb-4 fw-bold text-primary">📊 Daftar Jawaban Ujian Santri</h2>

            {{-- Filter --}}
            <form id="filterForm" class="row mb-4 g-3" method="GET" action="{{ route('jawabans.index') }}">
                <div class="col-md-4">
                    <select name="jenjang" class="form-select" onchange="$('#filterForm').submit()">
                        <option value="">🎓 Filter Jenjang</option>
                        @foreach ($jenjangs as $jenjang)
                            <option value="{{ $jenjang }}" {{ request('jenjang') == $jenjang ? 'selected' : '' }}>
                                {{ $jenjang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="ujian_id" class="form-select" onchange="$('#filterForm').submit()">
                        <option value="">📝 Filter Ujian</option>
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
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0 mb-4 h-100">
                            <div class="card-body">
                                <h5 class="card-title text-success">{{ $hasil->santri->nama }}</h5>
                                <h6 class="text-muted mb-2">{{ $hasil->santri->jenjang_pendidikan }}</h6>
                                <p class="mb-1"><strong>📝 Ujian:</strong> {{ $hasil->ujian->nama_ujian }}</p>
                                <p class="mb-1"><strong>📅 Tanggal:</strong>
                                    {{ $hasil->created_at->format('d M Y H:i') }}
                                </p>
                                <p class="mb-2">
                                    <span class="badge bg-success me-1">Benar: {{ $hasil->jawaban_benar }}</span>
                                    <span class="badge bg-danger">Salah: {{ $hasil->jawaban_salah }}</span>
                                </p>
                                <button class="btn btn-outline-primary btn-sm w-100 lihat-jawaban"
                                    data-santri-id="{{ $hasil->santri_id }}" data-ujian-id="{{ $hasil->ujian_id }}"
                                    data-bs-toggle="modal" data-bs-target="#jawabanModal">
                                    👁️ Lihat Jawaban
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">📭 Tidak ada data ditemukan.</div>
                    </div>
                @endforelse
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="jawabanModal" tabindex="-1" aria-labelledby="jawabanModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="jawabanModalLabel">📖 Detail Jawaban Santri</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body" id="modalJawabanContent" style="min-height: 200px;">
                            <div class="text-center text-muted">⏳ Memuat data jawaban...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script AJAX --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.lihat-jawaban').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const santriId = this.getAttribute('data-santri-id');
                    const ujianId = this.getAttribute('data-ujian-id');
                    const url = `/jawabans/detail?santri_id=${santriId}&ujian_id=${ujianId}`;
                    const modalBody = document.getElementById('modalJawabanContent');

                    modalBody.innerHTML =
                        '<div class="text-center text-muted">⏳ Memuat data jawaban...</div>';

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            modalBody.innerHTML = html;
                        })
                        .catch(() => {
                            modalBody.innerHTML =
                                '<div class="text-danger text-center">⚠️ Gagal memuat jawaban.</div>';
                        });
                });
            });
        });
    </script>
@endsection
