@extends('layouts.sb-master')

@section('body')
    <body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('name') is-invalid @enderror" id="inputLastName" type="text"
                                                   placeholder="Enter your name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                            />
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <label for="inputLastName">{{ __('Name') }}</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('email') is-invalid @enderror" id="inputEmail"
                                                   type="email" placeholder="name@example.com"
                                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                            />
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <label for="inputEmail">{{ __('E-Mail Address') }}</label>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control @error('password') is-invalid @enderror"
                                                           id="inputPassword" type="password" placeholder="Create a password"
                                                           name="password" required autocomplete="new-password"
                                                    />
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <label for="inputPassword">{{ __('Password') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm password"
                                                           name="password_confirmation" required autocomplete="new-password"
                                                    />
                                                    <label for="inputPasswordConfirm">{{ __('Confirm Password') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <button class="btn btn-primary btn-block" type="submit" >Create Account</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="{{route('login')}}">Have an account? Go to login</a></div>
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
    {{--    <script src="{{asset('js/app.js')}}"></script>--}}
    <script src="{{asset('js/bootstrap.js')}}"></script>
    </body>
@endsection
