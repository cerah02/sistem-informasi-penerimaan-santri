@extends('pendaftarans.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>List Data Pendaftaran Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('pendaftarans.create') }}"> Tambahkan Data Pendaftaran</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered" id="pendaftaranTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Tanggal Pendaftaran</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
    </table>
    <script>
        $(document).ready(function() {
            $('#pendaftaranTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pendaftarans.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_santri',
                        name: 'nama_santri'
                    },
                    {
                        data: 'tanggal_pendaftaran',
                        name: 'tanggal_pendaftaran'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
