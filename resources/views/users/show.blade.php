@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>User Details</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="card-title mb-0">User Information</h4>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Name:</strong>
                    <p class="form-control-static">{{ $user->name }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Email:</strong>
                    <p class="form-control-static">{{ $user->email }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Roles:</strong>
                    <div class="mt-2">
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <span class="badge badge-pill badge-success">{{ $v }}</span>
                            @endforeach
                        @else
                            <span class="badge badge-pill badge-secondary">No roles assigned</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection