@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Data Kesehatan Santri</h2>
            </div>
            @can('kesehatan-create')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('kesehatans.create') }}"> Tambahkan Data Kesehatan Santri</a>
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
            <h3 class="card-title mb-0">Data Kesehatan Santri</h3>
        </div>
        <div class="card-body">
            <!-- Tambahkan div dengan class table-responsive untuk scroll horizontal -->
            <div class="table-responsive">
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
            </div>
        </div>
    </div>
    <!-- End of Card -->

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