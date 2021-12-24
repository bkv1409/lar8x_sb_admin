@extends('layouts.sb-admin', ['title' => 'Create User'])
@section('control-button')
    <a class="btn btn-secondary mr-2" href="{{ route('admin.users.index') }}">
        <i class="fa fa-backward"></i> Back
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card card-primary card-outline">

                <!-- /.card-header -->
                <div class="card-body pb-1">
                    {!! Form::open(array('route' => 'admin.users.store','method'=>'POST', 'enctype' => 'multipart/form-data', 'id' => 'create-form')) !!}
                    <div class="mb-2">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                    <div class="mb-2">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                    </div>
                    <div class="mb-2">
                        <strong>Password:</strong>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                    </div>
                    <div class="mb-2">
                        <strong>Confirm Password:</strong>
                        {!! Form::password('confirm_password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                    </div>
                    <div class="mb-2">
                        <strong>Role:</strong>
                        {{--                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}--}}
                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}
                    </div>
                    <div class="mb-2 mt-2">
                        <label for="formFile" class="form-label">Avatar:</label>
                        <input class="form-control" type="file" id="formFile" name="img_link">
                    </div>
                    <div class="mb-2">
                        <strong>Job:</strong>
                        {!! Form::text('job', null, array('placeholder' => 'Job','class' => 'form-control')) !!}
                    </div>
                    <div class="mb-2">
                        <strong>Bio:</strong>
                        {!! Form::textarea('bio', null, array('placeholder' => 'Bio', 'class' => 'form-control', 'rows' => 2)) !!}
                    </div>
                    <div class="mb-2">
                        <strong>Skills:</strong>
                        {!! Form::text('skills', null, array('placeholder' => 'Skills', 'class' => 'form-control')) !!}
                    </div>
                    <div class="mb-2">
                        <strong>Experience:</strong>
                        {!! Form::textarea('experience', null, array('placeholder' => 'Experience', 'class' => 'form-control', 'rows' => 2)) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.end body-->
                <div class="card-footer">
                    <div class="text-center pb-1">
                        <button type="submit" class="btn btn-primary" form="create-form">Submit</button>
                    </div>
                </div>

            </div>
            <!-- /.end card-->

        </div>
        {{--<div class="col-xs-12 col-sm-12 col-md-12 text-center pb-3">
            <button type="submit" class="btn btn-primary" form="create-form">Submit</button>
        </div>--}}


    </div>

@endsection
