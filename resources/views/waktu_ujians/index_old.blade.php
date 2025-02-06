@extends('waktu_ujians.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>List Data waktu ujian</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('waktu_ujians.create') }}"> Tambahkan Data waktu_ujian</a>
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
            <th>ID Santri</th>
            <th>Waktu Mulai</th>
            <th>Waktu Selesai</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($waktu_ujians as $waktu_ujian)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $waktu_ujian->santri_id}}</td>
                <td>{{ $waktu_ujian->waktu_mulai }}</td>
                <td>{{ $waktu_ujian->waktu_selesai }}</td>
                <td>
                    <form action="{{ route('waktu_ujians.destroy', $waktu_ujian->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('waktu_ujians.show', $waktu_ujian->id) }}">Lihat</a>

                        <a class="btn btn-primary" href="{{ route('waktu_ujians.edit', $waktu_ujian->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $waktu_ujians->links() !!}
@endsection
