@extends('layouts.sb-admin', ['title' => 'Chi tiet hình hệ thống'])

@section('control-button')
    <a class="btn btn-secondary me-2" href="{{route('admin.system-configs.index')}}">
        <i class="fa fa-backward"></i> Back
    </a>
    <a class="btn btn-success edit-config-ctl me-2"
       data-id="{{$systemConfig->id}}" href="{{route('admin.system-configs.edit', $systemConfig->id)}}">
        <i class="fa fa-edit"></i> Edit
    </a>
@endsection

@section('content')
    <div class="row pt-2">
        <!-- left column -->
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title">{{$title}} Id {{$systemConfig->id}}</h3>
                </div>
                <!-- /.card-header -->
                @php
                    $emailConfig = $systemConfig->group_name === SystemConfig::$EMAIL_GROUP;
                @endphp
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="groupNameInput">Group name</label>
                        <div class="form-control" >{{$systemConfig->group_name ?? ''}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nameInput">Key</label>
                        <div class="form-control" >{{$systemConfig->name ?? ''}}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" >Tên hiện thị</label>
                        <div class="form-control" >{{$systemConfig->display_name ?? ''}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Giá trị</label>
                        <div class="form-control" >{{$systemConfig->value ?? ''}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Loại dữ liệu</label><br/>
                        <span class="badge badge-info">{{Str::upper($systemConfig->type ?? '')}}</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" >Thời gian tạo</label>
                        <div class="form-control"  >{{$systemConfig->created_at ?? ''}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Thời gian cập nhật</label>
                        <div class="form-control">{{$systemConfig->updated_at ?? ''}}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="statusId">Trạng thái</label>
                        <div id="statusId">
                            @if ($systemConfig->status == 1)
                                <span class="badge bg-success">Bật</span>
                            @else
                                <span class="badge bg-danger">Tắt</span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="card-footer">
                    <a class="btn btn-secondary" href="{{route('admin.system-configs.index')}}">Back</a>

                </div>

            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>

    <!-- /.row -->
@endsection
