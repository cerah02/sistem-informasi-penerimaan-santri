@extends('bantuans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>List Riwayat Bantuan Calon Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('bantuans.create') }}"> Tambahkan Data</a>
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
            <th>Id_Santri</th>
            <th>Nama Bantuan</th>
            <th>Tingkat</th>
            <th>No KIP</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($bantuans as $bantuan)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $bantuan->santri_id }}</td>
                <td>{{ $bantuan->nama_bantuan }}</td>
                <td>{{ $bantuan->tingkat }}</td>
                <td>{{ $bantuan->no_kip }}</td>
                <td>
                    <form action="{{ route('bantuans.destroy', $bantuan->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('bantuans.show', $bantuan->id) }}">Lihat</a>

                        <a class="btn btn-primary" href="{{ route('bantuans.edit', $bantuan->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $bantuans->links() !!}
@endsection
