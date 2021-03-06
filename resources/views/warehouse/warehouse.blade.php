@extends('layouts.apps')
@section('title', 'Warehouse')

@section('contents')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Warehouse</a></li>
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
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h4 class="card-title">Warehouse List</h4>
                            <div>
                                <button data-toggle="modal" data-target="#recordWarehouseData" class="btn btn-dark btn-sm">History warehouse</button>
                                <button data-toggle="modal" data-target="#createWarehouseData" class="btn btn-primary btn-sm">Tambah produk</button>
                            </div>
                        </div>

                        {{-- modal add warehouse data --}}
                        <div class="modal fade" id="createWarehouseData">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add new warehouse data</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/warehouse" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Total produk:</label>
                                                        <input name="amount" value="{{old('amount')}}" type="text" class="form-control @error('amount') is-invalid @enderror" id="recipient-name">
                                                        @error('amount')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Jenis:</label>
                                                        <select name="product_type" class="form-control form-control-sm @error('product_type') is-invalid @enderror">
                                                            <option disabled selected>Pilih Product type</option>
                                                            @foreach ($products as $row)
                                                            <option value="{{ $row->id }}">{{ $row->type.' '.$row->unit }}</option>
                                                            @endforeach 
                                                        </select>
                                                        @error('product_type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-info">Save produk</button>
                                        </form>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}

                        {{-- modal record warehouse data --}}
                        <div class="modal fade" id="recordWarehouseData">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Jenis Produk</th>
                                                        <th>Tanggal Didaftarkan</th>
                                                        <th>jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($recordWarehouse as $item)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{ $item->product_type->type }}</td>
                                                        <td>{{ $item->created_at->format("F d, Y, g:i:s a") }}</td>
                                                        <td class="text-primary"><b>{{ $item->amount.' '.$item->product_type->unit }}</b></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Jenis Produk</th>
                                                        <th>Tanggal Didaftarkan</th>
                                                        <th>jumlah</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jenis</th>
                                        <th>Total</th>
                                        {{-- <th>Tanggal di buat</th> --}}
                                        <th>Tanggal di perbarui</th>
                                        <th>Sisa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($warehouse as $row)
                                    <tr onclick="window.location='/warehouse/{{ $row->id }}';">

                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $row->product_type->type }}</td>
                                        <td>{{ $row->amount.' '.$row->product_type->unit }}</td>
                                        {{-- <td>{{ $row->created_at->format("F d, Y, g:i:s a") }}</td> --}}
                                        <td>{{ $row->updated_at->format("F d, Y, g:i:s a") }}</td>
                                        <td class="text-primary"><b>{{ $row->count_down_amount.' '.$row->product_type->unit }}</b></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-lg-center">
                            {{-- {{ $orders->links('vendor.pagination.bootstrap-4') }} --}}
                            {{$warehouse->links('vendor.pagination.bootstrap-4')}}  
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Product type</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $row)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $row->type }}</td>
                                        <td>{{ $row->unit }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button data-toggle="modal" data-target="#createProductType" class="btn btn-primary btn-sm">Tambah type produk</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal tambah type produk --}}
            <div class="modal fade" id="createProductType">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add new warehouse data</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('product-type') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="type-produk" class="col-form-label">Type produk</label>
                                            <input name="product_type" value="{{old('product_type')}}" type="text" class="form-control @error('product_type') is-invalid @enderror" id="type-produk" placeholder="ex : Aqua 600ML">
                                            @error('product_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="unit" class="col-form-label">Unit</label>
                                            <input name="product_unit" value="{{old('product_unit')}}" type="text" class="form-control @error('product_unit') is-invalid @enderror" id="unit" placeholder="ex : Kardus">
                                            @error('product_unit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                <button type="submit" class="btn btn-info">Save produk</button>
                            </form>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>z
            {{-- end modal --}}
        </div>
    </div>
</div>


@endsection
