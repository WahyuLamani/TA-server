@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="text-black-50">Company Form</h3></div>
    
                    <div class="card-body">
                        <form action="{{route('company.create')}}" method="post" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="company_name" class="col-md-4 col-form-label text-md-right">Company Name</label>
                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>
                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company_address" class="col-md-4 col-form-label text-md-right">Company Address</label>
                                <div class="col-md-6">
                                    <input id="company_address" type="text" class="form-control @error('company_address') is-invalid @enderror" name="company_address" value="{{ old('company_address') }}" required autocomplete="company_address" autofocus>
                                    @error('company_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ceo_name" class="col-md-4 col-form-label text-md-right">CEO Name</label>
                                <div class="col-md-6">
                                    <input id="ceo_name" type="text" class="form-control @error('ceo_name') is-invalid @enderror" name="ceo_name" value="{{ old('ceo_name') }}" required autocomplete="ceo_name" autofocus>
                                    @error('ceo_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company_email" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="company_email" type="email" class="form-control @error('company_email') is-invalid @enderror" name="company_email" value="{{ old('company_email') }}" required autocomplete="company_email" autofocus>
                                    @error('company_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company_telp_num" class="col-md-4 col-form-label text-md-right">Telp Number</label>
                                <div class="col-md-6">
                                    <input id="company_telp_num" type="text" class="form-control @error('company_telp_num') is-invalid @enderror" name="company_telp_num" value="{{ old('company_telp_num') }}" required autocomplete="company_telp_num" autofocus>
                                    @error('company_telp_num')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="thumbnail" class="col-md-4 col-form-label text-md-right">Thumbnail</label>
                                <div class="col-md-6">
                                    <input id="thumbnail" type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" value="{{ old('thumbnail') }}" required autocomplete="thumbnail" autofocus>
                                    @error('thumbnail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label for="about" class="col-md-4 col-form-label text-md-right">About</label>
                                <div class="col-md-6">
                                    <textarea name="about" id="about" class="form-control @error('about') is-invalid @enderror" rows="4">{{old('about')}}</textarea>
                                    @error('about')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
