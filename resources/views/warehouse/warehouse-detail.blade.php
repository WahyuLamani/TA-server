@extends('layouts.apps')
@section('title', 'Warehouse')

@section('contents')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Warehouse</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa fa-university fa-2x mr-2" aria-hidden="true"></i>Warehouse record</h4>
                            <div class="custom-media-object-2">
                                @foreach ($container as $row)
                                    <div class="media border-bottom-1 p-t-15">
                                        <img class="mr-3 rounded-circle" width="55px" src="{{asset("/uploads/".$row->agent->thumbnail)}}" alt="">
                                        <div class="media-body">
                                            <div class="row mt-2">
                                                <div class="col-lg-5">
                                                    <h5>{{ $row->agent->name }}</h5>
                                                    <p>{{ $row->agent->telp_num }}</p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <strong class="text-muted text-info f-s-14">{{$row->amount.' '.$row->warehouse->product_type->unit.' '.$row->warehouse->product_type->type}}</strong>
                                                </div>
                                                <div class="col-lg-5 text-right">
                                                    @if ($row->on_truck == 1)
                                                        <h5 class="text-muted"><i class="fa fa-truck BTC m-r-5" aria-hidden="true"></i></i> <span class="BTC m-l-10">On truck</span></h5>
                                                    @else 
                                                        <h5 class="text-muted"></i> <span class="text-danger">Clear</span></h5>
                                                    @endif
                                                    <p class="f-s-13 text-muted">Diambil tanggal : {{$row->created_at->format("F d, Y, g:i:s a")}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-lg-center">
                            {{ $container->links('vendor.pagination.simple-bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
