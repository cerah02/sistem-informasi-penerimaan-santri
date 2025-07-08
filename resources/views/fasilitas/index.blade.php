@extends('layout')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Kelola Fasilitas</h2>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addFasilitasModal">
            <i class="bi bi-plus-circle"></i> Tambah Fasilitas
        </button>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Fasilitas</th>
                    <th>Foto</th>
                    <th>Keterangan</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fasilitas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_fasilitas }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item->foto_fasilitas) }}" width="100"
                                class="rounded shadow">
                        </td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editFasilitasModal{{ $item->id }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <form action="{{ route('fasilitas_edit.destroy', $item) }}" method="POST"
                                style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus fasilitas ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Fasilitas -->
                    <div class="modal fade" id="editFasilitasModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="editFasilitasLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('fasilitas_edit.update', $item) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editFasilitasLabel{{ $item->id }}">Edit Fasilitas
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_fasilitas{{ $item->id }}" class="form-label">Nama
                                                Fasilitas</label>
                                            <input type="text" name="nama_fasilitas" class="form-control"
                                                value="{{ $item->nama_fasilitas }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto_fasilitas{{ $item->id }}" class="form-label">Foto
                                                Fasilitas</label>
                                            <input type="file" name="foto_fasilitas" class="form-control">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan{{ $item->id }}"
                                                class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" rows="3" required>{{ $item->keterangan }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Fasilitas -->
    <div class="modal fade" id="addFasilitasModal" tabindex="-1" aria-labelledby="addFasilitasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('fasilitas_edit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFasilitasLabel">Tambah Fasilitas Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
                            <input type="text" name="nama_fasilitas" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto_fasilitas" class="form-label">Foto Fasilitas</label>
                            <input type="file" name="foto_fasilitas" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
