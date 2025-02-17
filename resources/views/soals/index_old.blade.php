@extends('soals.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>List Data Soal</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('soals.create') }}"> Tambahkan Data Soal</a>
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
            <th>Id Ujian</th>
            <th>Pertanyaan</th>
            <th>Jawaban A</th>
            <th>Jawaban B</th>
            <th>Jawaban C</th>
            <th>Jawaban D</th>
            <th>Jawaban E</th>
            <th>Jawaban Yang Benar</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($soals as $soal)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $soal->ujian_id }}</td>
                <td>{{ $soal->pertanyaan }}</td>
                <td>{{ $soal->jawaban_a }}</td>
                <td>{{ $soal->jawaban_b }}</td>
                <td>{{ $soal->jawaban_c }}</td>
                <td>{{ $soal->jawaban_d }}</td>
                <td>{{ $soal->jawaban_e }}</td>
                <td>{{ $soal->jawaban_benar }}</td>
                <td>
                    <form action="{{ route('soals.destroy', $soal->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('soals.show', $soal->id) }}">Lihat</a>

                        <a class="btn btn-primary" href="{{ route('soals.edit', $soal->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $soals->links() !!}
@endsection
