@extends('layouts.sb-admin', ['title' => 'Activity Logs'])


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Search</h3>

                </div>

                <div class="card-body pt-2 pb-1">
                    <!-- form start -->
                    <form role="form" id="search-form">
                        <div class="row mb-3">
                            <div class="form-group col-md-2">
                                <label for="subject-id">Subject Type</label>
                                <input class="form-control" id="subject-id" name="subject" value="{{$subject ?? ''}}" type="text" placeholder="Tìm theo Subject Type" />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="causer-id">Causer</label>
                                <input class="form-control" id="causer-id" name="causer" value="{{$causer ?? ''}}" type="text" placeholder="Tìm theo tên người thực hiện" />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="description-id">Description</label>
                                <input class="form-control" id="description-id" name="description" value="{{$description ?? ''}}" type="text" placeholder="Tìm theo mô tả" />
                            </div>

                            <div class="form-group col-md-3">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control datetimepicker-input"
                                       placeholder="yyyy-mm-dd" name="start_date" value="{{$startDate ?? ''}}"/>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control datetimepicker-input"
                                       placeholder="yyyy-mm-dd" name="end_date" value="{{$endDate ?? ''}}"/>
                            </div>

                        </div>

                    </form>
                    <!-- form end -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" form="search-form"><i class="fa fa-search"></i> Tìm kiếm</button>
                    <a type="button" class="btn btn-secondary clear-ctl" href="{{route('admin.activity-logs.index')}}"><i class="fa fa-recycle"></i> Reset</a>
                </div>

            </div>
        </div>
    </div>

    <div class="row pt-1">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Activity Logs</h3>
                    <div class="card-tools"></div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 10%;">Subject Type</th>
                            <th style="width: 7%;">Sub. ID</th>
                            <th style="width: 30%;">Description</th>
                            <th>Causer</th>
                            {{--                                <th>Properties</th>--}}
                            <th>Start Date</th>
                            {{--                                <th>Ngày cập nhật</th>--}}
                            <th style="width: 10%;">Action</th>
                        </tr>
                        @php
                            $i = ($data->currentPage() - 1) * $data->perPage();
                        @endphp
                        @foreach ($data as $datum)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$datum->id}}</td>
                                <td>{{$datum->subject_type}}</td>
                                <td>{{data_get($datum, 'subject_id')}}</td>
                                <td title="{{$datum->description}}" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 40px!important;">
                                    {{$datum->description}}
                                </td>
                                <td>{{data_get($datum, 'causer.name')}}</td>
                                {{--                                    <td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{json_encode($datum->properties)}}</td>--}}
                                <td>{{format_date($datum->created_at)}}</td>
                                {{--                                    <td>{{format_date($datum->updated_at)}}</td>--}}

                                <td>
                                    <button type="button" class="btn btn-info detail-ctl"
                                            data-log-id="{{$datum->id}}"
                                            data-log-properties="{{json_encode($datum->properties)}}"

                                            data-log-description="{{$datum->description}}"
                                            data-log-created-at="{{$datum->created_at}}"
                                            data-log-updated-at="{{$datum->updated_at}}"
                                    >
                                        <i class="fa fa-eye"></i>  Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>

                <div class="card-footer ">
                    @include('inc.admin.paginator')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Customer -->
    <div class="modal fade" id="detailModalId" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalToggleLabel">Activity Logs Detail</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form id="exchangeFormId">
                        <input type="hidden" id="log_id" name="log_id">
                        <div class="mb-3">
                            <label for="log_properties_attr">Properties Attribute</label>
                            <textarea class="form-control" id="log_properties_attr" disabled rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="log_properties_old">Properties Old</label>
                            <textarea class="form-control" id="log_properties_old" disabled rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="log_description">Description</label>
                            <textarea class="form-control" id="log_description" disabled rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="log_created_at">Create At</label>
                            <input class="form-control" id="log_created_at" name="log_created_at" value="" type="text" disabled/>
                        </div>
                        <div class="mb-3">
                            <label for="log_updated_at">Updated At</label>
                            <input class="form-control" id="log_updated_at" name="log_updated_at" value="" type="text" disabled/>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection

