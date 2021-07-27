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
                            @if ($distributor->user->last_login)
                                Last login at {{\Carbon\Carbon::parse($distributor->user->last_login)->diffForHumans()}}
                            @else
                                {{'Unregistered !'}}
                            @endif
                        </small> </h6>
                        <div class="text-center">
                            <img style="width: 180px" src="{{asset("/uploads/".$distributor->thumbnail)}}" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">{{$distributor->name}}</h5>
                            <p class="m-0">{{$distributor->user->email}}</p>
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#{{$distributor->slug}}" type="submit">Delete Agent</button>
 
                            {{-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                {{-- <div class="card" id="distributor-details"> --}}
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title text-black-50">Achievement Details</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date & time</th>
                                        <th>Items</th>
                                        <th>Agent</th>
                                        <th>Tanggal order</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($distribution->get() as $item)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{Carbon\Carbon::parse($item->added_at)->format("d F, Y")}}</td>
                                        <td>{{$item->amount.' '.$item->order->product_type->type.'/'.$item->order->product_type->unit}}
                                        </td>
                                        <td>{{$item->order->agent->name}}
                                        </td>
                                        <td>{{$item->order->created_at->format("d F, Y")}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Date & time</th>
                                        <th>Items</th>
                                        <th>Agent</th>
                                        <th>Tanggal order</th>
                                    </tr>
                                </tfoot>
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
    </div>


    
    {{-- end your content --}}
</div>
@include('layouts.modal')
@endsection
