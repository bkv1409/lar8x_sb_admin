@extends('system-config::layout')
{{--@section('title', $title)--}}
@section('control-button')
    <a class="btn btn-success pl-3" href="{{route('admin.system-configs.create')}}" >
        <i class="fa fa-plus"></i> Tạo mới
    </a>
@endsection

@section('content')
    <div class="row pt-2">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header with-border " >
                    <h3 class="card-title">Tìm kiếm</h3>
                </div>

                <div class="card-body pb-1">
                    <form role="form" action="{{route('admin.system-configs.index')}}" id="search-form">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="name" class="form-label">Tên hiện thị or Key</label>
                                <input class="form-control" id="username" name="search_name" value="{{$name ?? ''}}" type="text" placeholder="Tên hiện thị or Key" />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="start_date" class="form-label">Ngày bắt đầu</label>
                                <input type="date" class="form-control datetimepicker-input"
                                       placeholder="yyyy-mm-dd" name="start_date" value="{{$startDate ?? ''}}"/>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="end_date" class="form-label">Ngày kết thúc</label>
                                <input type="date" class="form-control datetimepicker-input"
                                       placeholder="yyyy-mm-dd" name="end_date" value="{{$endDate ?? ''}}"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" form="search-form"><i class="fa fa-search"></i> Tìm kiếm</button>
                    <button type="button" class="btn btn-secondary clear-ctl"><i class="fa fa-recycle"></i> Reset</button>
                    {{--                        <a class="btn btn-success" href="{{route('admin.system-configs.create')}}"><i class="fa fa-plus"></i> Tạo mới</a>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-3">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title pr-2">{{$title}}</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th width="10%">Key</th>
                            <th width="18%">Display name</th>
                            <th width="17%">Value</th>
                            <th width="5%">Type</th>
                            <th width="10%">Group name</th>
                            <th width="7%">Status</th>
                            <th width="8%">Ngày tạo</th>
                            {{--                                    <th width="5%">Ngày cập nhật</th>--}}
                            <th width="25%">Action</th>
                        </tr>
                        @foreach ($systemConfigs as $systemConfig)
                            @php
                                $label = 'Tắt';
                                $class = 'bg-danger';
                                if ($systemConfig->isEnabled()) {
                                    $label = 'Bật';
                                    $class = 'bg-success';
                                }
                                $id = $systemConfig->id;
                            @endphp
                            <tr>
                                <td>{{$systemConfig->id}}</td>
                                <td>{{$systemConfig->name}}</td>
                                <td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 50px!important;"
                                    title="{{$systemConfig->display_name}}"
                                >{{$systemConfig->display_name}}</td>
                                <td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 50px!important;"
                                    title="{{$systemConfig->value}}"
                                >{{$systemConfig->isEmailGroup()
                                        ? 'encrypted **** see details'
                                        : $systemConfig->value}}</td>
                                <td><span class="badge bg-info">{{Str::upper($systemConfig->type)}}</span></td>
                                <td>{{$systemConfig->group_name}}</td>
                                <td >
                                    <span class="badge {{$class}}">{{$label}}</span>
                                </td>
                                <td>{{format_date($systemConfig->created_at)}}</td>
                                {{--                                        <td>{{format_date($systemConfig->updated_at)}}</td>--}}
                                <td >
                                    <button class="btn btn-warning check-value-ctl btn-sm me-2" data-url="{{route('admin.system-configs.checkValue', $id)}}">
                                        <i class="fa fa-eye"></i> Show Value
                                    </button>
                                    @if(false)
                                        @include('system-config::flat-ctl-btn')
                                    @else
                                        <div class="btn-group btn-group-sm dropstart" role="group">
                                            <button id="btnGroupDropOther" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Other
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDropOther">
                                                @if($systemConfig->isEmailGroup())
                                                    <li>
                                                        <a class="btn btn-default show-config-ctl me-2 btn-sm dropdown-item"
                                                           data-id="{{$id}}" href="{{route('admin.system-configs.show', $id)}}"
                                                        ><i class="fa fa-eye"></i> Show</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a class="btn btn-success edit-config-ctl me-2 btn-sm dropdown-item"
                                                           data-id="{{$id}}" href="{{route('admin.system-configs.edit', $id)}}"
                                                        ><i class="fa fa-edit"></i> Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-info change-config-ctl me-2 btn-sm dropdown-item" data-id="{{$id}}"
                                                           href="{{route('admin.system-configs.changeStatus', $id)}}"
                                                        ><i class="fas fa-recycle"></i> Change Status</a>
                                                    </li>
                                                @endif
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{route('admin.system-configs.destroy', $id)}}" method="POST" class="form-inline me-2">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger delete-config-ctl btn-sm dropdown-item" data-id="{{$id}}" onclick="return confirmDelete('{{$id}}');">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>

                                            </ul>
                                        </div>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="card-footer ">
                    @include('system-config::inc.admin.paginator', ['data' => $systemConfigs])
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Customer -->
    <div class="modal fade" id="valueModalId">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Giá trị cấu hình hệ thống (Runtime)</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="valueFormId">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="sys_name" class="form-label">Tên tham số (key, group)</label>
                                <input class="form-control" id="sys_name" name="sys_name" value="" type="text" disabled/>
                            </div>

                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="sys_value" class="form-label">Giá trị</label>
                                <input class="form-control" id="sys_value" name="sys_value" value="" type="text" disabled/>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@push('js')
    <script type="text/javascript">
        function confirmDelete(id) {
            return confirm(`Bạn có muốn xóa tham số hệ thống này (ID: ${id})?`);
        }

        $( document ).ready(function() {

            $('.clear-ctl').on('click', function () {
                window.location.href = '{{route('admin.system-configs.index')}}'
            })

            $('.check-value-ctl').on('click', function () {
                let requestUrl = $(this).data('url')
                $.ajax({
                    url: requestUrl,
                    method: "GET",
                    success: function (data) {
                        console.log(data);
                        $('#sys_name').val(data.name)
                        $('#sys_value').val(data.value)
                        // $('#valueModalId').modal()
                        let valueModalEl = document.getElementById('valueModalId')
                        if (valueModalEl) {
                            let valueModal = new bootstrap.Modal(valueModalEl)
                            valueModal.show()
                        }
                    }
                });


            })
        })

    </script>
@endpush

