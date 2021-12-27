{{--<a href="#" class="nav-link @if(in_array(Route::currentRouteName(), $childRouteNames)) active @endif">--}}
{{--    <i class="nav-icon {{$icon ?? ' far fa-circle'}}"></i>--}}
{{--    <p>--}}
{{--        {{$title}}--}}
{{--        <i class="right fas fa-angle-left"></i>--}}
{{--    </p>--}}
{{--</a>--}}

<a class="nav-link collapsed @if(in_array(Request::url(), $childRoutes)) active @endif"
   href="#" data-bs-toggle="collapse" data-bs-target="#{{$childId ?? 'collapseIds'}}"
   aria-expanded="false" aria-controls="{{$childId ?? 'collapseIds'}}">
    <div class="sb-nav-link-icon"><i class="{{$icon ?? ' fas fa-columns'}} "></i></div>
    {{$title}}
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
