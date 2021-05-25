@extends('layouts.apps')
@section('title', 'User Profile')

@section('contents')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        @include('layouts.alert')
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center mb-4">
                            @if (Auth::user()->thumnail > 0)
                            <img class="mr-3" src="{{asset("storage/" . Auth::user()->thumnail)}}" width="80" height="80" alt="">
                            @endif
                            <div class="media-body">
                                <h3 class="mb-0">{{ Auth::user()->name}}</h3>
                                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-5">
                            {{-- <div class="col">
                                <div class="card card-profile text-center">
                                    <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                    <h3 class="mb-0">263</h3>
                                    <p class="text-muted px-4">Following</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-profile text-center">
                                    <span class="mb-1 text-warning"><i class="icon-user-follow"></i></span>
                                    <h3 class="mb-0">263</h3>
                                    <p class="text-muted">Followers</p>
                                </div>
                            </div> --}}
                            <div class="col-12 text-center">
                                <a href="{{ route('profile.edit') }}" class="btn btn-danger px-5">Update Profile</a>
                            </div>
                        </div>

                        <h4>About Me</h4>
                        <p class="text-muted">Hi, I'm Pikamy, has been the industry standard dummy text ever since the 1500s.</p>
                        <ul class="card-profile__info">
                            <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>{{ Auth::user()->telp_num }}</span></li>
                            <li><strong class="text-dark mr-4">Email</strong> <span>{{ Auth::user()->email }}</span></li>
                        </ul>
                    </div>
                </div>  
            </div>
            <div class="col-lg-8 col-xl-8">
                {{-- <div class="card">
                    <div class="card-body">
                        <form action="#" class="form-profile">
                            <div class="form-group">
                                <textarea class="form-control" name="textarea" id="textarea" cols="30" rows="2" placeholder="Post a new message"></textarea>
                            </div>
                            <div class="d-flex align-items-center">
                                <ul class="mb-0 form-profile__icons">
                                    <li class="d-inline-block">
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-user"></i></button>
                                    </li>
                                    <li class="d-inline-block">
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-paper-plane"></i></button>
                                    </li>
                                    <li class="d-inline-block">
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-camera"></i></button>
                                    </li>
                                    <li class="d-inline-block">
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-smile"></i></button>
                                    </li>
                                </ul>
                                <button class="btn btn-primary px-3 ml-4">Send</button>
                            </div>
                        </form>
                    </div>
                </div> --}}

                <div class="card" id="reporting">
                    <h3 class="mt-3 ml-3 text-black-50 text-center">Agents Problem Reporting</h3>
                    @foreach ($reports as $row)
                        <div class="media media-reply">
                            <img class="mr-3 circle-rounded" src="images/avatar/2.jpg" width="50" height="50">
                            <div class="media-body">
                                <div class="d-sm-flex justify-content-between mb-2">
                                    <h5 class="mb-sm-0">{{$row->name}}<small class="text-muted ml-3">about 3 days ago</small></h5>
                                    <div class="media-reply__link">
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-down"></i></button>
                                        <button class="btn btn-transparent p-0 ml-3 font-weight-bold">Reply</button>
                                    </div>
                                </div>
                                
                                <p>{{$row->post}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
    Content body end
***********************************-->

@endsection
