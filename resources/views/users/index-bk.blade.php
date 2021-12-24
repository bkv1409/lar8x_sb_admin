@extends('layouts.sb-admin', ['title' => 'Users Management'])
{{--@section('breadcrumbs', Breadcrumbs::render('dashboard.home-v1'))--}}
{{--@section('control-button')
    <a class="btn btn-success" href="{{ route('users.create') }}">
        <i class="fas fa-plus"></i> Create New User
    </a>
@endsection--}}

@section('content')
    <div class="container-fluid">

        @include('inc.alert')

        <div class="row pt-2">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách users</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" >
                                <form action="{{route('users.index')}}" method="GET" class="d-flex">
                                    <input type="text" name="search" class="form-control float-right"
                                           placeholder="Search Name or Email" value="{{$search ?? ''}}">

                                    <div class="input-group-append">
                                        <a class="btn btn-default " href="{{ route('users.index') }}">
                                            <i class="fa fa-recycle"></i>
                                        </a>
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0 ">
                        <table class="table table-hover text-nowrap projects">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th >Avatar</th>
                                <th>Roles</th>
                                <th style="width: 8%" class="text-center">
                                    Status
                                </th>
                                <th width="280px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = ($data->currentPage() - 1) * $data->perPage();
                            @endphp
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(empty(data_get($user, 'userProfile.img_link', '')))
                                            <img alt="Avatar" class="table-avatar" src="{{default_avatar()}}">
                                        @else
                                            <img src="{{Storage::url(data_get($user, 'userProfile.img_link', ''))}}" class="table-avatar" onerror="this.onerror=null;this.src='{{default_avatar()}}';" alt="Avatar" >
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                                <label class="badge badge-info">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="project-state">
                                        @if($user->status === 1)
                                        <span class="badge badge-success">ACTIVE</span>
                                        @else
                                        <span class="badge badge-danger">DISABLED</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Show
                                        </a>
                                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
{{--                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
                                        <button class="btn btn-warning" type="submit" onclick="return confirm('Bạn có chắc muốn đổi trạng thái cho user này?')">
                                            <i class="fas fa-recycle">
                                            </i>
                                            Change Status
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer ">
                        @include('inc.admin.paginator')
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

{{--        {{ $data->links() }}--}}

    </div>

@endsection
