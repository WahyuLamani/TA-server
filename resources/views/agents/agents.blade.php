@extends('layouts.apps')
@section('title', 'User Profile')

@section('contents')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Agents</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        @include('layouts.alert')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Agents</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Telp Number</th>
                                        <th>Details</th>
                                        <th>Act</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agents as $agent)
                                    <tr>
                                        <td><img style="width: 30px" src="/storage/{{$agent->thumbnail}}" class=" rounded-circle mr-3">{{$agent->name}}</td>
                                        <td>{{$agent->address}}</td>
                                        <td>{{$agent->telp_num}}</td>
                                        <td><a href="agent/details/{{$agent->id}}">details</a></td>
                                        <td width="10px"><span data-toggle="modal" data-target="#exampleModal"><button class="tombol-keluar" type="submit" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash fa-lg color-danger"></i></button></span>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ar u sure want to delete this Agent ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="text-secondary">
                                                    <h5>Name : {{$agent->name}}</h5>
                                                    <small>Registered at : {{$agent->created_at->format("d F, Y")}}</small>
                                                </div>
                                                <form action="/agent/delete/{{$agent->id}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="d-flax mt-2">
                                                    <button class="btn btn-sm btn-danger mr-2" type="submit">yes</button>
                                                    <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">No</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Telp Number</th>
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
