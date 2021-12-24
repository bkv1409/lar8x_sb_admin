@extends('layouts.sb-admin', ['title' => 'Create Permission'])
@section('control-button')
    <a class="btn btn-secondary " href="{{ route('admin.permissions.index') }}">
        <i class="fa fa-backward"></i> Back
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card card-primary card-outline">
                <!-- /.card-header -->
                <div class="card-body pb-1">
                    <form id="create-form" method="POST" action="{{ route('admin.permissions.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{ old('name') }}"
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
                                      placeholder="Description" >{{ old('description') }}</textarea>

                        </div>

                    </form>
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
