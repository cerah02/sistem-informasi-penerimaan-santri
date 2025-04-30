@extends('layout')

@section('content')
    {{-- <div class="content-wrapper"> --}}
        <div class="container-fluid">
            <!-- Breadcrumb dengan margin yang ditingkatkan -->
            <div class="row mt-4">
                @can('pendaftaran-create')
                    <div class="col-sm-3">
                        <div class="btn-group float-sm-right">
                            <a class="btn btn-success waves-effect waves-light" href="{{ route('pendaftarans.create') }}">
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

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#pendaftaranTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('pendaftarans.index') }}",
                        data: function(d) {
                            d.status = "{{ request('status') }}"; // Ambil parameter status dari URL
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
                                let badgeClass = 'badge-secondary';
                                let style = 'color: white';

                                if (data === 'diterima') {
                                    badgeClass = 'badge-success';
                                    style = 'color: white';
                                } else if (data === 'proses') {
                                    badgeClass = 'badge-warning';
                                    style = 'color: black'; // agar tulisan tidak putih
                                } else if (data === 'ditolak') {
                                    badgeClass = 'badge-danger';
                                    style = 'color: white';
                                }

                                return `<span class="badge ${badgeClass}" style="${style}">${data}</span>`;
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
        </script>
    @endpush
@endsection
