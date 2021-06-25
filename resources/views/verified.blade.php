@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Email verify succesfully !</div>
                <div class="card-body">
                    <p>If you register by company, click <a class="btn btn-link p-0 m-0 align-baseline" href="{{route('handle')}}">Here</a> for Register your Company, else if you login by agents, return in aplication, thank you!@@</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
