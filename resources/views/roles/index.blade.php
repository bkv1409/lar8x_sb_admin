@extends('layouts.adminlte')
@section('control-button')
    @can('role-create')
        <a class="btn btn-success" href="{{ route('roles.create') }}">
            <i class="fas fa-plus"></i> Create New Role
        </a>
    @endcan
@endsection

@section('content')
    <div class="container-fluid pt-2">

        @include('inc.alert')

        <div class="row pt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sach role</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" >
                                <form action="{{route('roles.index')}}" method="GET" class="d-flex">
                                    <input type="text" name="search" class="form-control float-right"
                                           placeholder="Search by Name" value="{{$search ?? ''}}">

                                    <div class="input-group-append">
                                        <a class="btn btn-default " href="{{ route('roles.index') }}">
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
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Role ID</th>
                                <th>Name</th>
                                <th width="280px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = ($roles->currentPage() - 1) * $roles->perPage();
                            @endphp
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Show
                                        </a>
                                        @can('role-edit')
                                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                        @endcan
                                        @can('role-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
{{--                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
                                            <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn có chắc muốn xóa Role này?')">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </button>
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer ">
                        @include('inc.admin.paginator', ['data' => $roles])
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </div>

{{--        {{ $roles->links() }}--}}
    </div>
@endsection
