@extends('layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>Laporan Data Santri
                    </h4>
                    <div class="d-flex">
                        <form method="GET" action="{{ route('laporan') }}" class="me-3">
                            <div class="input-group">
                                <select name="jenjang" id="jenjang" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Jenjang</option>
                                    <option value="SD" {{ request('jenjang') == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="MTS" {{ request('jenjang') == 'MTS' ? 'selected' : '' }}>MTS</option>
                                    <option value="MA" {{ request('jenjang') == 'MA' ? 'selected' : '' }}>MA</option>
                                </select>
                                <select name="tahun_masuk" id="tahun_masuk" class="form-select"
                                    onchange="this.form.submit()">
                                    <option value="">Semua Tahun</option>
                                    @foreach ($availableYears as $year)
                                        <option value="{{ $year }}"
                                            {{ request('tahun_masuk') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <form action="{{ route('laporan.cetakPdf') }}" method="GET" target="_blank">
                            <input type="hidden" name="jenjang" value="{{ request('jenjang') }}">
                            <input type="hidden" name="tahun_masuk" value="{{ request('tahun_masuk') }}">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-file-pdf me-1"></i> Cetak PDF
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">NO.</th>
                                <th>Nama Santri</th>
                                <th>Nisn</th>
                                <th>TTL</th>
                                <th>Jenjang</th>
                                <th>Tahun Masuk</th>
                                <th>Tanggal Daftar</th>
                                <th>Status Daftar</th>
                                <th>Rata-rata</th>
                                <th>Status Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($santris as $index => $santri)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $santri->nama }}</td>
                                    <td>{{ $santri->nisn }}</td>
                                    <td>{{ $santri->ttl }}</td>
                                    <td>
                                        <span
                                            class="badge 
                                        @if ($santri->jenjang_pendidikan == 'SD') bg-info
                                        @elseif($santri->jenjang_pendidikan == 'MTS') bg-primary
                                        @else bg-success @endif">
                                            {{ $santri->jenjang_pendidikan }}
                                        </span>
                                    </td>
                                    <td>{{ $santri->tahun_masuk ?? '-' }}</td>
                                    <td>{{ optional($santri->pendaftaran)->tanggal_pendaftaran ?? '-' }}</td>
                                    <td>
                                        <span
                                            class="badge 
                                        @if (optional($santri->pendaftaran)->status == 'diterima') bg-success
                                        @elseif(optional($santri->pendaftaran)->status == 'pending') bg-warning text-dark
                                        @elseif(optional($santri->pendaftaran)->status == 'ditolak') bg-danger
                                        @else bg-secondary @endif">
                                            {{ optional($santri->pendaftaran)->status ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if (optional($santri->totalHasil)->rata_rata)
                                            <span class="badge bg-primary rounded-pill">
                                                {{ number_format(optional($santri->totalHasil)->rata_rata, 2) }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <span
                                            class="badge 
                                        @if (optional($santri->totalHasil)->status == 'lulus') bg-success
                                        @elseif(optional($santri->totalHasil)->status == 'tidak lulus') bg-danger
                                        @else bg-secondary @endif">
                                            {{ optional($santri->totalHasil)->status ?? 'Belum Ujian' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">Tidak ada data ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-light">
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">
                            Total Data: <strong>{{ count($santris) }}</strong>
                        </small>
                    </div>
                    <div class="col-md-6 text-end">
                        <small class="text-muted">
                            Filter:
                            <strong>
                                {{ request('jenjang') ? request('jenjang') : 'Semua Jenjang' }},
                                {{ request('tahun_masuk') ? request('tahun_masuk') : 'Semua Tahun' }}
                            </strong>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
