@extends('layouts.sb-master')

@section('body')
    <body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" placeholder="name@example.com" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                                            <label for="inputEmail">Email address</label>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" name="password" type="password" placeholder="Password" required autocomplete="current-password" />
                                            <label for="inputPassword">Password</label>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }} />
                                            <label class="form-check-label" for="remember">{{ __('Remember Password') }}</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            @if (Route::has('password.request'))
                                                <a class="small" href="{{route('password.request')}}">{{ __('Forgot Password?') }}</a>
                                            @endif
                                            <button class="btn btn-primary" type="submit" >{{ __('Login') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="{{route('register')}}">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            @include('inc.footer')
        </div>
    </div>
    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>-->
    <script src="{{asset('js/bootstrap.js')}}"></script>
    </body>
@endsection
