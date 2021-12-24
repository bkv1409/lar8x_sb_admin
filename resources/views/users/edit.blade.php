@extends('layouts.sb-admin', ['title' => 'Edit User'])
@section('control-button')
    <a class="btn btn-secondary " href="{{ route('users.index') }}">
        <i class="fa fa-backward"></i> Back
    </a>

    <a class="btn btn-primary ms-2" href="{{ route('users.edit-password', $user) }}">
        <i class="fa fa-pen"></i> Edit Password
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body pb-1">
                    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], 'enctype' => 'multipart/form-data', 'id' => 'edit-form']) !!}
                    <div class="mb-2">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                    <div class="mb-2">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                    </div>
                    {{--<div class="mb-2">
                        <strong>Password:</strong>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                    </div>
                    <div class="mb-2">
                        <strong>Confirm Password:</strong>
                        {!! Form::password('confirm_password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                    </div>--}}
                    <div class="mb-2">
                        <strong>Role:</strong>
                        {{--                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}--}}
                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control')) !!}
                    </div>



                    @if(data_get($userProfile, 'img_link', ''))
                        <div class="mb-2">
                            <label for="exampleInputFile">Avatar:</label>
                            <div class="input-group pb-3">
                                <img src="{{Storage::url(data_get($userProfile, 'img_link', ''))}}"
                                     class="user-image img-circle elevation-2 img-thumbnail img-fluid" alt="User Image"
                                     style="max-width: 20%; height: auto">
                            </div>
                        </div>
                    @else
                        <div class="mb-2 mt-2">
                            <label for="formFile" class="form-label">Avatar:</label>
                            <input class="form-control" type="file" id="formFile" name="img_link">
                        </div>
                    @endif

                    <div class="mb-2">
                        <strong>Job:</strong>
                        {!! Form::text('job', data_get($userProfile, 'job'), array('placeholder' => 'Job','class' => 'form-control')) !!}
                    </div>
                    <div class="mb-2">
                        <strong>Bio:</strong>
                        {!! Form::textarea('bio', data_get($userProfile, 'bio'), array('placeholder' => 'Bio','class' => 'form-control', 'rows' => 2)) !!}
                    </div>
                    <div class="mb-2">
                        <strong>Skills:</strong>
                        {!! Form::text('skills', data_get($userProfile, 'skills'), array('placeholder' => 'Skills','class' => 'form-control')) !!}
                    </div>

                    <div class="mb-2">
                        <strong>Experience:</strong>
                        {!! Form::textarea('experience', data_get($userProfile, 'experience'), array('placeholder' => 'Experience','class' => 'form-control', 'rows' => 2)) !!}
                    </div>
                </div>
                <!-- /.end body-->
                <div class="card-footer">
                    <div class="text-center pb-1">
                        <button type="submit" class="btn btn-primary" form="edit-form">Submit</button>
                    </div>
                </div>
                <!-- /.end footer-->
            </div>
            <!-- /.card -->
        </div>

    </div>
    {!! Form::close() !!}

@endsection
