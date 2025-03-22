@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Hasil Ujian Santri</h2>
            </div>
            @can('ortu-create')
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('hasils.create') }}"> Tambahkan Data Orang Tua Santri</a>
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
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Hasil Ujian Santri</h3>
        </div>
        <div class="card-body">
            <!-- Tambahkan div dengan class table-responsive untuk scroll horizontal -->
            <div class="table-responsive">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Santri</th>
                            <th>Id Ujian</th>
                            <th>Jumlah Soal</th>
                            <th>Jawaban Benar</th>
                            <th>Jawaban Salah</th>
                            <th>Nilai Akhir</th>
                            <th>Status</th>
                            <th>Keterangan</th> 
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
                        data: 'ujian_id',
                        name: 'Ujian_id'
                    },
                    {
                        data: 'jumlah_soal',
                        name: 'jumlah_soal'
                    },
                    {
                        data: 'jawaban_benar',
                        name: 'jawaban_benar'
                    },
                    {
                        data: 'jawaban_salah',
                        name: 'jawaban_salah'
                    },
                    {
                        data: 'nilai_akhir',
                        name: 'nilai_akhir'
                    },
                    {
                        data: 'status_lulus',
                        name: 'status_lulus'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
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