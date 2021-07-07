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
                                                    <th>Info</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($distributions as $data)
                                                <tr>
                                                    <td><img src="{{"/storage/".$data->thumbnail}}" class=" rounded-circle mr-3" alt="">{{$data->name}}</td>
                                                    {{-- <td>iPhone X</td> --}}
                                                    <td>
                                                        <small>{{$data->dis_item . ' Carton'}}</small>
                                                    </td>
                                                    <td><img src="{{"/storage/".$data->disthumbnail}}" class=" rounded-circle mr-3" alt="">{{$data->disname}}</td>
                                                    {{-- <td>iPhone X</td> --}}
                                                    <td><i class="fa fa-circle-o text-success mr-2"></i>{{Carbon\Carbon::parse($data->added_at)->format("d F, Y")}}</td>
                                                    <td>
                                                        {{$data->info}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
        
