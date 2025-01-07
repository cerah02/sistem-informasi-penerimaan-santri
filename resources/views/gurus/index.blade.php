@extends('gurus.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>List Guru-Guru</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('gurus.create') }}"> Tambahkan Data Guru</a>
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
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>NIP</th>
            <th>email</th>
            <th>Status Guru</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($gurus as $guru)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $guru->nama }}</td>
                <td>{{ $guru->jenis_kelamin }}</td>
                <td>{{ $guru->alamat }}</td>
                <td>{{ $guru->nip }}</td>
                <td>{{ $guru->email }}</td>
                <td>{{ $guru->status_guru }}</td>
                <td>
                    <form action="{{ route('gurus.destroy', $guru->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('gurus.show', $guru->id) }}">Lihat</a>

                        <a class="btn btn-primary" href="{{ route('gurus.edit', $guru->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $gurus->links() !!}
@endsection
