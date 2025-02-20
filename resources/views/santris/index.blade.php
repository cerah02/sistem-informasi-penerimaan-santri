@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List Data Santri</h2>
            </div>

            @can('santri-create')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('santris.create') }}"> Tambahkan Data Calon Santri</a>
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
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>NIK</th>
                <th>Asal Sekolah</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Tanggal Lahir</th>
                <th>Kondisi Ekonomi</th>
                <th>Keadaan Orang Tua</th>
                <th>Status Dalam Keluarga</th>
                <th>Tinggal Bersama</th>
                <th>Kewarganegaraan</th>
                <th>Anak Ke-</th>
                <th>Dari</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>Jenjang Pendidikan</th>
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
                ajax: "{{ route('santris.index') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nisn',
                        name: 'nisn'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'asal_sekolah',
                        name: 'asal_sekolah'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: 'ttl',
                        name: 'ttl'
                    },
                    {
                        data: 'kondisi',
                        name: 'kondisi'
                    },
                    {
                        data: 'kondisi_ortu',
                        name: 'kondisi_ortu'
                    },
                    {
                        data: 'status_dkluarga',
                        name: 'status_dkluarga'
                    },
                    {
                        data: 'tempat_tinggal',
                        name: 'tempat_tinggal'
                    },
                    {
                        data: 'kewarganegaraan',
                        name: 'kewarganegaraan'
                    },
                    {
                        data: 'anak_ke',
                        name: 'anak_ke'
                    },
                    {
                        data: 'jumlah_saudara',
                        name: 'jumlah_saudara'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'nomor_telpon',
                        name: 'nomor_telpon'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'jenjang_pendidikan',
                        name: 'jenjang_pendidikan'
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
