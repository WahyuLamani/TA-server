@extends('layouts.apps')

@section('contents')
<main class="py-5">
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <a class="text-center" href="{{url('/')}}"> <h4>{{ config('app.name') }}</h4></a>
                            <form method="POST" action="{{ route('login') }}" class="mt-5 mb-5 login-input" novalidate>
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control pl-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control pl-3 @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn login-form__btn submit w-100">Sign In</button>
                            </form>
                            <div class="row">
                                <div class="col md-5">
                                    <p class="mt-2 login-form__footer">Dont have account? <a href="{{ route('register') }}" class="text-primary">Sign Up</a> now</p>
                                </div>
                                <div class="col md-7 justify-content-between">
                                    {{-- <p> 
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                    </p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

@endsection
