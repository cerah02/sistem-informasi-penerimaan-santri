@extends('bantuans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Data Riwayat Bantuan Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('bantuans.create') }}"> Tambahkan Data Bantuan Santri</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Id Santri</th>
                <th>Nama Bantuan</th>
                <th>Tingkat</th>
                <th>kip</th>
                <th width="280px">Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('bantuans.index') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'santri_id',
                        name: 'santri_id'
                    },
                    {
                        data: 'nama_bantuan',
                        name: 'nama_bantuan'
                    },
                    {
                        data: 'tingkat',
                        name: 'tingkat'
                    },
                    {
                        data: 'no_kip',
                        name: 'no_kip'
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
