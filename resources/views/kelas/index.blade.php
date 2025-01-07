@extends('kelas.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>List Daftar Kelas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('kelas.create') }}"> Tambahkan Kelas</a>
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
            <th>Deskripsi</th>
            <th>Nama Guru</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($kelas as $kls)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $kls->nama }}</td>
                <td>{{ $kls->deskripsi }}</td>
                <td>{{ $kls->guru->nama }}</td></td>
                <td>
                    <form action="{{ route('kelas.destroy', $kls->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('kelas.show', $kls->id) }}">Lihat</a>

                        <a class="btn btn-primary" href="{{ route('kelas.edit', $kls->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $kelas->links() !!}
@endsection
