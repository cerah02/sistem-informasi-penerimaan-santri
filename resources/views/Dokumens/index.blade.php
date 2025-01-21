@extends('dokumens.layout')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12 text-center mb-4">
            <h2 class="text-primary">Daftar Pendaftaran dokumen</h2>
        </div>
        <div class="col-lg-12 mb-2 text-end">
            <a class="btn btn-success btn-sm" href="{{ route('dokumens.create') }}">
                <i class="bi bi-plus-circle"></i> Tambahkan Dokumen Santri
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID Santri</th>
                    <th>Ijazah</th>
                    <th>Nilai Raport</th>
                    <th>SKHUN</th>
                    <th>Foto</th>
                    <th>KK</th>
                    <th>KTP Ayah</th>
                    <th>KTP Ibu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dokumens as $index => $dokumen)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $dokumen->santri_id }}</td>
                        <td>
                            @if ($dokumen->ijazah)
                                @php
                                    $fileExtension = strtolower(pathinfo(asset($dokumen->ijazah), PATHINFO_EXTENSION));
                                @endphp
                                @if ($fileExtension == 'pdf')
                                    <!-- Menampilkan PDF -->
                                    <embed src="{{ asset($dokumen->ijazah) }}" type="application/pdf" width="200"
                                        height="150">
                                @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                    <!-- Menampilkan Gambar -->
                                    <img src="{{ asset($dokumen->ijazah) }}" alt="Preview" width="200" height="150"
                                        style="object-fit: cover;">
                                @elseif (in_array($fileExtension, ['doc', 'docx']))
                                    <!-- Tautan untuk mengunduh atau membuka file -->
                                    <a href="{{ asset($dokumen->ijazah) }}" target="_blank" class="btn btn-primary">
                                        <i class="bi bi-file-earmark-word"></i> Unduh & Buka File
                                    </a>
                                @else
                                    <!-- Pesan untuk file dengan format tidak didukung -->
                                    <span class="text-warning">Format file tidak didukung</span>
                                @endif
                                <!-- Tautan untuk mengunduh file -->
                                <a href="{{ asset($dokumen->ijazah) }}" target="_blank" class="btn btn-link">Lihat</a>
                            @else
                                <!-- Pesan jika tidak ada file -->
                                <span class="text-danger">Belum ada file</span>
                            @endif
                        </td>
                        <td>
                            @if ($dokumen->nilai_raport)
                                @php
                                    $fileExtension = strtolower(pathinfo(asset($dokumen->nilai_raport), PATHINFO_EXTENSION));
                                @endphp
                                @if ($fileExtension == 'pdf')
                                    <!-- Menampilkan PDF -->
                                    <embed src="{{ asset($dokumen->nilai_raport) }}" type="application/pdf" width="200"
                                        height="150">
                                @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                    <!-- Menampilkan Gambar -->
                                    <img src="{{ asset($dokumen->nilai_raport) }}" alt="Preview" width="200" height="150"
                                        style="object-fit: cover;">
                                @elseif (in_array($fileExtension, ['doc', 'docx']))
                                    <!-- Tautan untuk mengunduh atau membuka file -->
                                    <a href="{{ asset($dokumen->nilai_raport) }}" target="_blank" class="btn btn-primary">
                                        <i class="bi bi-file-earmark-word"></i> Unduh & Buka File
                                    </a>
                                @else
                                    <!-- Pesan untuk file dengan format tidak didukung -->
                                    <span class="text-warning">Format file tidak didukung</span>
                                @endif
                                <!-- Tautan untuk mengunduh file -->
                                <a href="{{ asset($dokumen->nilai_raport) }}" target="_blank" class="btn btn-link">Lihat</a>
                            @else
                                <!-- Pesan jika tidak ada file -->
                                <span class="text-danger">Belum ada file</span>
                            @endif
                        </td>
                        <td>
                            @if ($dokumen->skhun)
                                @php
                                    $fileExtension = strtolower(pathinfo(asset($dokumen->skhun), PATHINFO_EXTENSION));
                                @endphp
                                @if ($fileExtension == 'pdf')
                                    <!-- Menampilkan PDF -->
                                    <embed src="{{ asset($dokumen->skhun) }}" type="application/pdf" width="200"
                                        height="150">
                                @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                    <!-- Menampilkan Gambar -->
                                    <img src="{{ asset($dokumen->skhun) }}" alt="Preview" width="200" height="150"
                                        style="object-fit: cover;">
                                @elseif (in_array($fileExtension, ['doc', 'docx']))
                                    <!-- Tautan untuk mengunduh atau membuka file -->
                                    <a href="{{ asset($dokumen->skhun) }}" target="_blank" class="btn btn-primary">
                                        <i class="bi bi-file-earmark-word"></i> Unduh & Buka File
                                    </a>
                                @else
                                    <!-- Pesan untuk file dengan format tidak didukung -->
                                    <span class="text-warning">Format file tidak didukung</span>
                                @endif
                                <!-- Tautan untuk mengunduh file -->
                                <a href="{{ asset($dokumen->skhun) }}" target="_blank" class="btn btn-link">Lihat</a>
                            @else
                                <!-- Pesan jika tidak ada file -->
                                <span class="text-danger">Belum ada file</span>
                            @endif
                        </td>
                        <td>
                            @if ($dokumen->foto)
                                @php
                                    $fileExtension = strtolower(pathinfo(asset($dokumen->nilai_raport), PATHINFO_EXTENSION));
                                @endphp
                                @if ($fileExtension == 'pdf')
                                    <!-- Menampilkan PDF -->
                                    <embed src="{{ asset($dokumen->foto) }}" type="application/pdf" width="200"
                                        height="150">
                                @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                    <!-- Menampilkan Gambar -->
                                    <img src="{{ asset($dokumen->foto) }}" alt="Preview" width="200" height="150"
                                        style="object-fit: cover;">
                                @elseif (in_array($fileExtension, ['doc', 'docx']))
                                    <!-- Tautan untuk mengunduh atau membuka file -->
                                    <a href="{{ asset($dokumen->foto) }}" target="_blank" class="btn btn-primary">
                                        <i class="bi bi-file-earmark-word"></i> Unduh & Buka File
                                    </a>
                                @else
                                    <!-- Pesan untuk file dengan format tidak didukung -->
                                    <span class="text-warning">Format file tidak didukung</span>
                                @endif
                                <!-- Tautan untuk mengunduh file -->
                                <a href="{{ asset($dokumen->foto) }}" target="_blank" class="btn btn-link">Lihat</a>
                            @else
                                <!-- Pesan jika tidak ada file -->
                                <span class="text-danger">Belum ada file</span>
                            @endif
                        </td>
                        <td>
                            @if ($dokumen->kk)
                                @php
                                    $fileExtension = strtolower(pathinfo(asset($dokumen->kk), PATHINFO_EXTENSION));
                                @endphp
                                @if ($fileExtension == 'pdf')
                                    <!-- Menampilkan PDF -->
                                    <embed src="{{ asset($dokumen->kk) }}" type="application/pdf" width="200"
                                        height="150">
                                @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                    <!-- Menampilkan Gambar -->
                                    <img src="{{ asset($dokumen->kk) }}" alt="Preview" width="200" height="150"
                                        style="object-fit: cover;">
                                @elseif (in_array($fileExtension, ['doc', 'docx']))
                                    <!-- Tautan untuk mengunduh atau membuka file -->
                                    <a href="{{ asset($dokumen->kk) }}" target="_blank" class="btn btn-primary">
                                        <i class="bi bi-file-earmark-word"></i> Unduh & Buka File
                                    </a>
                                @else
                                    <!-- Pesan untuk file dengan format tidak didukung -->
                                    <span class="text-warning">Format file tidak didukung</span>
                                @endif
                                <!-- Tautan untuk mengunduh file -->
                                <a href="{{ asset($dokumen->kk) }}" target="_blank" class="btn btn-link">Lihat</a>
                            @else
                                <!-- Pesan jika tidak ada file -->
                                <span class="text-danger">Belum ada file</span>
                            @endif
                        </td>
                        <td>
                            @if ($dokumen->ktp_ayah)
                                @php
                                    $fileExtension = strtolower(pathinfo(asset($dokumen->kk), PATHINFO_EXTENSION));
                                @endphp
                                @if ($fileExtension == 'pdf')
                                    <!-- Menampilkan PDF -->
                                    <embed src="{{ asset($dokumen->ktp_ayah) }}" type="application/pdf" width="200"
                                        height="150">
                                @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                    <!-- Menampilkan Gambar -->
                                    <img src="{{ asset($dokumen->ktp_ayah) }}" alt="Preview" width="200" height="150"
                                        style="object-fit: cover;">
                                @elseif (in_array($fileExtension, ['doc', 'docx']))
                                    <!-- Tautan untuk mengunduh atau membuka file -->
                                    <a href="{{ asset($dokumen->ktp_ayah) }}" target="_blank" class="btn btn-primary">
                                        <i class="bi bi-file-earmark-word"></i> Unduh & Buka File
                                    </a>
                                @else
                                    <!-- Pesan untuk file dengan format tidak didukung -->
                                    <span class="text-warning">Format file tidak didukung</span>
                                @endif
                                <!-- Tautan untuk mengunduh file -->
                                <a href="{{ asset($dokumen->ktp_ayah) }}" target="_blank" class="btn btn-link">Lihat</a>
                            @else
                                <!-- Pesan jika tidak ada file -->
                                <span class="text-danger">Belum ada file</span>
                            @endif
                        </td>
                        <td>
                            @if ($dokumen->ktp_ibu)
                                @php
                                    $fileExtension = strtolower(pathinfo(asset($dokumen->kk), PATHINFO_EXTENSION));
                                @endphp
                                @if ($fileExtension == 'pdf')
                                    <!-- Menampilkan PDF -->
                                    <embed src="{{ asset($dokumen->ktp_ibu) }}" type="application/pdf" width="200"
                                        height="150">
                                @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                    <!-- Menampilkan Gambar -->
                                    <img src="{{ asset($dokumen->ktp_ibu) }}" alt="Preview" width="200" height="150"
                                        style="object-fit: cover;">
                                @elseif (in_array($fileExtension, ['doc', 'docx']))
                                    <!-- Tautan untuk mengunduh atau membuka file -->
                                    <a href="{{ asset($dokumen->ktp_ibu) }}" target="_blank" class="btn btn-primary">
                                        <i class="bi bi-file-earmark-word"></i> Unduh & Buka File
                                    </a>
                                @else
                                    <!-- Pesan untuk file dengan format tidak didukung -->
                                    <span class="text-warning">Format file tidak didukung</span>
                                @endif
                                <!-- Tautan untuk mengunduh file -->
                                <a href="{{ asset($dokumen->ktp_ibu) }}" target="_blank" class="btn btn-link">Lihat</a>
                            @else
                                <!-- Pesan jika tidak ada file -->
                                <span class="text-danger">Belum ada file</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-info btn-sm mx-1" href="{{ route('dokumens.show', $dokumen->id) }}">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a class="btn btn-primary btn-sm mx-1" href="{{ route('dokumens.edit', $dokumen->id) }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Hapus
                                </button>


                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">x</button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data dokumen bernama
                                                <strong>{{ $dokumen->nama }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('dokumens.destroy', $dokumen->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- End Modal -->
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {!! $dokumens->links() !!}
    </div>
@endsection
