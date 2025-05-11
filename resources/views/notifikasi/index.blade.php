@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Notifikasi</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('notifikasi.create') }}">
                    <i class="fas fa-plus"></i> Buat Notifikasi Baru
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Data Notifikasi</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Santri</th>
                            <th>Judul</th>
                            <th>Pesan</th>
                            <th>Status</th>
                            <th>Dikirim</th>
                            <th width="220px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $i => $notif)
                            <tr>
                                <td>{{ $i + $notifications->firstItem() }}</td>
                                <td>{{ $notif->notifiable->name ?? '-' }}</td>
                                <td>{{ $notif->data['title'] ?? '-' }}</td>
                                <td class="text-truncate" style="max-width: 200px;">{{ $notif->data['message'] ?? '-' }}
                                </td>
                                <td>
                                    @if ($notif->read_at)
                                        <span class="badge bg-success">Dibaca</span>
                                    @else
                                        <span class="badge bg-danger">Belum Dibaca</span>
                                    @endif
                                </td>
                                <td>{{ $notif->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('notifikasi.edit', $notif->id) }}"
                                            class="btn btn-primary btn-sm mr-2">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('notifikasi.destroy', $notif->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($notifications->isEmpty())
                <div class="alert alert-info text-center">
                    Tidak ada notifikasi yang tersedia.
                </div>
            @endif
        </div>
    </div>

    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
@endsection
