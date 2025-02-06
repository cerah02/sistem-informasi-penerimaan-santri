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
            <th>NIP</th>
            <th>Jenis Kelamin</th>
            <th>Tempat Tanggal Lahir</th>
            <th>Alamat</th>
            <th>No Telpon</th>
            <th>email</th>
            <th>Foto</th>
            <th>Status Guru</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($gurus as $guru)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $guru->nama }}</td>
                <td>{{ $guru->nip }}</td>
                <td>{{ $guru->jenis_kelamin }}</td>
                <td>{{ $guru->ttl }}</td>
                <td>{{ $guru->alamat }}</td>
                <td>{{ $guru->no_telpon }}</td>
                <td>{{ $guru->email }}</td>
                <td>
                    @if ($guru->foto)
                        @php
                            $fileExtension = strtolower(pathinfo(asset($guru->foto), PATHINFO_EXTENSION));
                        @endphp
                        @if ($fileExtension == 'pdf')
                            <!-- Menampilkan PDF -->
                            <embed src="{{ asset($guru->foto) }}" type="application/pdf" width="200"
                                height="150">
                        @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                            <!-- Menampilkan Gambar -->
                            <img src="{{ asset($guru->foto) }}" alt="Preview" width="200" height="150"
                                style="object-fit: cover;">
                        @elseif (in_array($fileExtension, ['doc', 'docx']))
                            <!-- Tautan untuk mengunduh atau membuka file -->
                            <a href="{{ asset($guru->foto) }}" target="_blank" class="btn btn-primary">
                                <i class="bi bi-file-earmark-word"></i> Unduh & Buka File
                            </a>
                        @else
                            <!-- Pesan untuk file dengan format tidak didukung -->
                            <span class="text-warning">Format file tidak didukung</span>
                        @endif
                        <!-- Tautan untuk mengunduh file -->
                        <a href="{{ asset($guru->foto) }}" target="_blank" class="btn btn-link">Lihat</a>
                    @else
                        <!-- Pesan jika tidak ada file -->
                        <span class="text-danger">Belum ada file</span>
                    @endif
                </td>
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
