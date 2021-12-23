@extends('layouts.sb-master')

@section('body')
    <body>
    <div id="layoutError">
        <div id="layoutError_content">
            <main>
                @yield('content')
            </main>
        </div>
        <div id="layoutError_footer">
            <!--            <footer class="py-4 bg-light mt-auto">
                            <div class="container-fluid px-4">
                                <div class="d-flex align-items-center justify-content-between small">
                                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                                    <div>
                                        <a href="#">Privacy Policy</a>
                                        &middot;
                                        <a href="#">Terms &amp; Conditions</a>
                                    </div>
                                </div>
                            </div>
                        </footer>-->
            @include('inc.footer')
        </div>
    </div>
    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>-->
    <script src="{{asset('js/bootstrap.js')}}"></script>
    </body>
@endsection

