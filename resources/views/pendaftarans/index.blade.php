@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb dengan margin yang ditingkatkan -->
            <div class="row mt-4">
                @can('pendaftaran-create')
                    <div class="col-sm-3">
                        <div class="btn-group float-sm-right">
                            <a class="btn btn-success waves-effect waves-light" href="{{ route('admin_pendaftaran_santri_view') }}">
                                <i class="fa fa-plus mr-1"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                @endcan

                <div class="card shadow-sm">

                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">Data Pendaftaran Santri</h3>
                    </div>
                    <div class="card-body">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="alert-icon contrast-alert">
                                    <i class="icon-check"></i>
                                </div>
                                <div class="alert-message">
                                    <span><strong>Berhasil!</strong> {{ $message }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="pendaftaranTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Santri</th>
                                        <th>Tanggal Pendaftaran</th>
                                        <th>Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="modal fade" id="verifikasiModal" tabindex="-1" role="dialog"
                        aria-labelledby="verifikasiModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content animate__animated animate__fadeInDown">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Verifikasi Status Pendaftaran</h5>
                                    <button type="button" class="close text-white"
                                        data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body text-center">
                                    <p>Silakan pilih status baru:</p>
                                    <div id="verifikasiButtons"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // DataTable tetap
                $('#pendaftaranTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('pendaftarans.index') }}",
                        data: function(d) {
                            d.status = "{{ request('status') }}";
                        }
                    },
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            className: 'text-center',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama_santri',
                            name: 'nama_santri'
                        },
                        {
                            data: 'tanggal_pendaftaran',
                            name: 'tanggal_pendaftaran',
                            className: 'text-center'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            className: 'text-center',
                            render: function(data) {
                                let badgeClass = {
                                    diterima: 'text-dark',
                                    proses: 'text-dark',
                                    ditolak: 'text-dark'
                                } [data] || 'badge-secondary';
                                return `<span class="badge ${badgeClass}">${data}</span>`;
                            }
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            className: 'text-center',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });

            // Tampilkan modal
            $(document).on('click', '.verifikasi-btn', function() {
                const id = $(this).data('id');
                const currentStatus = $(this).data('status');

                let statuses = [];

                if (currentStatus === 'proses') {
                    statuses = ['diterima', 'ditolak'];
                } else if (currentStatus === 'diterima') {
                    statuses = ['proses', 'ditolak'];
                } else if (currentStatus === 'ditolak') {
                    statuses = ['proses', 'diterima'];
                }

                let buttons = statuses.map(status => {
                    let btnClass = {
                        proses: 'btn-warning',
                        diterima: 'btn-success',
                        ditolak: 'btn-danger'
                    } [status];

                    return `
                <button class="btn ${btnClass} m-1 ubah-status" data-id="${id}" data-status="${status}">
                    <span class="btn-text">${status.charAt(0).toUpperCase() + status.slice(1)}</span>
                    <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                </button>`;
                }).join('');

                $('#verifikasiButtons').html(buttons);
                $('#verifikasiModal').modal('show');
            });

            // Update status dengan AJAX
            $(document).on('click', '.ubah-status', function() {
                const $btn = $(this);
                const id = $btn.data('id');
                const status = $btn.data('status');

                // Spinner loading
                $btn.prop('disabled', true);
                $btn.find('.btn-text').addClass('d-none');
                $btn.find('.spinner-border').removeClass('d-none');

                $.ajax({
                    url: `/pendaftarans/${id}/update-status`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function() {
                        $('#verifikasiModal').modal('hide');
                        $('#pendaftaranTable').DataTable().ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: `Status diubah menjadi "${status}"`,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan, coba lagi.',
                        });
                    },
                    complete: function() {
                        $btn.prop('disabled', false);
                        $btn.find('.btn-text').removeClass('d-none');
                        $btn.find('.spinner-border').addClass('d-none');
                    }
                });
            });
        </script>
    @endpush

    <style>
        .modal.fade .modal-dialog {
            transform: translate(0, -50px);
            transition: transform 0.3s ease-out;
        }

        .modal.show .modal-dialog {
            transform: translate(0, 0);
        }
    </style>
@endsection
