@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Show Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Role Details</h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group mb-4">
                    <label class="form-label fw-bold">Role Name</label>
                    <div class="p-3 bg-light rounded">
                        {{ $role->name }}
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group mb-4">
                    <label class="form-label fw-bold">Permissions</label>
                    <div class="p-3 bg-light rounded">
                        @if(!empty($rolePermissions))
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($rolePermissions as $v)
                                    <span class="badge bg-success fs-6">{{ $v->name }}</span>
                                @endforeach
                            </div>
                        @else
                            <span class="text-muted">No permissions assigned.</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer bg-light">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-lg px-5">
                <i class="fas fa-edit me-2"></i>Edit Role
            </a>
        </div>
    </div>
</div>
@endsection