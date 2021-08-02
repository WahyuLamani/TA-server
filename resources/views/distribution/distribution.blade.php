@extends('layouts.apps')
@section('title', 'Home')
@section('contents')
    <!--**********************************
            Content body start
        ***********************************-->
         <div class="content-body">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="active-member">
                                    <div class="table-responsive">
                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Sales Agent</th>
                                                    {{-- <th>Product</th> --}}
                                                    <th>Items</th>
                                                    <th>Distributors</th>
                                                    <th>Date Created</th>
                                                    <th>Status Order</th>
                                                    <th>Info</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($distributions->paginate(6) as $data)
                                                <tr>
                                                    <td><img src="{{asset('uploads/'.$data->order->agent->thumbnail)}}" class=" rounded-circle mr-3" alt="">{{$data->order->agent->name}}</td>
                                                    {{-- <td>iPhone X</td> --}}
                                                    <td>
                                                        <small>{{$data->amount.' item '.$data->container->warehouse->product_type->type.'/'.$data->container->warehouse->product_type->unit}}</small>
                                                    </td>
                                                    <td><img src="{{asset('uploads/'.$data->order->distributor->thumbnail)}}" class=" rounded-circle mr-3" alt="">{{$data->order->distributor->name}}</td>
                                                    {{-- <td>iPhone X</td> --}}
                                                    <td><i class="fa fa-circle-o text-success mr-2"></i>{{$data->created_at->format("d F, Y")}}</td>
                                                    @if($data->order->on_progress === 'Accepted')
                                                    <td><span class="badge badge-warning">Waiting</span></td>
                                                    @else
                                                    <td><span class="badge badge-success">Cleared</span></td>
                                                    @endif
                                                    @if ($data->info)
                                                        <td>{{$data->info}}</td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-lg-center">
                                {{$distributions->paginate(6)->links('vendor.pagination.bootstrap-4')}}  
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">jumlah produk yang terdistribusi</h4>
                                <div class="basic-list-group">
                                    <ul class="list-group">
                                        @forelse ($product_type as $row)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">{{$row->type.' / '.$row->unit}} <span class="badge badge-primary badge-pill">{{$distributions->byProductType($row->id)->sum('amount')}}</span>
                                        @empty
                                            <p class="text-secondary">Produk kosong</p>
                                        @endforelse
                                        </li>
                                    </ul>
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
        
