@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Data Guru</h2>
            </div>
            @can('guru-create')
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('gurus.create') }}"> Tambahkan Data Guru</a>

                </div>
            @endcan
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <!-- Tambahkan div dengan margin-top untuk menurunkan card -->
    <div style="margin-top: 20px;"></div>
    
    <!-- Card sebagai Latar Belakang Tabel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Agenda</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Agenda</th>
                            <th>Jam Agenda</th>
                            <th>Tanggal Agenda</th>
                            <th>Tempat Agenda</th>
                            <th>Status Agenda</th>
                            <th>Foto Agenda</th>
                            <th width="280px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi oleh DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('gurus.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_agenda',
                        name: 'nama_agenda'
                    },
                    {
                        data: 'jam_agenda',
                        name: 'jam_agenda'
                    },
                    {
                        data: 'tanggal_agenda',
                        name: 'tanggal_agenda'
                    },
                    {
                        data: 'tempat_agenda',
                        name: 'tempat_agenda'
                    },
                    {
                        data: 'status_agenda',
                        name: 'status_agenda'
                    },
                    {
                        data: 'foto_agenda',
                        name: 'foto_agenda'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'guru_image',
                        name: 'guru_image'
                    },
                    {
                        data: 'status_guru',
                        name: 'status_guru'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection