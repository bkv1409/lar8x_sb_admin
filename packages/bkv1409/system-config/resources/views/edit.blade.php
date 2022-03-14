@extends('system-config::layout')
{{--@section('title', $title)--}}
@section('control-button')
    <a class="btn btn-secondary" href="{{route('admin.system-configs.index')}}">
        <i class="fa fa-backward"></i> Back
    </a>
@endsection

@section('content')
    <div class="row pt-2">
        <!-- left column -->
        <div class="col-md-12">
            <div class="card card-primary card-outline ">
                <div class="card-header with-border">
                    <h3 class="card-title">{{$title}} Id {{$systemConfig->id}}</h3>
                </div>
                <!-- /.card-header -->

                @php
                    $emailConfig = $systemConfig->isEmailGroup();
                @endphp
                <div class="card-body pb-1">
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('admin.system-configs.store', ['id' => empty($systemConfig->id) ? 0 : $systemConfig->id])}}"
                          enctype="multipart/form-data" id="edit-form">
                        @csrf
                        <div class="mb-3">
                            <label for="groupNameInput" class="form-label">Group name</label>
                            <input class="form-control" name="group_name" id="groupNameInput" type="text" value="{{$systemConfig->group_name ?? ''}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Key</label>
                            <input class="form-control" name="name" id="nameInput" placeholder="Key" type="text" value="{{$systemConfig->name ?? ''}}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="displayNameInput" class="form-label">Tên hiện thị</label>
                            <input class="form-control" name="display_name" id="displayNameInput" placeholder="Tên hiển thị"
                                   type="text" value="{{$systemConfig->display_name ?? ''}}" @if ($emailConfig) readonly @endif>
                        </div>
                        <div class="mb-3">
                            @php
                                $typeOfValue = 'text';
                                if (!empty($systemConfig)) {
                                    $typeOfValue = $systemConfig->type;
                                    if ($systemConfig->type == 'boolean') $typeOfValue = 'number';
                                    if ($systemConfig->type == 'datetime') $typeOfValue = 'datetime-local';
                                }
                            @endphp
                            <label for="valueInput" class="form-label">Giá trị</label>
                            @if($typeOfValue == SystemConfig::getConfigTypes()['FILE'])
                                <br />
                                <img id="valuePreviewId" style="max-width: 100%;height: 500px;padding-bottom: 15px;" src="{{Storage::url($systemConfig->value)}}">
                                <br />
                                <input class="form-control" name="value" id="valueInput" placeholder="Giá trị"
                                       type="{{$typeOfValue}}" value="{{$systemConfig->value ?? ''}}" @if ($emailConfig) readonly @endif>
                            @elseif($typeOfValue == SystemConfig::getConfigTypes()['TEXTAREA'])
                                <textarea class="form-control" name="value" id="valueInput" placeholder="Giá trị"
                                          type="{{$typeOfValue}}"  @if ($emailConfig) readonly @endif>{{$systemConfig->value ?? ''}}</textarea>
                            @else
                                <input class="form-control" name="value" id="valueInput" placeholder="Giá trị"
                                       type="{{$typeOfValue}}" value="{{$systemConfig->value ?? ''}}" @if ($emailConfig) readonly @endif>
                            @endif

                        </div>
                        <div class="mb-3">
                            <label for="typeSelectId" class="form-label">Loại dữ liệu</label>
                            <select class="form-control" name="type" id="typeSelectId" @if ($emailConfig) readonly @endif>
                                @foreach(SystemConfig::getConfigTypes() as $key => $value)
                                    <option value="{{$value}}" @if(empty($systemConfig) && $key === 'TEXT' || $value == $systemConfig->type) selected @endif>{{$key}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="createdAtInput" class="form-label">Thời gian tạo</label>
                            <input class="form-control" name="created_at" id="createdAtInput" placeholder="Thời gian tạo" type="text" value="{{$systemConfig->created_at ?? ''}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="updatedAtInput" class="form-label">Thời gian cập nhật</label>
                            <input class="form-control" name="updated_at" id="updatedAtInput" placeholder="Thời gian cập nhật" type="text" value="{{$systemConfig->updated_at ?? ''}}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
{{--                            <label>--}}
{{--                                <input type="hidden" name="status" value="0" >--}}
{{--                                <input type="checkbox" name="status" value="1" @if ($systemConfig->status == 1) checked="checked" @endif data-bootstrap-switch data-off-color="danger" data-on-color="success"> Bật / Tắt--}}
{{--                            </label>--}}
                            <div class="form-check form-switch">
                                <input type="hidden" name="status" value="0" >
                                <input class="form-check-input" type="checkbox" name="status" id="flexSwitchCheckDefault" value="1" @if ($systemConfig->status == 1) checked="checked" @endif>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Bật / Tắt</label>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a class="btn btn-secondary" href="{{route('admin.system-configs.index')}}">Back</a>
                    @if (!$emailConfig)
                        <button type="submit" class="btn btn-primary" form="edit-form">Lưu</button>
                    @endif
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->


@endsection
@push('js')
    <script type="text/javascript">
    </script>
@endpush
