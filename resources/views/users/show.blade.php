@extends('layouts.sb-admin', ['title' => 'Show User'])
@section('control-button')
    <a class="btn btn-secondary " href="{{ route('users.index') }}">
        <i class="fa fa-backward"></i> Back
    </a>
    <a class="btn btn-primary ms-2" href="{{ route('users.edit', ['user' => $user]) }}">
        <i class="fas fa-pencil-alt"></i> Edit
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body pb-1">
                    <div class="mb-2">
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                    <div class="mb-2">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                    <div class="mb-2">
                        <strong>Roles:</strong>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <label class="badge bg-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </div>
                    @if(!empty($userProfile))
                        <div class="mb-2">
                            <strong>Avatar:</strong>
                            <div class="input-group pb-2">
                                <img src="{{Storage::url($userProfile->img_link)}}" class="user-image img-circle elevation-2" alt="User Image"
                                     style="max-width: 20%; height: auto"
                                >
                            </div>
                        </div>
                        <div class="mb-2">
                            <strong>Job:</strong>
                            {{ $userProfile->job }}
                        </div>
                        <div class="mb-2">
                            <strong>Skills:</strong>
                            {{ $userProfile->skills }}
                        </div>
                        <div class="mb-2">
                            <strong>Experience:</strong>
                            {{ $userProfile->experience }}
                        </div>
                        <div class="mb-2">
                            <strong>Bio:</strong>
                            {{ $userProfile->bio }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
