@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Data Jawaban Calon Santri</h2>
            </div>
            @can('jawaban-create')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('jawabans.create') }}"> Tambahkan Data Jawaban Calon Santri</a>
                </div>
            @endcan
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
                <th>Id Soal</th>
                <th>Jawaban</th>
                <th>Status Jawaban</th>
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
                ajax: "{{ route('jawabans.index') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'santri_id',
                        name: 'santri_id'
                    },
                    {
                        data: 'soal_id',
                        name: 'soal_id'
                    },
                    {
                        data: 'jawaban',
                        name: 'jawaban'
                    },
                    {
                        data: 'status_jawaban',
                        name: 'status_jawaban'
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
