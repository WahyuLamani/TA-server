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
                        {{-- Modal Create Agent --}}
                        <div class="modal fade" id="createAgents" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New Agent</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{route('agent.store')}}" method="post">
                                        @csrf
                                        
                                        <input class="form-control @error('name') is-invalid @enderror my-3" type="text" name="name" value="{{old('name')}}" id="name" placeholder="enter Name" autocomplete="off">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input class="form-control @error('email') is-invalid @enderror my-3" type="text" name="email" value="{{old('email')}}" id="email" placeholder="Enter Email" autocomplete="off">
                                        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <div class="d-flex justify-content-between mt-2">
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <button type="button" class="btn btn-danger btn-success" data-dismiss="modal">exit</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End modal --}}

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
                                        
                                        @if ($agent->address == null)
                                        <td class="text-center" colspan="3">{{"This agent has not registered on the mobile app"}}</td>
                                        @else
                                        <td>{{$agent->address}}</td>
                                        <td>{{$agent->telp_num}}</td>
                                        <td><a href="agent/details/{{$agent->id}}">details</a></td>
                                        @endif
                                        <td width="10px"><span data-toggle="modal" data-target="#exampleModal"><button class="tombol-keluar" type="submit" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash fa-lg color-danger"></i></button></span>
                                        </td>
                                    </tr>
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
