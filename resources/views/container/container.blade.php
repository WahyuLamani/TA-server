@extends('layouts.apps')
@section('title', 'Container')

@section('contents')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Container</a></li>
            </ol>
        </div>
    </div>

    <div class="container">
        @include('layouts.alert')
        @error('email')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message . ' Please submit again !'}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @enderror
        @error('product_type')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message . ' Please submit again !'}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @enderror
        

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fa fa-truck fa-2x mr-2" aria-hidden="true"></i>Agent truck</h4>
                        <p class="text-muted"><code></code>
                        </p>
                        <div id="accordion-one" class="accordion">
                            @foreach ($agents as $row)
                                <div class="card">
                                    <div class="card-header">
                                    <h5 class="mb-0 collapsed text-bold text-info" data-toggle="collapse" data-target="#{{$row->name}}" aria-expanded="false" aria-controls="collapseOne"><i class="fa" aria-hidden="true"></i>{{ 'Nama : '.$row->name.$row->id }}</h5>
                                    </div>
                                    <div id="{{$row->name}}" class="collapse" data-parent="#accordion-one">
                                        <div class="card-body">
                                            
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tanggal Pengambilan</th>
                                                            <th>Status</th>
                                                            <th>Jumlah</th>
                                                            <th>Jenis</th>
                                                            <th>Sisa</th>
                                                            <th>Edit status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($row->container as $container)
                                                        <tr>
                                                            <th>{{ $loop->iteration }}</th>
                                                            <td>{{ $container->created_at->format("F d, Y, g:i:s a") }}</td>
                                                            <td>
                                                                @if ($container->on_truck === 0)
                                                                <span class="badge badge-danger px-2">clear</span>
                                                                @else
                                                                <span class="badge badge-success px-2">on truck</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $container->amount.' '.$container->warehouse->product_type->unit }}</td>
                                                            <td class="text-primary"><b>{{ $container->warehouse->product_type->type }}</b></td>
                                                            <td class="text-primary"><b>{{ $container->count_down_amount .' '.$container->warehouse->product_type->unit }}</b></td>
                                                            <td style="width:100px">
                                                                <div class="d-flex justify-content-between">
                                                                    <form action="/agent-container/handle/{{$container->id}}" method="post">
                                                                        @csrf
                                                                        @if ($container->on_truck === 0)
                                                                        <button class="btn tombol-keluar" type="submit"><i class="fa fa-toggle-on fa-lg" aria-hidden="true"></i></button>
                                                                        @else
                                                                        <button class="tombol-keluar" type="submit"><i class="fa fa-toggle-off fa-lg" aria-hidden="true"></i></button>
                                                                        @endif
                                                                    </form>
                                                                    <span data-toggle="modal" data-target="#{{$container->agent->slug.$container->id}}"><button class="tombol-keluar" type="submit" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash fa-lg color-danger"></i></button></span>
                                                                    @section('type', 'container')
                                                                    @include('layouts.modal')
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer mb-0">
                                        <form action="{{route('container.store')}}" method="POST" class="mt-3 ">
                                            @csrf
                                            <input type="hidden" name="agent_id" value="{{$row->id}}">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" name="product_amount" value="{{old('product_amount')}}" class="form-control input-rounded @error('product_amount') is-invalid @enderror" placeholder="Jumlah produk yang di bawa (number)" autocomplete="off">

                                                        @error('product_amount')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <select name="warehouse_id" class="form-control input-rounded form-control-sm @error('warehouse_id') is-invalid @enderror">
                                                            <option disabled selected>Pilih gudang pengambilan</option>
                                                            @foreach ($warehouse as $row)
                                                            <option value="{{ $row->id }}">{{ $row->product_type->type.' tersisa '. $row->count_down_amount.' '.$row->product_type->unit}}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('warehouse_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 d-inline">
                                                    <button type="submit" class="btn mt-1 btn-rounded btn-success">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
