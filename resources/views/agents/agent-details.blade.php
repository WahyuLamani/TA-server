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
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-gray"><small>Last login at {{\Carbon\Carbon::parse($agent->last_login)->diffForHumans()}}</small></h6>
                        <div class="text-center">
                            <img style="width: 180px" src="/storage/{{$agent->thumbnail}}" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">{{$agent->name}}</h5>
                            <p class="m-0">{{$agent->email}}</p>
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal" type="submit">Delete Agent</button>
 
                            {{-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card" id="agent-details">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title text-black-50">Achievement Details</h4>
                            <form action="" method="get">@csrf
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" name="search" id="search" class="form-control" data-toggle="tooltip" data-placement="top" title="Example : yyyy-mm-dd" placeholder="Search by date & time">
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table header-border table-hover verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date & time</th>
                                        <th scope="col">Items</th>
                                        <th scope="col">Distributor</th>
                                        <th scope="col">Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($distribution as $item)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{Carbon\Carbon::parse($item->added_at)->format("d F, Y")}}</td>
                                        <td>{{$item->dis_item .' Carton'}}
                                            {{-- <div class="progress" style="height: 10px">
                                                <div class="progress-bar gradient-1" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>  --}}
                                        </td>
                                        <td>{{$item->name}}
                                            {{-- <span class="label gradient-1 btn-rounded">70%</span> --}}
                                        </td>
                                        <td><i class="fa fa-info fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{$item->info}}"></i></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-3">

            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                       <h3 class="card-title text-gray">Total Sales</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    {{-- end your content --}}
</div>
@include('layouts.modal')
@endsection
