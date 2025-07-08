@extends('layout')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Kelola Pakaian</h2>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addPakaianModal">
            <i class="bi bi-plus-circle"></i> Tambah Pakaian
        </button>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pakaian</th>
                    <th>Foto</th>
                    <th>Jenis Kelamin</th>
                    <th>Jenjang Pendidikan</th>
                    <th>Keterangan</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pakaian as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_pakaian }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item->foto_pakaian) }}" width="100" class="rounded shadow">
                        </td>
                        <td>{{ ucfirst($item->jenis_kelamin) }}</td>
                        <td>{{ $item->jenjang_pendidikan }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editPakaianModal{{ $item->id }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <form action="{{ route('pakaian_edit.destroy', $item) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus pakaian ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Pakaian -->
                    <div class="modal fade" id="editPakaianModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="editPakaianLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('pakaian_edit.update', $item) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPakaianLabel{{ $item->id }}">Edit Pakaian</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Pakaian</label>
                                            <input type="text" name="nama_pakaian" class="form-control"
                                                value="{{ $item->nama_pakaian }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Foto Pakaian</label>
                                            <input type="file" name="foto_pakaian" class="form-control">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-select" required>
                                                <option value="laki-laki"
                                                    {{ $item->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="perempuan"
                                                    {{ $item->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jenjang Pendidikan</label>
                                            <select name="jenjang_pendidikan" class="form-select" required>
                                                <option value="SD"
                                                    {{ $item->jenjang_pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                                                <option value="MTS"
                                                    {{ $item->jenjang_pendidikan == 'MTS' ? 'selected' : '' }}>MTS</option>
                                                <option value="MA"
                                                    {{ $item->jenjang_pendidikan == 'MA' ? 'selected' : '' }}>MA</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
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

    <!-- Modal Tambah Pakaian -->
    <div class="modal fade" id="addPakaianModal" tabindex="-1" aria-labelledby="addPakaianLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('pakaian_edit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPakaianLabel">Tambah Pakaian Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Pakaian</label>
                            <input type="text" name="nama_pakaian" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Pakaian</label>
                            <input type="file" name="foto_pakaian" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenjang Pendidikan</label>
                            <select name="jenjang_pendidikan" class="form-select" required>
                                <option value="SD">SD</option>
                                <option value="MTS">MTS</option>
                                <option value="MA">MA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
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
s