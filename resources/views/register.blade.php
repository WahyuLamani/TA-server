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
                                    @include('form', ['submit' => 'Sign In'])
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