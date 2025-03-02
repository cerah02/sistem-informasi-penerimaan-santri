@extends('layout')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12 text-center mb-4">
            <h2 class="text-primary">Daftar Pendaftaran Dokumen</h2>
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

    <!-- Card untuk tabel -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Data Dokumen Santri</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle" id="dokumens-table">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
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
                </table>
            </div>
        </div>
    </div>
    <!-- End of Card -->

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data dokumen bernama <strong id="namaDokumen"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dokumens-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('dokumens.index') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'santri_nama', name: 'santri_nama' },
                { data: 'ijazah', name: 'ijazah' },
                { data: 'nilai_raport', name: 'nilai_raport' },
                { data: 'skhun', name: 'skhun' },
                { data: 'foto', name: 'foto' },
                { data: 'kk', name: 'kk' },
                { data: 'ktp_ayah', name: 'ktp_ayah' },
                { data: 'ktp_ibu', name: 'ktp_ibu' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Handle modal for delete confirmation
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var nama = button.data('nama'); // Extract nama from data-* attributes

            // Update the modal's content
            var modal = $(this);
            modal.find('#namaDokumen').text(nama);
            modal.find('#deleteForm').attr('action', '{{ url("dokumens") }}/' + id);
        });
    });
</script>
@endpush