@extends('santris.layout')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12 text-center mb-4">
            <h2 class="text-primary">Daftar Pendaftaran Santri</h2>
        </div>
        <div class="col-lg-12 mb-2 text-end">
            <a class="btn btn-success btn-sm" href="{{ route('santris.create') }}">
                <i class="bi bi-plus-circle"></i> Tambahkan Data Santri
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
                    <th>Nama Lengkap</th>
                    <th>NISN</th>
                    <th>NIK</th>
                    <th>Asal Sekolah</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Tanggal Lahir</th>
                    <th>Kondisi Ekonomi</th>
                    <th>Keadaan Orang Tua</th>
                    <th>Status Dalam Keluarga</th>
                    <th>Tinggal Bersama</th>
                    <th>Kewarganegaraan</th>
                    <th>Anak Ke-</th>
                    <th>Dari</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                    <th>Jenjang Pendidikan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($santris as $index => $santri)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $santri->nama }}</td>
                        <td>{{ $santri->nisn }}</td>
                        <td>{{ $santri->nik }}</td>
                        <td>{{ $santri->asal_sekolah }}</td>
                        <td>{{ $santri->jenis_kelamin }}</td>
                        <td>{{ $santri->ttl }}</td>
                        <td>{{ $santri->kondisi }}</td>
                        <td>{{ $santri->kondisi_ortu }}</td>
                        <td>{{ $santri->status_dkluarga }}</td>
                        <td>{{ $santri->tempat_tinggal }}</td>
                        <td>{{ $santri->kewarganegaraan }}</td>
                        <td>{{ $santri->anak_ke }}</td>
                        <td>{{ $santri->jumlah_saudara}}</td>
                        <td>{{ $santri->alamat }}</td>
                        <td>{{ $santri->nomor_telpon }}</td>
                        <td>{{ $santri->email }}</td>
                        <td>{{ $santri->jenjang_pendidikan }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-info btn-sm mx-1" href="{{ route('santris.show', $santri->id) }}">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a class="btn btn-primary btn-sm mx-1" href="{{ route('santris.edit', $santri->id) }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $santri->id }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteModal{{ $santri->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data santri bernama <strong>{{ $santri->nama }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('santris.destroy', $santri->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {!! $santris->links() !!}
    </div>
@endsection
