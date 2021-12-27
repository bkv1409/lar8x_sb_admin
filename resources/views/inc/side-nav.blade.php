<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion {{empty($light) ? 'sb-sidenav-dark' : 'sb-sidenav-light'}}" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('sb-admin-tmp.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{route('admin.users.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Users
                </a>
                <a class="nav-link" href="{{route('admin.roles.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div>
                    Roles
                </a>
                <a class="nav-link" href="{{route('admin.permissions.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-pencil-ruler"></i></div>
                    Permissions
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Layouts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('sb-admin-tmp.layout-static')}}">Static Navigation</a>
                        <a class="nav-link" href="{{route('sb-admin-tmp.layout-sidenav-light')}}">Light Sidenav</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('sb-admin-tmp.login')}}">Login</a>
                                <a class="nav-link" href="{{route('sb-admin-tmp.register')}}">Register</a>
                                <a class="nav-link" href="{{route('sb-admin-tmp.password')}}">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('sb-admin-tmp.error401')}}">401 Page</a>
                                <a class="nav-link" href="{{route('sb-admin-tmp.error404')}}">404 Page</a>
                                <a class="nav-link" href="{{route('sb-admin-tmp.error500')}}">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="{{route('sb-admin-tmp.charts')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="{{route('sb-admin-tmp.tables')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>
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
