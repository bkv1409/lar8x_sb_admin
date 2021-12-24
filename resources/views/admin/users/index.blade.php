@extends('layouts.sb-admin', ['title' => 'Users Management'])
{{--@section('breadcrumbs', Breadcrumbs::render('dashboard.home-v1'))--}}
@section('control-button')
    <a class="btn btn-success" href="{{ route('admin.users.create') }}">
        <i class="fas fa-plus"></i> Create New User
    </a>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3><i class="fas fa-table me-1"></i>
                    Danh sách users
                </h3>
                @include('inc.admin.search-in-table', ['route' => route('admin.users.index'), 'desc' => 'Search Name or Email'])

            </div>

        </div>
        <div class="card-body table-responsive ">
            <table class="table table-hover text-nowrap ">
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
                                    <label class="badge bg-info">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td class="project-state">
                            @if($user->status === 1)
                                <span class="badge bg-success">ACTIVE</span>
                            @else
                                <span class="badge bg-danger">DISABLED</span>
                            @endif
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info" href="{{ route('admin.users.show',$user->id) }}">
                                <i class="fas fa-folder">
                                </i>
                                Show
                            </a>
                            <a class="btn btn-primary" href="{{ route('admin.users.edit',$user->id) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            {!! Form::open(['method' => 'DELETE','route' => ['admin.users.destroy', $user->id],'style'=>'display:inline']) !!}
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
@endsection
