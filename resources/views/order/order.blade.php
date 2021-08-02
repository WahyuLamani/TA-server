@extends('layouts.apps')
@section('title', 'Order')

@section('contents')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Order Request</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Order list</h4>
                        <div class="table-responsive">
                            <table class="table header-border">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Request</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderLists as $order)
                                        <tr>
                                            <td><img style="width: 25px" src="{{asset('assets/'.$order->distributor->thumbnail)}}" class=" rounded-circle mr-3"><a href="/distributor/details/{{ $order->distributor->id }}">{{ $order->distributor->name }}</a></td>
                                            <td>{{ $order->distributor->address }}</td>
                                            <td><b>{{ $order->distributor->telp_num }}</b></td>
                                            <td class="text-primary"><strong>{{ $order->req_amount.' '.$order->product_type->type.' '.$order->product_type->unit}}</strong></td>
                                            <td>{{ $order->created_at->format('d, M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-lg-center">
                        {{-- {{ $orders->links('vendor.pagination.bootstrap-4') }} --}}
                        {{$orderLists->appends(['orderLists' => $orderLists->currentPage()])->links('vendor.pagination.bootstrap-4')}}  
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Order Acepted</h4>
                        <div class="table-responsive">
                            <table class="table header-border">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Request</th>
                                        <th scope="col">Accept by</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderAccepts as $order)
                                        <tr>
                                            <td><img style="width: 25px" src="{{asset('assets/'.$order->distributor->thumbnail)}}" class=" rounded-circle mr-3"><a href="/distributor/details/{{ $order->distributor->id }}">{{ $order->distributor->name }}</a></td>
                                            <td>{{ $order->distributor->address }}</td>
                                            <td><b>{{ $order->distributor->telp_num }}</b></td>
                                            <td class="text-primary"><strong>{{ $order->req_amount.' '.$order->product_type->type.' '.$order->product_type->unit}}</strong></td>
                                            <td><img style="width: 25px" src="{{asset('assets/'.$order->agent->thumbnail)}}" class=" rounded-circle mr-3"><a href="/agent/details/{{ $order->agent->id }}">{{ $order->agent->name }}</a></td>
                                            <td>{{ $order->updated_at->format('d, M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-lg-center">
                        {{-- {{ $orders->links('vendor.pagination.bootstrap-4') }} --}}
                        {{$orderAccepts->appends(['orderAccepts' => $orderAccepts->currentPage()])->links('vendor.pagination.bootstrap-4')}}  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
