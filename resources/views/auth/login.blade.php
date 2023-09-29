@extends('layouts.layout')
@php
    $title = 'login';
@endphp
@section('content')

<div class="mx-auto rounded-top py-1 my-4" id="div_first_kol" style="width: 30rem; background:rgb(44, 44, 44 ,0.4);border-bottom-left-radius: 50%;border-bottom-right-radius: 50%;">
    <form class=" mx-auto my-4 p-3" action="{{ route('login') }}"  method="POST" id="form_login_asl">
        @csrf

      <h1 class="text-center">log in page</h1>


      <div class="mb-3" id="error_div">
        <label for="email_login" class=" form-label ">{{ __('Email Address') }}</label>

        <input type="email" autocomplete="off" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus id="email_login" class="form-control @error('email') is-invalid @enderror" placeholder="email" aria-describedby="emailHelp">


        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
      </div>
      <div class="mb-3 ">
        <label for="password_login" class="form-label">Password</label>
        <div id="group_pass_eye" class="input-group mb-1">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password_login" >
            <span class="input-group-text btn btn-light" onclick="show_hide_pass(true,'password_login',this)"><i class="bi bi-eye"></i></span>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6 offset-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
    </div>




      <div class="d-grid gap-2 col-6 mx-auto">
        <button type="submit" id="btn_sub_err" class="btn btn-primary" disabled>{{ __('Login') }}</button>
      </div>
    </form>
    <div class="d-grid gap-6 col-3 mx-auto my-2">
        <a  href="{{ route('password.request') }}" class="btn d-block"><small class="fw-lighter">Forgot Your Password?</small></a>
        <button class="btn d-block"><a class=" nav-link fw-lighter" href="{{ route('register') }}">sing up</a></button>
    </div>


    </div>

    <script src="/js/login.js"></script>

@endsection








{{-- 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}








