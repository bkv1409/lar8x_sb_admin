@extends('layouts.sb-admin', ['title' => 'Show Role'])
@section('control-button')
    <a class="btn btn-secondary " href="{{ route('admin.roles.index') }}">
        <i class="fa fa-backward"></i> Back
    </a>
    <a class="btn btn-info ms-2" href="{{ route('admin.roles.edit',$role->id) }}">
        <i class="fas fa-pencil-alt"></i> Edit
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body pb-1">
                    <div class="mb-3">
                        <strong>Name:</strong>
                        {{ $role->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Permissions:</strong>
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                                <label class="badge bg-success">{{ $v->name }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
