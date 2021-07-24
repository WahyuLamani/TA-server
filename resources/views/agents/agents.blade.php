@extends('layouts.apps')
@section('title', 'Agents')

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
        @error('email')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message . ' Please submit again !'}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @enderror
        @error('name')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message . ' Please submit again !'}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @enderror
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Agents</h4>
                            <button data-toggle="modal" data-target="#createAgents" class="btn btn-primary">New Agent</button>
                        </div>
                        

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
                                        <td width="10px"><span data-toggle="modal" data-target="#{{$agent->slug}}"><button class="tombol-keluar" type="submit" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash fa-lg color-danger"></i></button></span>
                                        </td>
                                    </tr>
                                    @section('type', 'agent')
                                    @include('layouts.modal')
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
