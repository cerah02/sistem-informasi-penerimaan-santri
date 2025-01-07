@extends('pendaftarans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>List Data Pendaftaran Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('pendaftarans.create') }}"> Tambahkan Data Pendaftaran</a>
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
            <th>Santri Id</th>
            <th>Tanggal Pendaftaran</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($pendaftarans as $pendaftaran)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $pendaftaran->santri_id }}</td>
                <td>{{ $pendaftaran->tanggal_pendaftaran }}</td>
                <td>{{ $pendaftaran->status }}</td>
                <td>
                    <form action="{{ route('pendaftarans.destroy', $pendaftaran->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('pendaftarans.show', $pendaftaran->id) }}">Lihat</a>

                        <a class="btn btn-primary" href="{{ route('pendaftarans.edit', $pendaftaran->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $pendaftarans->links() !!}
@endsection
