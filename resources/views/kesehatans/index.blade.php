@extends('kesehatans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Data kesehatan Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('kesehatans.create') }}"> Tambahkan Data kesehatan Santri</a>
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
                <th>Golongan Darah</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>Riwayat Penyakit</th>
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
                ajax: "{{ route('kesehatans.index') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'santri_id',
                        name: 'santri_id'
                    },
                    {
                        data: 'golongan_darah',
                        name: 'golongan_darah'
                    },
                    {
                        data: 'tb',
                        name: 'tb'
                    },
                    {
                        data: 'bb',
                        name: 'bb'
                    },
                    {
                        data: 'riwayat_penyakit',
                        name: 'riwayat_penyakit'
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
