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
                    <div class="card-header">
                        <h4 class="text-black-50">Profile</h4>
                        @if (Auth::user()->userable_type === "App\Models\Client\Agent" || Auth::user()->userable_type === "App\Models\Client\Distributor")
                        <div class="card-body">
                            <div class="media align-items-center mb-3">
                                <img class="mr-1" src="{{asset("/uploads/". Auth::user()->userable->thumbnail)}}" width="80" height="80" alt="">
                                <div class="media-body">
                                    <h4 class="mb-0 text-black-50">{{ Auth::user()->userable->name}}</h4>
                                    <p class="text-muted mb-0">{{ Auth::user()->userable->email }}</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="card-body">
                            <div class="media align-items-center mb-3">
                                <img class="mr-1" src="{{asset("/uploads/". Auth::user()->userable->thumbnail)}}" width="80" height="80" alt="">
                                <div class="media-body">
                                    <h4 class="mb-0 text-black-50">{{ Auth::user()->userable->ceo_name}}</h4>
                                    <p class="text-muted mb-0">{{ Auth::user()->userable->company_email }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row mb-5">
                            <div class="col-12 text-center">
                                <a href="{{ route('profile.edit') }}" class="btn btn-danger px-5">Update Profile</a>
                            </div>
                        </div>
                        @if (Auth::user()->userable_type === "App\Models\Server\Company")
                        <h4>About Me</h4>
                        <p class="text-muted">{{ Auth::user()->userable->about}}</p>
                        @endif
                        <ul class="card-profile__info">
                            <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>{{ Auth::user()->userable->company_telp_num }}</span></li>
                            <li><strong class="text-dark mr-4">Login Email</strong> <span>{{ Auth::user()->email }}</span></li>
                        </ul>
                    </div>
                </div>  
            </div>
            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.posting') }}" method="post" class="form-profile">
                            @csrf
                            <div class="form-group">
                                <textarea name="post"  class="form-control @error('post') is-invalid @enderror" id="textarea" cols="30" rows="2" placeholder="Post a new message">{{ old('post') }}</textarea>
                                @error('post')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary px-3 ml-4">Send</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card" id="profile">
                    <div class="card-body">
                        @foreach (Auth::user()->userable->post as $post)
                            <div class="media media-reply">
                                <img class="mr-3 circle-rounded" src="{{asset("/uploads/".$post->owner->thumbnail)}}" width="50" height="50">
                                <div class="media-body">
                                    <div class="d-sm-flex justify-content-between mb-2">
                                        <h5 class="mb-sm-0">{{ $post->owner->ceo_name }} <small class="text-muted ml-3">post at {{$post->created_at->diffForHumans()}}</small></h5>
                                        <div class="media-reply__link">
                                            <button data-toggle="modal" data-target="#{{$post->owner->slug.$post->id}}" class="btn btn-transparent p-2"><i class="fa fa-trash-o fa-lg"></i></button>
                                            <button class="btn btn-transparent p-0 mt-1 ml-3"><i class="fa fa-pencil-square-o fa-lg"></i></button>
                                        </div>
                                    </div>
                                    <p>{{ $post->post }}</p>
                                </div>
                            </div>
                            @section('type', 'company-post')
                            @include('layouts.modal')
                        @endforeach
                    </div>
                </div>

                {{-- <div class="card mt-5">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Table Hover</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>Kolor Tea Shirt For Man</td>
                                        <td><span class="badge badge-primary px-2">Sale</span>
                                        </td>
                                        <td>January 22</td>
                                        <td class="color-primary">$21.56</td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <td>Kolor Tea Shirt For Women</td>
                                        <td><span class="badge badge-danger px-2">Tax</span>
                                        </td>
                                        <td>January 30</td>
                                        <td class="color-success">$55.32</td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td>Blue Backpack For Baby</td>
                                        <td><span class="badge badge-success px-2">Extended</span>
                                        </td>
                                        <td>January 25</td>
                                        <td class="color-danger">$14.85</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}


            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
    Content body end
***********************************-->

@endsection
