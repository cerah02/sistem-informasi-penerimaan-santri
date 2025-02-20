@extends('layout')

@section('content')
    <div class="content-wrapper">
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Daftar Santri Mendaftar</div>
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
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#pendaftaranTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('pendaftarans.index') }}",
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
                                let badge = 'secondary';
                                if (data === 'Diterima') badge = 'success';
                                if (data === 'Ditolak') badge = 'danger';
                                return `<span class="badge badge-${badge}">${data}</span>`;
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
