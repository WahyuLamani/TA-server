@extends('layouts.apps')
@section('title', 'Distributor posts')

@section('contents')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Distributor Posts</a></li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="media align-items-center mb-4">
                            <img class="mr-3" src="{{asset('uploads/'.$post->owner->thumbnail)}}" width="80" height="80" alt="">
                            <div class="media-body">
                                <h3 class="mb-0">{{$post->owner->name}}</h3>
                                <p class="text-muted mb-0">{{$post->owner->telp_num}}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-5">
                            <div class="col-12 text-center">
                                <button class="btn btn-danger px-5">Hapus post ini</button>
                            </div>
                        </div>
                        <h4>Post</h4>
                        <p class="text-dark">{!!$post->post!!}</p>
                        <ul class="card-profile__info">
                            <li class="mb-1"><strong class="text-dark mr-4">Published : </strong><span>{{ $post->created_at->diffForHumans() }}</span></li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
