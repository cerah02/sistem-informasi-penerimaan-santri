@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Tambah User Baru</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- Card untuk tabel -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Daftar User</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Nomor Telpon</th>
                    <th>Roles</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->nomor_telpon }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <label class="badge badge-success text-dark">{{ $v }}</label>
                                @endforeach
                            @else
                                <span class="text-muted">No roles assigned.</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="card-footer">
            {!! $data->render() !!}
        </div>
    </div>
    <!-- End of Card -->
@endsection
