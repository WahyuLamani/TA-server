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
        @include('layouts.alert')
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
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderLists as $order)
                                        <tr>
                                            <td><img style="width: 25px" src="{{asset('uploads/'.$order->distributor->thumbnail)}}" class=" rounded-circle mr-3"><a href="/distributor/details/{{ $order->distributor->id }}">{{ $order->distributor->name }}</a></td>
                                            <td>{{ $order->distributor->address }}</td>
                                            <td><b>{{ $order->distributor->telp_num }}</b></td>
                                            <td class="text-primary"><strong>{{ $order->req_amount.' '.$order->product_type->type.' '.$order->product_type->unit}}</strong></td>
                                            <td>{{ $order->created_at->format('d, M Y') }}</td>
                                            <td><button data-toggle="modal" data-target="#ModalAgent{{$order->id}}" class="btn btn-success btn-sm">Terima</button></td>
                                        </tr>

                                        {{-- modal --}}
                                        <div class="modal fade" id="ModalAgent{{$order->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/clients/{{$order->id}}" method="POST">
                                                            @method('patch')
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="type-produk" class="col-form-label">pilih agent yang mengantarkan Orderan</label>
                                                                <select name="agent" class="form-control form-control-sm @error('agent') is-invalid @enderror">
                                                                    <option disabled selected>Pilih agent</option>
                                                                    @foreach ($agents as $agent)
                                                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                                    @endforeach 
                                                                </select>
                                                                @error('agent')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <button type="submit" class="btn btn-info">Selesai</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderAccepts as $row)
                                        <tr>
                                            <td><img style="width: 25px" src="{{asset('uploads/'.$row->distributor->thumbnail)}}" class=" rounded-circle mr-3"><a href="/distributor/details/{{ $row->distributor->id }}">{{ $row->distributor->name }}</a></td>
                                            <td>{{ $row->distributor->address }}</td>
                                            <td><b>{{ $row->distributor->telp_num }}</b></td>
                                            <td class="text-primary"><strong>{{ $row->req_amount.' '.$row->product_type->type.' '.$row->product_type->unit}}</strong></td>
                                            <td><img style="width: 25px" src="{{asset('uploads/'.$row->agent->thumbnail)}}" class=" rounded-circle mr-3"><a href="/agent/details/{{ $row->agent->id }}">{{ $row->agent->name }}</a></td>
                                            <td>{{ $row->updated_at->format('d, M Y') }}</td>
                                            <td>
                                                <form action="/clients/{{$row->id}}" method="post">@csrf @method('patch')<button type="submit" class="btn btn-warning btn-sm">cancel</button></form>
                                            </td>
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
