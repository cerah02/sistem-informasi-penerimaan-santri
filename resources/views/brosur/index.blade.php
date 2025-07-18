@extends('layout')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Kelola Brosur</h2>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addBrosurModal">
            <i class="bi bi-plus-circle"></i> Tambah Brosur
        </button>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Foto Brosur</th>
                    <th>Jenjang Pendidikan</th>
                    <th>Dibuat Pada</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brosur as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item->foto_brosur) }}" width="100" class="rounded shadow">
                        </td>
                        <td>{{ $item->jenjang_pendidikan }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editBrosurModal{{ $item->id }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <form action="{{ route('brosur_edit.destroy', $item) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus brosur ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Brosur -->
                    <div class="modal fade" id="editBrosurModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('brosur_edit.update', $item) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Brosur</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Foto Brosur</label>
                                            <input type="file" name="foto_brosur" class="form-control">
                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jenjang Pendidikan</label>
                                            <!-- Readonly field -->
                                            <input type="text" class="form-control"
                                                value="{{ $item->jenjang_pendidikan }}" readonly>
                                            <!-- Hidden input to send value -->
                                            <input type="hidden" name="jenjang_pendidikan"
                                                value="{{ $item->jenjang_pendidikan }}">
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

    <!-- Modal Tambah Brosur -->
    <div class="modal fade" id="addBrosurModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('brosur_edit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Brosur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Foto Brosur</label>
                            <input type="file" name="foto_brosur" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenjang Pendidikan</label>
                            <select name="jenjang_pendidikan" class="form-select" required>
                                @foreach (['SD', 'MTS', 'MA'] as $jenjang)
                                    <option value="{{ $jenjang }}"
                                        {{ $brosur->pluck('jenjang_pendidikan')->contains($jenjang) ? 'disabled' : '' }}>
                                        {{ $jenjang }}
                                        {{ $brosur->pluck('jenjang_pendidikan')->contains($jenjang) ? '(Sudah Ada)' : '' }}
                                    </option>
                                @endforeach
                            </select>
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
