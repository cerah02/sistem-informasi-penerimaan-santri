@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Hasil Ujian Santri</h2>
            </div>
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
                            <th>Nama Santri</th>
                            <th>Nama_Ujian</th>
                            <th>Jumlah Soal</th>
                            <th>Jawaban Benar</th>
                            <th>Jawaban Salah</th>
                            <th>Total Nilai Kategori</th>
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
                ajax: "{{ route('hasils.index') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_santri',
                        name: 'santri.nama_lengkap'
                    },
                    {
                        data: 'nama_ujian',
                        name: 'ujian.nama_ujian'
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
                        data: 'total_nilai_kategori',
                        name: 'total_nilai_kategori'
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
