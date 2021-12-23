@extends('layouts.sb-error')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mt-4">
                    <h1 class="display-1">500</h1>
                    <p class="lead">Internal Server Error</p>
                    <a href="{{route('sb-admin-tmp.index')}}">
                        <i class="fas fa-arrow-left me-1"></i>
                        Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
