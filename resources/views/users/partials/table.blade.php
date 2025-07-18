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

<div class="card-footer">
    {!! $data->links() !!}
</div>
