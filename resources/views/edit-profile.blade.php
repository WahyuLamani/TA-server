@extends('layouts.apps')
@section('contents')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="/profile/update/{{$user->id}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="company_name">Company Name
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') ?? $user->company_name }}" placeholder="Company Name">

                                     @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                     @enderror
                                       
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="name">Name
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $user->name }}" placeholder="Enter Name">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="email">Email
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') ?? $user->email }}" placeholder="Enter Email..">
                                        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="address">Company Address
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') ?? $user->address }}" placeholder="Company Address..">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="telp_num">Telp.Number
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control  @error('telp_num') is-invalid @enderror" id="telp_num" name="telp_num" value="{{ old('telp_num') ?? $user->telp_num }}" placeholder="Telp.Number">

                                        @error('telp_num')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="thumnail">Thumnail
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="file" class="form-control  @error('thumnail') is-invalid @enderror" id="thumnail" name="thumnail" value="{{ old('thumnail') ?? $user->thumnail }}" placeholder="Telp.Number">

                                        @error('thumnail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="password">New Password
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="New Password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="password_confirmation"> Repeat New Password
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <input class="form-control @error('oldpassword') is-invalid @enderror" type="password" placeholder="Enter Ur Password" name="oldpassword" id="oldpassword">

                                        @error('oldpassword')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
@endsection