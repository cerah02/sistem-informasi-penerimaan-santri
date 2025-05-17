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

    <!-- Card untuk tabel -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Jawaban Calon Santri</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive"> <!-- Tambahkan div ini untuk skrol horizontal -->
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th>Status Jawaban</th>
                            <th width="280px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Card -->

    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jawabans.index') }}",
                scrollX: true, // Tambahkan opsi scroll horizontal
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_santri',
                        name: 'santri.nama_lengkap'
                    },
                    {
                        data: 'pertanyaan',
                        name: 'soal.pertanyaan'
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
