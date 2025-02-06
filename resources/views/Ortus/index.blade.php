@extends('ortus.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Data Orang Tua Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('ortus.create') }}"> Tambahkan Data Orang Tua Santri</a>
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
                <th>Nama Ayah</th>
                <th>Pendidikan Ayah</th>
                <th>Pekerjaan Ayah</th>
                <th>Nama Ibu</th>
                <th>Pendidikan Ibu</th>
                <th>Pekerjaan Ibu</th>
                <th>No Hp</th>
                <th>Alamat</th>
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
                ajax: "{{ route('ortus.index') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'santri_id',
                        name: 'santri_id'
                    },
                    {
                        data: 'nama_ayah',
                        name: 'nama_ayah'
                    },
                    {
                        data: 'pendidikan ayah',
                        name: 'pendidikan_ayah'
                    },
                    {
                        data: 'pekerjaan_ayah',
                        name: 'pekerjaan_ayah'
                    },
                    {
                        data: 'nama_ibu',
                        name: 'nama_ibu'
                    },
                    {
                        data: 'pendidikan_ibu',
                        name: 'pendidikan_ibu'
                    },
                    {
                        data: 'pekerjaan_ibu',
                        name: 'pekerjaan_ibu'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
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
