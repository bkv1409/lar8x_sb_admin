@extends('layouts.sb-admin', ['title' => 'Edit Password'])
@section('control-button')
    <a class="btn btn-secondary mr-2" href="{{ route('users.index') }}">
        <i class="fa fa-backward"></i> Back
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body pb-1">
                    {!! Form::model($user, ['method' => 'POST','route' => ['users.update-password', $user->id], 'enctype' => 'multipart/form-data', 'id' => 'edit-form']) !!}

                    <div class="mb-3">
                        <strong>Password:</strong>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                    </div>
                    <div class="mb-3">
                        <strong>Confirm Password:</strong>
                        {!! Form::password('confirm_password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
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
