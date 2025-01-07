@extends('dokumens.layout')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12 text-center mb-4">
            <h2 class="text-primary">Daftar Pendaftaran dokumen</h2>
        </div>
        <div class="col-lg-12 mb-2 text-end">
            <a class="btn btn-success btn-sm" href="{{ route('dokumens.create') }}">
                <i class="bi bi-plus-circle"></i> Tambahkan Data dokumen
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
                        <td><a href="{{ asset('storage/' . $dokumen->ijazah) }}" target="_blank">Lihat</a></td>
                        <td>{{ $dokumen->ijazah }}</td>
                        <td>{{ $dokumen->nilai_raport }}</td>
                        <td>{{ $dokumen->skhun }}</td>
                        <td>{{ $dokumen->foto }}</td>
                        <td>{{ $dokumen->kk }}</td>
                        <td>{{ $dokumen->ktp_ayah }}</td>
                        <td>{{ $dokumen->ktp_ibu }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-info btn-sm mx-1" href="{{ route('dokumens.show', $dokumen->id) }}">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a class="btn btn-primary btn-sm mx-1" href="{{ route('dokumens.edit', $dokumen->id) }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $dokumen->id }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteModal{{ $dokumen->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data dokumen bernama <strong>{{ $dokumen->nama }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('dokumens.destroy', $dokumen->id) }}" method="POST" class="d-inline">
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
        {!! $dokumens->links() !!}
    </div>
@endsection
