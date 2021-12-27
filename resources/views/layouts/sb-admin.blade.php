@extends('layouts.sb-master')

@section('body')
    <body class="{{empty($staticNav) ? 'sb-nav-fixed' : ''}}">
    @include('inc.navbar')
    <div id="layoutSidenav">
        @include('inc.side-nav')
        <div id="layoutSidenav_content">
            <main id="app">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center mt-3">
                        <h1 class=" ">{{$title ?? 'Title'}}</h1>
                        <div class="ps-3 ms-3 d-flex">
                            @yield('control-button')
                        </div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>

                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item"><a href="{{route('sb-admin-tmp.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{$title ?? 'Title'}}</li>
                    </ol>

                    @include('inc.generic-alert')

                    @yield('content')
                </div>
            </main>
            @include('inc.footer')
        </div>
    </div>
    {{--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>--}}
    <!--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>-->
    {{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>--}}
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/demo.js')}}"></script>

    </body>
@endsection
