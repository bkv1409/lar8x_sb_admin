@extends('layouts.sb-master')

@section('body')
    <body class="{{empty($staticNav) ? 'sb-nav-fixed' : ''}}">
    @include('inc.navbar')
    <div id="layoutSidenav">
        @include('inc.side-nav')
        <div id="layoutSidenav_content">
            <main id="app">
                @yield('content')
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
