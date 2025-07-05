@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Data Soal</h2>
            </div>
            @can('soal-create')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('soal.create', $id) }}"> Tambahkan Data Soal Santri</a>
                </div>
            @endcan
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <input type="hidden" value="{{ $id }}" id="id">

    <!-- Card untuk tabel -->
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">Data Soal</h3>
                <div class="mb-3">
                    <label for="filterDipilih" class="form-label fw-bold">Filter Soal</label>
                    <select id="filterDipilih" class="form-select" style="width: 200px;">
                        <option value="">Semua Soal</option>
                        <option value="dipilih">Hanya Dipilih</option>
                        <option value="tidak dipilih">Hanya Tidak Dipilih</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="card-body">
            <div class="table-responsive"> <!-- Tambahkan div ini untuk skrol horizontal -->
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Ujian</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban A</th>
                            <th>Jawaban B</th>
                            <th>Jawaban C</th>
                            <th>Jawaban D</th>
                            <th>Jawaban E</th>
                            <th>Jawaban Benar</th>
                            <th>Status</th>
                            <th width="280px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Card -->

    <script type="text/javascript">
        $(function() {
            const id_parsing = $('#id').val();
            const table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('soals_get') }}/" + id_parsing,
                    data: function(d) {
                        d.status_filter = $('#filterDipilih').val(); // kirim filter status
                    }
                },
                scrollX: true,
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'ujian_id',
                        name: 'ujian_id'
                    },
                    {
                        data: 'pertanyaan',
                        name: 'pertanyaan'
                    },
                    {
                        data: 'jawaban_a',
                        name: 'jawaban_a'
                    },
                    {
                        data: 'jawaban_b',
                        name: 'jawaban_b'
                    },
                    {
                        data: 'jawaban_c',
                        name: 'jawaban_c'
                    },
                    {
                        data: 'jawaban_d',
                        name: 'jawaban_d'
                    },
                    {
                        data: 'jawaban_e',
                        name: 'jawaban_e'
                    },
                    {
                        data: 'jawaban_benar',
                        name: 'jawaban_benar'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Filter change
            $('#filterDipilih').on('change', function() {
                table.ajax.reload();
            });

            // Toggle status change
            $('.data-table').on('change', '.toggle-status', function() {
                const soalId = $(this).data('id');
                const isChecked = $(this).is(':checked');
                const newStatus = isChecked ? 'dipilih' : 'tidak dipilih';

                Swal.fire({
                    title: 'Memperbarui status...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '/soals/update-status/' + soalId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: newStatus
                    },
                    success: function(response) {
                        Swal.close();
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            table.ajax.reload(null,
                                false); // Reload data tanpa reset pagination
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Tidak dapat mengubah status.'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan pada server!'
                        });
                    }
                });
            });
        });
    </script>
@endsection
