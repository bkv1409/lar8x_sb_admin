@extends('system-config::layout')

@section('control-button')
    <a class="btn btn-secondary" href="{{route('admin.system-configs.index')}}">
        <i class="fa fa-backward"></i> Back
    </a>
@endsection

@section('content')
    <div class="row pt-2">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body pb-1">
                    <!-- form start -->
                    <form id="create-form" role="form" method="POST" action="{{route('admin.system-configs.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="groupNameInput">Group name</label>
                            <input class="form-control" name="group_name" id="groupNameInput" placeholder="Group name" type="text" value="{{old('group_name') ?? ''}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="nameInput">Key</label>
                            <input class="form-control" name="name" id="nameInput" placeholder="Key" type="text" value="{{old('name') ?? ''}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="displayNameInput">Tên hiện thị</label>
                            <input class="form-control" name="display_name" id="displayNameInput" placeholder="Tên hiển thị" type="text" value="{{old('display_name') ?? ''}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="valueInput">Giá trị</label>
                            <input class="form-control" name="value" id="valueInput" placeholder="Giá trị" type="text" value="{{old('value') ?? ''}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="typeSelectId">Loại dữ liệu</label>
                            <select class="form-control" name="type" id="typeSelectId">
                                @foreach(SystemConfig::getConfigTypes() as $key => $value)
                                    <option value="{{$value}}" @if($key == 'TEXT') selected @endif>{{$key}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label> <br/>
                            <div class="form-check form-switch ">
                                <input type="hidden" name="status" value="0" >
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" value="{{old('status') ?? 1}}" @if(empty(old('status')) || old('status') == 1) checked @endif >
                                <label class="form-check-label" for="flexSwitchCheckDefault">Bật / Tắt</label>
                            </div>
                        </div>
                    </form>
                    <!-- /.form -->
                </div>
                <!-- /.box-body -->

                <div class="card-footer">
                    <a type="button" class="btn btn-default" href="{{route('admin.system-configs.index')}}">Back</a>
                    <button type="submit" class="btn btn-primary" form="create-form">Lưu</button>
                </div>


            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
@endsection
@push('js')
    <script type="text/javascript">
    </script>
@endpush
