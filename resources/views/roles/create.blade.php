@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Role Information</h4>
    </div>
    
    <div class="card-body">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label fw-bold">Role Name</label>
                    {!! Form::text('name', null, array(
                        'placeholder' => 'Enter role name',
                        'class' => 'form-control form-control-lg',
                        'autofocus' => 'autofocus'
                    )) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group mb-4">
                    <label class="form-label fw-bold">Permissions</label>
                    <div class="row">
                        @foreach($permission as $value)
                        <div class="col-md-3 col-sm-4 col-6 mb-3">
                            <div class="form-check">
                                {{ Form::checkbox('permission[]', $value->name, false, array(
                                    'class' => 'form-check-input',
                                    'id' => 'permission-'.$value->id
                                )) }}
                                <label class="form-check-label" for="permission-{{ $value->id }}">
                                    {{ $value->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer bg-light">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-save me-2"></i>Submit
            </button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection