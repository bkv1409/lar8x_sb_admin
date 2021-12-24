<div class="row">
    <div class="col-md-6 pb-1 my-1" role="status" aria-live="polite">
        Showing {{$data->firstItem() ?? 0}} to {{$data->lastItem() ?? 0}} of <span class="badge bg-info">{{number_format($data->total())}}</span>
        entries
    </div>
    <ul class="col-md-6 pagination m-0 d-flex justify-content-end ">
{{--        {{ $data->appends($_GET)->links() }}--}}
        {{ $data->appends($_GET)->links('inc.mobile-paginator') }}
    </ul>
</div>
