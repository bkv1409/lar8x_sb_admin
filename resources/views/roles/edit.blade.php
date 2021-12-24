@extends('layouts.adminlte', ['title' => 'Edit Role'])
@section('control-button')
    <a class="btn btn-default mr-2" href="{{ route('roles.index') }}">
        <i class="fa fa-backward"></i> Back
    </a>
@endsection

@section('content')
    <div class="container-fluid pt-2">

        @include('inc.errors')

        {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-body pb-1">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br/>
                            @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                    {{ $value->name }}</label>
                                <br/>
                            @endforeach
                        </div>
                    </div>
                    <!-- /. card-body -->
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>

@endsection
