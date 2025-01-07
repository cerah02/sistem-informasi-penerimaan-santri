@extends('kesehatans.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 text-center mb-4">
            <h2 class="fw-bold">List Data Kesehatan Santri</h2>
        </div>
        <div class="col-lg-12 d-flex justify-content-end mb-3">
            <a class="btn btn-success btn-lg" href="{{ route('kesehatans.create') }}">
                <i class="bi bi-person-plus-fill"></i> Tambahkan Data Kesehatan
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Id Santri</th>
                    <th>Golongan Darah</th>
                    <th>Tinggi Badan</th>
                    <th>Berat Badan</th>
                    <th>Riwayat Penyakit</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kesehatans as $kesehatan)
                    <tr>
                        <td class="text-center">{{ ++$i }}</td>
                        <td class="text-center">{{ $kesehatan->santri_id }}</td>
                        <td>{{ $kesehatan->golongan_darah }}</td>
                        <td>{{ $kesehatan->tb }}</td>
                        <td>{{ $kesehatan->bb }}</td>
                        <td>{{ $kesehatan->riwayat_penyakit }}</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm mb-1" href="{{ route('kesehatans.show', $kesehatan->id) }}">
                                <i class="bi bi-eye-fill"></i> Lihat
                            </a>
                            <a class="btn btn-primary btn-sm mb-1" href="{{ route('kesehatans.edit', $kesehatan->id) }}">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('kesehatans.destroy', $kesehatan->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $kesehatans->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection
