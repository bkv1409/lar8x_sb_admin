<li class="nav-item">
    <a href="{{route($routeName)}}" class="nav-link @if(Route::currentRouteName() == $routeName) active @endif">
        <i class="nav-icon {{$icon ?? ' fas fa-tools'}}"></i>
        <p>{{$title}}</p>
    </a>
</li>
