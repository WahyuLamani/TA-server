@extends('layouts.apps')
@section('title', 'Home')
@section('contents')
@include('layouts.loader')
    <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title"><a class="text-white" href="{{route('distributed')}}">Has Been Distributed</a> </h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $distributed->sum('amount') }}</h2>
                                    {{-- <p class="text-white mb-0">Jan - March 2019</p> --}}
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-7">
                            <div class="card-body">
                                <h3 class="card-title text-white"><a class="text-white" href="{{route('distributors')}}">Distributors</a></h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$count['distributor']}}</h2>
                                    {{-- <p class="text-white mb-0">Jan - March 2019</p> --}}
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-7">
                            <div class="card-body">
                                <h3 class="card-title text-white"><a class="text-white" href="{{route('agents')}}">Agents</a></h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$count['agent']}}</h2>
                                    {{-- <p class="text-white mb-0">Jan - March 2019</p> --}}
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white"><a href="" class="text-white" data-toggle="modal" data-target="#agent-ontruck-modal"> Agent on truck</a></h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$agentOnline->count()}}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-truck"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- modal on truck --}}
                <div class="modal fade" id="agent-ontruck-modal">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fa fa-truck fa-lg"></i> On truck</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($agentOnline as $row)
                                                <tr>
                                                    <td><a href="/agent/details/{{$row->id}}">{{ $row->name }}</a></td>
                                                </tr>
                                            @empty
                                                <p class="text-secondary">No agent on truck !!</p>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end modal --}}
                
                {{-- <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Distributions tracking</h5>
                                <div class="active-member">
                                    <div class="table-responsive">
                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Customers</th>
                                                    <th>Product</th>
                                                    <th>Country</th>
                                                    <th>Status</th>
                                                    <th>Payment Method</th>
                                                    <th>Activity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><img src="./images/avatar/1.jpg" class=" rounded-circle mr-3" alt="">Sarah Smith</td>
                                                    <td>iPhone X</td>
                                                    <td>
                                                        <span>United States</span>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-success" style="width: 50%"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                                    <td>
                                                        <span>Last Login</span>
                                                        <span class="m-0 pl-3">10 sec ago</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Distributions tracking</h4>=
                                    @forelse ($distributed as $item)
                                    <div class="media border-bottom-1 pt-3 pb-3">
                                        <img width="35" src="/storage/{{$item->container->agent->thumbnail}}" class="mr-3 rounded-circle">
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
        </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
        
