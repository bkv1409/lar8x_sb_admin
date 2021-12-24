@extends('layouts.sb-admin', ['title' => 'Permissions Management'])
{{--@section('breadcrumbs', Breadcrumbs::render('dashboard.home-v1'))--}}
@section('control-button')
    <a class="btn btn-success" href="{{ route('admin.permissions.create') }}">
        <i class="fas fa-plus"></i> Create Permission
    </a>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3><i class="fas fa-table me-1"></i>
                    Danh sách Permissions</h3>
                @include('inc.admin.search-in-table', ['route' => route('admin.permissions.index')])
            </div>

        </div>
        <div class="card-body table-responsive ">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col" width="15%">Name</th>
                    <th scope="col">Guard</th>
                    <th scope="col">Description</th>
                    <th scope="col">Updated At</th>
                    <th scope="col" colspan="2" width="1%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>{{ $permission->updated_at }}</td>
                        <td><a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE','route' => ['admin.permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Bạn có chắc muốn xóa permission này?')"]) !!}
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

