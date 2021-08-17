@extends('layouts.apps')

@section('contents')
<main class="py-5">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        @include('layouts.alert')
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="{{url('/')}}"> <h4>{{ config('app.name') }}</h4></a>
                                <h5 class="text-center text-secondary">Agent Email</h5>
                                <form action="/agent-register" method="POST" class="mt-3 mb-3 login-input">
                                    @csrf
                                    <div class="form-group">
                                        <input type="Email" name="email" class="form-control text-center @error('email') is-invalid @enderror" placeholder="Masukan email yang terdaftar">
                                        @error('email')
                                            <span class="invalid-feedback text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn login-form__btn submit w-100">Submit</button>
                                </form>
                                <div class="row">
                                    <div class="col md-12 d-flex justify-content-between">
                                        <p class=" login-form__footer">Buat akun Company <a href="{{ route('register') }}" class="text-primary">Sekarang</a></p>
                                        <p class=" login-form__footer">Daftar <a href="{{ route('distributor.register') }}" class="text-primary">Distributor</a></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col md-12 d-flex justify-content-between">
                                        <p class=" login-form__footer">Punya Akun? <a href="{{route('login')}}" class="text-primary">Login </a> sekarang</p>
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
