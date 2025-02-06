@extends('ujians.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>List Ujian Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('ujians.create') }}"> Tambahkan Data Ujian</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Ujian</th>
            <th>Jenjang Pendidikan</th>
            <th>kategori</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($ujians as $ujian)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $ujian->nama_ujian }}</td>
                <td>{{ $ujian->jenjang_pendidikan }}</td>
                <td>{{ $ujian->kategori }}</td>
                <td>{{ $ujian->tanggal_mulai }}</td>
                <td>{{ $ujian->tanggal_selesai }}</td>
                <td>{{ $ujian->status }}</td>
                <td>
                    <form action="{{ route('ujians.destroy', $ujian->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('ujians.show', $ujian->id) }}">Lihat</a>

                        <a class="btn btn-primary" href="{{ route('ujians.edit', $ujian->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $ujians->links() !!}
@endsection
