@extends('layouts.apps')
@section('title', 'User Profile')

@section('contents')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Agents</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
            </ol>
        </div>
    </div>
    {{-- this your content --}}
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <img style="width: 180px" src="/storage/{{$agent->thumbnail}}" class="rounded-circle" alt="">
                    <h5 class="mt-3 mb-1">{{$agent->name}}</h5>
                    <p class="m-0">{{$agent->email}}</p>
                    <form action="/agent/delete/{{$agent->id}}" method="post">
                        @csrf
                        @method('delete')
                        <div class="d-flax mt-2">
                            <button class="btn btn-sm btn-warning" type="submit">Delete Agent</button>
                        </div>
                    </form>
                    {{-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- end your content --}}
</div>


@endsection
