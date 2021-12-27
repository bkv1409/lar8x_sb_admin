{{--<li class="nav-item">--}}
{{--    <a href="{{route($routeName)}}" class="nav-link @if(Route::currentRouteName() == $routeName) active @endif">--}}
{{--        <i class="nav-icon {{$icon ?? ' fas fa-tools'}}"></i>--}}
{{--        <p>{{$title}}</p>--}}
{{--    </a>--}}
{{--</li>--}}

<a class="nav-link @if(Request::url() == $route) active @endif" href="{{$route ?? '#!@!'}}">
    <div class="sb-nav-link-icon"><i class="{{$icon ?? ' fas fa-tools'}}"></i></div>
    {{$title}}
</a>
