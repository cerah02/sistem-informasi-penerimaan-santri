@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Data Soal</h2>
            </div>
            @can('soal-create')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('soals.create') }}"> Tambahkan Data Soal Santri</a>
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
            <h3 class="card-title">Data Soal</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive"> <!-- Tambahkan div ini untuk skrol horizontal -->
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Ujian</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban A</th>
                            <th>Jawaban B</th>
                            <th>Jawaban C</th>
                            <th>Jawaban D</th>
                            <th>Jawaban E</th>
                            <th>Jawaban Benar</th>
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
                ajax: "{{ route('soals.index') }}",
                scrollX: true, // Tambahkan opsi scrollX
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'ujian_id',
                        name: 'ujian_id'
                    },
                    {
                        data: 'pertanyaan',
                        name: 'pertanyaan'
                    },
                    {
                        data: 'jawaban_a',
                        name: 'jawaban_a'
                    },
                    {
                        data: 'jawaban_b',
                        name: 'jawaban_b'
                    },
                    {
                        data: 'jawaban_c',
                        name: 'jawaban_c'
                    },
                    {
                        data: 'jawaban_d',
                        name: 'jawaban_d'
                    },
                    {
                        data: 'jawaban_e',
                        name: 'jawaban_e'
                    },
                    {
                        data: 'jawaban_benar',
                        name: 'jawaban_benar'
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
