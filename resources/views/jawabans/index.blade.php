@extends('jawabans.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>List Data Jawaban</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('jawabans.create') }}"> Tambahkan Data Jawaban</a>
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
            <th>Soal id</th>
            <th>Jawaban</th>
            <th>Status Jawaban</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($jawabans as $jawaban)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $jawaban->santri_id }}</td>
                <td>{{ $jawaban->soal_id }}</td>
                <td>{{ $jawaban->jawaban }}</td>
                <td>{{ $jawaban->status_jawaban }}</td>
                <td>
                    <form action="{{ route('jawabans.destroy', $jawaban->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('jawabans.show', $jawaban->id) }}">Lihat</a>

                        <a class="btn btn-primary" href="{{ route('jawabans.edit', $jawaban->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $jawabans->links() !!}
@endsection
