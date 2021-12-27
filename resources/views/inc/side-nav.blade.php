<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion {{empty($light) ? 'sb-sidenav-dark' : 'sb-sidenav-light'}}" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
{{--                <a class="nav-link active" href="{{route('home')}}">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>--}}
{{--                    Dashboard--}}
{{--                </a>--}}
{{--                {{Request::url()}}--}}
                @include('inc.admin.menu-item', ['route' => route('home'), 'title' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt'])
{{--                <a class="nav-link" href="{{route('admin.users.index')}}">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>--}}
{{--                    Users--}}
{{--                </a>--}}
                @include('inc.admin.menu-item', ['route' => route('admin.users.index'), 'title' => 'Users', 'icon' => 'fas fa-user'])
{{--                <a class="nav-link" href="{{route('admin.roles.index')}}">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div>--}}
{{--                    Roles--}}
{{--                </a>--}}
                @include('inc.admin.menu-item', ['route' => route('admin.roles.index'), 'title' => 'Roles', 'icon' => 'fas fa-user-shield'])
{{--                <a class="nav-link" href="{{route('admin.permissions.index')}}">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-pencil-ruler"></i></div>--}}
{{--                    Permissions--}}
{{--                </a>--}}
                @include('inc.admin.menu-item', ['route' => route('admin.permissions.index'), 'title' => 'Permissions', 'icon' => 'fas fa-pencil-ruler'])
                <div class="sb-sidenav-menu-heading">Interface</div>
{{--                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>--}}
{{--                    Layouts--}}
{{--                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
{{--                </a>--}}
                @include('inc.admin.menu-item-parent', [
                    'childRoutes' => [
                        route('sb-admin-tmp.layout-static'),
                        route('sb-admin-tmp.layout-sidenav-light')
                    ],
                    'icon' => 'fas fa-columns',
                    'title' => 'Layouts',
                    'childId' => 'collapseLayouts',
                ])
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
{{--                        <a class="nav-link" href="{{route('sb-admin-tmp.layout-static')}}">Static Navigation</a>--}}
{{--                        <a class="nav-link" href="{{route('sb-admin-tmp.layout-sidenav-light')}}">Light Sidenav</a>--}}
                        @include('inc.admin.menu-item', ['route' => route('sb-admin-tmp.layout-static'), 'title' => 'Static Navigation'])
                        @include('inc.admin.menu-item', ['route' => route('sb-admin-tmp.layout-sidenav-light'), 'title' => 'Light Sidenav'])
                    </nav>
                </div>
{{--                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>--}}
{{--                    Pages--}}
{{--                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
{{--                </a>--}}
                @include('inc.admin.menu-item-parent', [
                    'childRoutes' => [
                        route('sb-admin-tmp.login'),
                        route('sb-admin-tmp.register'),
                        route('sb-admin-tmp.password'),
                        route('sb-admin-tmp.error401'),
                        route('sb-admin-tmp.error404'),
                        route('sb-admin-tmp.error500'),
                    ],
                    'icon' => 'fas fa-book-open',
                    'title' => 'Pages',
                    'childId' => 'collapsePages',
                ])
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
{{--                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">--}}
{{--                            Authentication--}}
{{--                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
{{--                        </a>--}}
                        @include('inc.admin.menu-item-parent', [
                            'childRoutes' => [
                                route('sb-admin-tmp.login'),
                                route('sb-admin-tmp.register'),
                                route('sb-admin-tmp.password'),
                            ],
                            'icon' => 'fas fa-users',
                            'title' => 'Authentication',
                            'childId' => 'pagesCollapseAuth',
                        ])
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
{{--                                <a class="nav-link" href="{{route('sb-admin-tmp.login')}}">Login</a>--}}
{{--                                <a class="nav-link" href="{{route('sb-admin-tmp.register')}}">Register</a>--}}
{{--                                <a class="nav-link" href="{{route('sb-admin-tmp.password')}}">Forgot Password</a>--}}
                                @include('inc.admin.menu-item', ['route' => route('sb-admin-tmp.login'), 'title' => 'Login', 'icon' => 't'])
                                @include('inc.admin.menu-item', ['route' => route('sb-admin-tmp.register'), 'title' => 'Register', 'icon' => 't'])
                                @include('inc.admin.menu-item', ['route' => route('sb-admin-tmp.password'), 'title' => 'Forgot Password', 'icon' => 't'])
                            </nav>
                        </div>
{{--                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">--}}
{{--                            Error--}}
{{--                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down "></i></div>--}}
{{--                        </a>--}}
                        @include('inc.admin.menu-item-parent', [
                            'childRoutes' => [
                                route('sb-admin-tmp.error401'),
                                route('sb-admin-tmp.error404'),
                                route('sb-admin-tmp.error500'),
                            ],
                            'icon' => 'fas fa-page4',
                            'title' => 'Error',
                            'childId' => 'pagesCollapseError',
                        ])
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
{{--                                <a class="nav-link" href="{{route('sb-admin-tmp.error401')}}">401 Page</a>--}}
{{--                                <a class="nav-link" href="{{route('sb-admin-tmp.error404')}}">404 Page</a>--}}
{{--                                <a class="nav-link" href="{{route('sb-admin-tmp.error500')}}">500 Page</a>--}}
                                @include('inc.admin.menu-item', ['route' => route('sb-admin-tmp.error401'), 'title' => '401 Page', 'icon' => 't'])
                                @include('inc.admin.menu-item', ['route' => route('sb-admin-tmp.error404'), 'title' => '404 Page', 'icon' => 't'])
                                @include('inc.admin.menu-item', ['route' => route('sb-admin-tmp.error500'), 'title' => '500 Page', 'icon' => 't'])
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
{{--                <a class="nav-link" href="{{route('sb-admin-tmp.charts')}}">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>--}}
{{--                    Chart.js--}}
{{--                </a>--}}
                @include('inc.admin.menu-item', ['route' => route('sb-admin-tmp.charts'), 'title' => 'Chart.js', 'icon' => 'fas fa-chart-area'])
{{--                <a class="nav-link" href="{{route('sb-admin-tmp.tables')}}">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>--}}
{{--                    Simple Datatables--}}
{{--                </a>--}}
                @include('inc.admin.menu-item', ['route' => route('sb-admin-tmp.tables'), 'title' => 'Simple Datatables', 'icon' => 'fas fa-table'])
{{--                <a class="nav-link" href="{{route('home-vue')}}">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fab fa-vuejs"></i></div>--}}
{{--                    Vuejs Example--}}
{{--                </a>--}}
                @include('inc.admin.menu-item', ['route' => route('home-vue'), 'title' => 'Vuejs Example', 'icon' => 'fab fa-vuejs'])
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <div class="mt-2">
                <img class="table-avatar "
                     src="{{ storage_url(data_get(auth()->user(), 'userProfile.img_link', ''))}}"
                     onerror="this.onerror=null;this.src='{{default_avatar()}}';"
                     alt="User Image">
                {{auth()->user()->name ?? 'Start Bootstrap'}}
            </div>

        </div>
    </nav>
</div>
