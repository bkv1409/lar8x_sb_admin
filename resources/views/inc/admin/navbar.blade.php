<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link mt-2" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{--<li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>--}}

        <div class="nav-item content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        {{-- <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="#">Home</a></li>
                             <li class="breadcrumb-item active">{{$title ?? 'Dashboard'}}</li>
                         </ol>--}}
                        {{--                        @yield('breadcrumbs')--}}
{{--                        {{ Breadcrumbs::render() }}--}}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

    </ul>

    <!-- SEARCH FORM -->
    {{--<form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>--}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
{{--        @include('inc.admin.messages-menu')--}}
        <!-- Notifications Dropdown Menu -->
{{--        @include('inc.admin.notifications-menu')--}}
        {{--<li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>--}}
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
{{--                <img src="/adminlte/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">--}}
                <img class="user-image img-circle elevation-2"
                     src="{{ storage_url(data_get(auth()->user(), 'userProfile.img_link', ''))}}"
                     onerror="this.onerror=null;this.src='{{default_avatar()}}';"
                     alt="User Image">
                <span class="d-none d-md-inline">{{auth()->user()->name}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
{{--                    <img src="/adminlte/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">--}}
                    <img class="img-circle elevation-2"
                         src="{{ storage_url(data_get(auth()->user(), 'userProfile.img_link', ''))}}"
                         onerror="this.onerror=null;this.src='{{default_avatar()}}';"
                         alt="User Image">

                    <p>
                        {{data_get(auth()->user(), 'userProfile.job', 'Web Developer')}}
                        <small>Member since {{format_date(auth()->user()->created_at, 'M Y')}}</small>
                    </p>
                </li>
                <!-- Menu Body -->
                {{--<li class="user-body">
                    <div class="row">
                        <div class="col-4 text-center">
                            <a href="#">Followers</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Sales</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Friends</a>
                        </div>
                    </div>
                    <!-- /.row -->
                </li>--}}
                <!-- Menu Footer-->
                <li class="user-footer " >
                    <a href="{{route('admin.profile')}}" class="btn btn-default btn-flat">Profile</a>
                    <form action="{{route('logout')}}" method="POST" class="float-right">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-flat">{{__('Sign out')}}</button>
                    </form>

                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
