@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Data Fasilitas</h2>
            </div>
            @can('fasilitas-create')
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('fasilitas.create') }}"> Tambahkan Data Fasilitas</a>

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
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Fasilitas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Fasilitas</th>>
                            <th>Foto Fasilitas</th>
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
                ajax: "{{ route('fasilitas.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_fasilitas',
                        name: 'nama_fasilitas'
                    },
                    {
                        data: 'foto_fasilitas',
                        name: 'foto_fasilitas'
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