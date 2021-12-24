<a href="#" class="nav-link @if(in_array(Route::currentRouteName(), $childRouteNames)) active @endif">
    <i class="nav-icon {{$icon ?? ' far fa-circle'}}"></i>
    <p>
        {{$title}}
        <i class="right fas fa-angle-left"></i>
    </p>
</a>
