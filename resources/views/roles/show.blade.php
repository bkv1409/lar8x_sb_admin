@extends('layouts.adminlte', ['title' => 'Show Role'])
@section('control-button')
    <a class="btn btn-default mr-2" href="{{ route('roles.index') }}">
        <i class="fa fa-backward"></i> Back
    </a>
    <a class="btn btn-info" href="{{ route('roles.edit',$role->id) }}">
        <i class="fas fa-pencil-alt"></i> Edit
    </a>
@endsection

@section('content')
    <div class="container-fluid pt-2">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-body pb-1">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $role->name }}
                        </div>
                        <div class="form-group">
                            <strong>Permissions:</strong>
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <label class="badge badge-success">{{ $v->name }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
