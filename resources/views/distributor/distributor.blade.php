@extends('layouts.apps')
@section('title', 'Distributor')

@section('contents')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Distributors</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Distributor List</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Telp Number</th>
                                        <th>Registered by</th>
                                        <th>Details</th>
                                        <th>Act</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($distributors as $distributor)
                                    <tr>
                                        <td><img style="width: 30px" src="{{asset('assets/'.$distributor->thumbnail)}}" class=" rounded-circle mr-3">{{$distributor->name}}</td>
                                        
                                        @if ($distributor->address == null)
                                        <td class="text-center" colspan="3">{{"This distributor has not registered on the mobile app"}}</td>
                                        @else
                                        <td>{{$distributor->address}}</td>
                                        <td>{{$distributor->telp_num}}</td>
                                        <td>{{$distributor->created_at->format("d F, Y")}}</td>
                                        <td><a href="distributor/details/{{$distributor->id}}">details</a></td>
                                        @endif
                                        <td width="10px"><span data-toggle="modal" data-target="#{{$distributor->slug}}"><button class="tombol-keluar" type="submit" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash fa-lg color-danger"></i></button></span>
                                        </td>
                                    </tr>
                                    @section('type', 'distributor')
                                    @include('layouts.modal')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Telp Number</th>
                                        <th>Registered by</th>
                                        <th>Details</th>
                                        <th>Act</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
