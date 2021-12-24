@if(!empty($fixFooter))
    @include('inc.admin.control-sidebar')

    @include('inc.admin.footer')
@else
    @include('inc.admin.footer')

    @include('inc.admin.control-sidebar')
@endif
