@extends('ortus.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 text-center mb-4">
            <h2 class="fw-bold">List Data Orang Tua</h2>
        </div>
        <div class="col-lg-12 d-flex justify-content-end mb-3">
            <a class="btn btn-success btn-lg" href="{{ route('ortus.create') }}">
                <i class="bi bi-person-plus-fill"></i> Tambahkan Data Orang Tua
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
                    <th>Nama Ayah</th>
                    <th>Pendidikan Ayah</th>
                    <th>Pekerjaan Ayah</th>
                    <th>Nama Ibu</th>
                    <th>Pendidikan Ibu</th>
                    <th>Pekerjaan Ibu</th>
                    <th>No Hp</th>
                    <th>Alamat</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ortus as $ortu)
                    <tr>
                        <td class="text-center">{{ ++$i }}</td>
                        <td class="text-center">{{ $ortu->santri_id }}</td>
                        <td>{{ $ortu->nama_ayah }}</td>
                        <td>{{ $ortu->pendidikan_ayah }}</td>
                        <td>{{ $ortu->pekerjaan_ayah }}</td>
                        <td>{{ $ortu->nama_ibu }}</td>
                        <td>{{ $ortu->pendidikan_ibu }}</td>
                        <td>{{ $ortu->pekerjaan_ibu }}</td>
                        <td>{{ $ortu->no_hp }}</td>
                        <td>{{ $ortu->alamat }}</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm mb-1" href="{{ route('ortus.show', $ortu->id) }}">
                                <i class="bi bi-eye-fill"></i> Lihat
                            </a>
                            <a class="btn btn-primary btn-sm mb-1" href="{{ route('ortus.edit', $ortu->id) }}">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('ortus.destroy', $ortu->id) }}" method="POST" style="display: inline-block;">
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
        {!! $ortus->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection
