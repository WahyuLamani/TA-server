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
                        <h6 class="card-title text-gray">
                            <small> 
                            @if ($agent->user->last_login)
                                Last login at {{\Carbon\Carbon::parse($agent->user->last_login)->diffForHumans()}}
                            @else
                                {{'Unregistered !'}}
                            @endif
                        </small> </h6>
                        <div class="text-center">
                            <img style="width: 180px" src="{{asset('uploads/'.$agent->thumbnail)}}" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">{{$agent->name}}</h5>
                            <p class="m-0">{{$agent->user->email}}</p>
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#{{$agent->slug}}" type="submit">Delete Agent</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                {{-- <div class="card" id="agent-details"> --}}
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title text-black-50">Achievement Details</h4>
                            {{-- <form id="live-search-form">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" name="search" id="live-search" class="form-control" data-toggle="tooltip" data-placement="top" title="Example : yyyy-mm-dd" placeholder="Search by date & time">
                                </div>
                            </form> --}}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date & time</th>
                                        <th>Items</th>
                                        <th>Distributor</th>
                                        <th>info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($distribution->get() as $item)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{Carbon\Carbon::parse($item->added_at)->format("F d, Y")}}</td>
                                        <td>{{$item->amount.' '.$item->order->product_type->type.'/'.$item->order->product_type->unit}}
                                        </td>
                                        <td>{{$item->order->distributor->name}}
                                        </td>
                                        <td><i class="fa fa-info fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{$item->info}}"></i></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Date & time</th>
                                        <th>Items</th>
                                        <th>Distributor</th>
                                        <th>info</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title text-gray">Total Sales</h3>
                            <div class="table-responsive">
                                <table class="table header-border table-hover verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">product Type</th>
                                            <th scope="col">Total Penjualan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dynamic-row">
                                        @forelse ($product_type->get() as $row)  
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{ $row->type.'/'.$row->unit }}</td>
                                            <td>{{$distribution->byProductType($row->id)->sum('amount')}}</td>
                                        </tr>
                                        @empty
                                            <p>New agent</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tracking agent</h4>
                            @forelse ($distributed as $item)
                            <div class="media border-bottom-1 pt-3 pb-3">
                                <img width="35" src="{{asset('uploads/'.$item->container->agent->thumbnail)}}" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5>Produk {{$item->order->product_type->type.'/'.$item->order->product_type->unit}} sebanyak <strong class="text-primary">{{$item->amount}}</strong></h5>
                                    <p class="mb-0"> <b><a class="text-primary" href="/agent/details/{{$item->container->agent->id}}">[{{strtoupper($item->container->agent->name)}}]</a></b> mendistribusikan produk kepada <b><a class="text-primary" href="/distributor/details/{{$item->order->distributor->id}}">[{{strtoupper($item->order->distributor->name)}}]</a></b> pada alamat <b><a href="https://www.google.co.id/maps/search/{{$item->order->distributor->address}}" target="_blank">{{$item->order->distributor->address}}</a></b></p>
                                    @if ($item->info) 
                                        <p>Info : {{$item->info}}</p>
                                    @endif
                                </div><span class="text-muted "><strong>{{$item->created_at->format("F d, Y, g:i:s a") }}</strong></span>
                            </div>
                            @empty
                                <p class="text-secondary">Have No Distributed</p>
                            @endforelse
                        <div class="card-footer d-flex justify-content-lg-center">
                            {{-- {{ $orders->links('vendor.pagination.bootstrap-4') }} --}}
                            {{$distributed->links('vendor.pagination.bootstrap-4')}}  
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>


    
    {{-- end your content --}}
</div>
@include('layouts.modal')
@endsection
