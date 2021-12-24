@extends('layouts.sb-admin', ['title' => 'Editing permission'])
@section('control-button')
    <a class="btn btn-secondary" href="{{ route('admin.permissions.index') }}">
        <i class="fa fa-backward"></i> Back
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body pb-1">
                    <form id="edit-form" method="POST" action="{{ route('admin.permissions.update', $permission->id) }}">
                        @method('patch')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{ $permission->name }}"
                                   type="text"
                                   class="form-control"
                                   name="name"
                                   placeholder="Name" required>

                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description"
                                      placeholder="Description" >{{ $permission->description }}</textarea>

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Guard </label>
                            <div class="form-control">{{$permission->guard_name}}</div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Created At</label>
                            <div class="form-control">{{$permission->created_at}}</div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Updated At</label>
                            <div class="form-control">{{$permission->updated_at}}</div>
                        </div>
                    </form>
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

@endsection


