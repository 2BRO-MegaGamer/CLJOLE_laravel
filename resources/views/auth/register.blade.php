@extends('layouts.layout')
@php
    $title = 'Register';
@endphp
@section('content')
<div class="mx-auto rounded-top py-1 my-4"  style="width: 600px; background:rgb(44, 44, 44 ,0.4);border-bottom-left-radius: 35%;border-bottom-right-radius: 35%;">


    <form class="my-4 p-3" action="{{ route('register') }}" method="POST" id="form_singup_asl">
        @csrf
        <h1 class="text-center">sing up page</h1>
        <div class="input-group mb-3">
            <input type="text" autocomplete="off" name="firstName" id="firstname_singup" class="form-control" placeholder="First name" aria-label="first" value="{{ old('firstName') }}">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" autocomplete="off" name="lastName" id="lastname_singup" class="form-control" placeholder="Last name" aria-label="last" value="{{ old('lastName') }}">
        </div>
        <div class="input-group mb-3" id="div_user_IN">

            <span class="input-group-text " id="username_singup_span"><i class="bi bi-person-square"></i></span>
            <input type="text" autocomplete="off" name="UserName" id="username_singup" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="username_singup_span" value="{{ old('UserName') }}">

        </div>

        <div class="input-group mb-3">

            <input type="email" autocomplete="off" name="email" id="email_singup" class="form-control" placeholder="Email address" aria-describedby="emailHelp" value="{{ old('email') }}">
            <span class="input-group-text bg-info border-0" id="text_email">@example.com</span>

        </div>

        <div class=" input-group mb-3">
            <label for="password_0_singup" class="form-label d-block">Password</label>
            <div id="group_pass_eye" class="input-group mb-1">
                <input type="password" name="password" id="password_0_singup" class="form-control" required autocomplete="new-password" >
                <span class="input-group-text btn btn-light text-center"  onclick="show_hide_pass(true,'password_0_singup',this)"><i class="bi bi-eye position-absolute start-50 top-50 translate-middle"></i></span>
            </div>
            <div class="mx-auto p-0 my-0">
                <small style="font-size: 12px;">More than eight digits</small>
            </div>
        </div>
        <div class=" input-group mb-3">
            <label for="password_1_singup" class="form-label">Password check</label>
            <div id="group_pass_eye" class="input-group mb-1">
                <input type="password" name="password_confirmation" id="password_1_singup" class="form-control" required autocomplete="new-password">
                <span class="input-group-text btn btn-light" onclick="show_hide_pass(true,'password_1_singup',this)"><i class="bi bi-eye position-absolute start-50 top-50 translate-middle"></i></span>

            </div>
        </div>
        <div class="input-group mb-5 col-3 mx-auto " style="width: 40%;">
            <label class="input-group-text " for="gender_option_singup">gender</label>
            <select class="form-select " name="gender" id="gender_option_singup" required>
                <option value="" selected>Choose...</option>
                <option value="male">male</option>
                <option value="women">women</option>
                <option value="other">other</option>
            </select>
        </div>

        <div class="d-grid gap-2 col-6 mx-auto">
            <button  class="btn btn-primary" id="logbtn_submit_singup" >sing up</button>
        </div>
    </form>
    <div class="d-grid gap-4 col-2 mx-auto ">
        <button class="btn d-block"><small class="fw-lighter">need help?</small></button>
        <button class="btn d-block"><a class=" nav-link fw-lighter" href="{{ route('login') }}">log in</a></button>
    </div>

</div>
@endsection

















{{-- 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}


