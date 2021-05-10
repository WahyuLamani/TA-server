@extends('layouts.apps')
@section('contents')
<main class="py-5">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-7">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                
                                    <a class="text-center" href="index.html"> <h4>{{config('app.name')}}</h4></a>
        
                                <form action="{{ route('register') }}" method="POST" class="mt-5 mb-5 login-input" novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control ml-3 @error('company_name') is-invalid @enderror"  placeholder="Company Name" name="company_name" value="{{ old('company_name') }}" required>

                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control ml-3 @error('name') is-invalid @enderror"  placeholder="Your Name" name="name" value="{{ old('name') }}" required>
                                        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror   
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control ml-3 @error('email') is-invalid @enderror"  placeholder="Email" name="email" value="{{ old('email') }}" required>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control ml-3 @error('address') is-invalid @enderror"  placeholder="Company Address" name="address" value="{{ old('address') }}" required>

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control ml-3 @error('telp_num') is-invalid @enderror"  placeholder="Telp.Number" name="telp_num" value="{{ old('telp_num') }}" required>

                                        @error('telp_num')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control ml-3 @error('password') is-invalid @enderror" placeholder="Password" name="password" required>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control ml-3 @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation" required>

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn login-form__btn submit w-100">Sign in</button>
                                </form>
                                    <p class="mt-5 login-form__footer">Have account <a href="{{route('login')}}" class="text-primary">Sign Up </a> now</p>
                                    </p>
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