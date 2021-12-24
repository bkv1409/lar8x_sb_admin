<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info1" id="example2_info" role="status" aria-live="polite">
            Showing {{$data->firstItem()}} to {{$data->lastItem()}} of <span class="badge badge-info">{{number_format($data->total())}}</span>
            entries
        </div>
    </div>

    <div class="col-sm-12 col-md-7 d-flex justify-content-end">
        @if(!empty($data) && $data->hasPages())
            <div class="dataTables_paginate1 paging_simple_numbers" id="example2_paginate">
                <ul class="pagination">
                    <li class="paginate_button page-item previous" id="example2_previous">
                        <a href="{{ $data->previousPageUrl() }}"
                           aria-controls="example2"
                           data-dt-idx="0"
                           tabindex="0"
                           class="page-link"
                           @if($data->currentPage() == 1) disabled onclick="return false;" @endif
                        >
                            Previous
                        </a>
                    </li>
                    @for($i = 1; $i <= $data->lastPage() ; $i++)
                        @if($data->lastPage() >= 2)
                            <li class="paginate_button page-item @if($data->currentPage() == $i) active @endif">
                                <a href="{{ $data->url($i) }}" aria-controls="example2"
                                   data-dt-idx="{{$i}}"
                                   tabindex="0" class="page-link">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor

                    <li class="paginate_button page-item next" id="example2_next">
                        <a href="{{ $data->nextPageUrl() }}"
                           aria-controls="example2"
                           data-dt-idx="7" tabindex="0"
                           class="page-link"
                           @if($data->currentPage() == $data->lastPage()) disabled onclick="return false;" @endif
                        >Next
                        </a>
                    </li>
                </ul>
            </div>
        @endif

    </div>
</div>
