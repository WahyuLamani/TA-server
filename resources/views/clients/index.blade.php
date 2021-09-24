
@extends('layouts.apps')
@section('title', 'Home')
@section('contents')
@include('layouts.loader')
    <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid mt-3">
                @include('layouts.alert')
                @if (Auth::user()->userable_type === "App\Models\Client\Agent")
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Produk di Truck <i class="fa fa-truck"></i></h4>
                                <div class="basic-list-group">
                                    <ul class="list-group">
                                        @foreach ($containers as $product_type => $value)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">{{$product_type}} <span class="badge badge-dark">{{array_sum($value)}}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        @if (Auth::user()->userable_type === "App\Models\Client\Distributor")
                        <button type="button" class="btn btn-primary mb-3 d-block" data-toggle="modal" data-target="#newOrder">Buat Order</button>
                        <h4 class="d-inline">Order Pending</h4><br>
                        <div class="row mt-3">
                            @forelse ($orderWaiting as $row)
                            <div class="col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">{{$row->req_amount.' '.$row->product_type->unit.' '.$row->product_type->type}}{!! $row->on_progress === "Rejected" ? '  <span class="badge badge-danger">Orderan ditolak</span>' : '' !!}</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">di Perusahaan : <b>{{$row->company->company_name}}</b></h6>
                                        <p>Kontak : <b>{{$row->company->company_telp_num}}</b></p>
                                        <p class="card-text d-inline"><small class="text-muted">{{$row->created_at->format('d M, Y')}}</small>
                                            <div class="d-inline">
                                                <form action="/clients/delete/{{$row->id}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <p>
                                                    <button type="submit" class="btn mb-1 btn-outline-danger btn-xs card-link float-right">Cancel orderan</button>
                                                    </p>
                                                </form>
                                            </div>
                                        {{-- </p><a href="#" class="card-link float-right"><small>terima orderan</small></a> --}}
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-secondary ml-3">Tidak ada orderan</p>
                            @endforelse
                        </div>
                        {{-- modal new order --}}
                        <div class="bootstrap-modal">
                            <div class="modal fade" id="newOrder">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Buat order</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('clients')}}" method="POST">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Company</label>
                                                    <select name="product" id="company_id" class="form-control form-control-sm @error('product') is-invalid @enderror">
                                                        <option disabled selected>Pilih produk dan company</option>
                                                        @foreach ($productList as $product)
                                                            <option value="{{ $product->id }},{{ $product->company->id}}">{{$product->type.'/'.$product->unit.' pada company '.$product->company->company_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('product')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input type="text" name="amount" class="form-control input-default @error('amount') is-invalid @enderror" placeholder="Jumlah yang mau diorder">
                                                    @error('amount')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}
                        @endif
                        @if (Auth::user()->userable_type === "App\Models\Client\Agent")
                        <h4 class="d-inline">Orderan yang diterima</h4>
                        <p class="text-muted">{{Auth::user()->userable->name}}</p>
                        <div class="row">
                            @forelse ($receivedOrders as $order)
                            <div class="col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h6 class="card-title">{{$order->req_amount.' '.$order->product_type->type.' '.$order->product_type->unit}}</h6>
                                            {{-- @if ($order->on_progress === 'Accepted' && $order->distribution === null)
                                                <form action="/clients/{{$order->id}}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <p>
                                                    <button type="submit" class="btn mb-1 btn-outline-danger btn-xs card-link float-right">Batalkan Orderan</button>
                                                    </p>
                                                </form>
                                            @endif --}}
                                        </div>
                                        <h6 class="card-subtitle mb-2 text-muted">{{$order->distributor->name}}</h6>
                                        <p class="card-text">{{$order->distributor->address}}</p>
                                        <p class="card-text d-inline"><small class="text-muted">{{$order->created_at->format('d M, Y')}}</small>
                                        @if($order->on_progress === 'Clear')
                                        </p><p class="label label-success">Terdistribusikan</p>
                                        @elseif($order->on_progress === 'Accepted')
                                        </p><p class="label label-warning">Pending !</p>
                                        <a href="#" class="label label-dark" data-toggle="modal" data-target="#modalbox{{$order->id}}">Terdistribusikan</a>
                                        @endif
                                        <div class="modal fade bd-example-modal-sm" id="modalbox{{$order->id}}">
                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{$order->req_amount.' '.$order->product_type->type.' '.$order->product_type->unit}} Diterima?</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/clients/{{$order->id}}" method="POST"> @csrf
                                                    <div class="modal-body">
                                                        <p>Orderan atas nama : <b>{{$order->distributor->name}}</b></p>
                                                        <input type="text" name="info" placeholder="info (optional)" class="form-control input-flat"></div>
                                                    <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Yes</button>
                                                        </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-secondary ml-3">Tidak ada orderan</p>
                            @endforelse
                        </div>
                        @else
                        <h4 class="d-inline">Order Dalam Perjalanan</h4>
                        <p class="text-muted">{{Auth::user()->userable->name}}</p>
                        <div class="row">
                            @forelse ($orderAccepted as $row)
                            <div class="col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">{{$row->req_amount.' '.$row->product_type->type.' '.$row->product_type->unit}}{!!$row->container->on_truck === 0 ? ' <span class="badge badge-warning">Butuh Persetujuan</span>' : ''!!}</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">{{$row->company->company_name}}</h6>
                                        <p class="card-text">Di terima oleh Agent : {{$row->agent->name}}</p>
                                        <p class="card-text d-inline"><small class="text-muted">{{$row->updated_at->format('d M, Y')}}</small></p>
                                        <button type="submit" class="btn mb-1 btn-outline-info btn-xs card-link float-right"  data-toggle="modal" data-target="#infoAgent{{$row->id}}">Info</button>
                                    </div>
                                </div>
                            </div>
                            {{-- modal --}}
                            <div class="bootstrap-modal">
                                <div class="modal fade" id="infoAgent{{$row->id}}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{$row->agent->name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Alamat : <b>{{$row->agent->address}}</b></p>
                                                <p class="text-secondary">Nomor Telepon agent: <b> {{$row->agent->telp_num}}</b></p>
                                                <p class="text-primary">Nomor Telepon Perusahaan : <b> {{$row->agent->company->company_telp_num}}</b></p>
                                                <form action="/clients/accept/{{$row->id}}" method="post">
                                                    @method('patch')
                                                    @csrf
                                                    <button type="submit" class="btn mb-1 btn-outline-warning">Orderan Diterima ? <span class="btn-icon-right"><i class="fa fa-check"></i></span>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- modal --}}
                            @empty
                            <p class="text-secondary">Tidak ada orderan</p>
                            @endforelse
                        </div>
                        @endif
                    </div>
                </div>
                @if (Auth::user()->userable_type === "App\Models\Client\Agent")
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Distribution List</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Tanggal Order</th>
                                                <th>Tanggal Terdistribusi</th>
                                                <th>Distributor</th>
                                                <th>info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($distributions as $dist)
                                            <tr>
                                                <td><small>{{$dist->amount.' item '.$dist->container->warehouse->product_type->type.'/'.$dist->container->warehouse->product_type->unit}}</small></td>
                                                <td>{{$dist->order->created_at->format('d M, y')}}</td>
                                                <td>{{$dist->created_at->format('d M, y')}}</td>
                                                <td><img src="{{asset('uploads/'.$dist->order->distributor->thumbnail)}}" width="30px" class=" rounded-circle mr-3" alt="">{{$dist->order->distributor->name}}</td>
                                                <td>{{$dist->info}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Tanggal Order</th>
                                                <th>Tanggal Terdistribusi</th>
                                                <th>Distributor</th>
                                                <th>info</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Distribution List</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Tanggal Order</th>
                                                <th>Tanggal Terdistribusi</th>
                                                <th>Agent</th>
                                                <th>Company</th>
                                                <th>info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($distributions as $dist)
                                            <tr>
                                                <td><small>{{$dist->amount.' item '.$dist->container->warehouse->product_type->type.'/'.$dist->container->warehouse->product_type->unit}}</small></td>
                                                <td>{{$dist->order->created_at->format('d M, y')}}</td>
                                                <td>{{$dist->created_at->format('d M, y')}}</td>
                                                <td><img src="{{asset('uploads/'.$dist->order->agent->thumbnail)}}" width="30px" class="rounded-circle mr-3" alt="">{{$dist->order->agent->name}}</td>
                                                <td>{{$dist->order->agent->company->company_name}}</td>
                                                <td>{{$dist->info}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Tanggal Order</th>
                                                <th>Tanggal Terdistribusi</th>
                                                <th>Agent</th>
                                                <th>Company</th>
                                                <th>info</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

<script>
    let coordinats = []
    navigator.geolocation.watchPosition(data => {
            coordinats = [data.coords.latitude,data.coords.longitude];
            // coordinats.push([data.coords.latitude,data.coords.longitude]);
            const jsonCoordinats = {
                latitude : data.coords.latitude,
                longitude : data.coords.longitude,
                coordinats : JSON.stringify(coordinats)
            }
            // window.localStorage.setItem('coordinats', JSON.stringify(coordinats));
            saveKoordinats(jsonCoordinats)
            
        }, (error) => console.log(error), {
            enableHighAccuracy : true
        }
    );
    function saveKoordinats(json){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'patch',
            url: "{{route('save.koordinats')}}",
            dataType: 'json',
            data: {
                latitude : json.latitude,
                longitude : json.longitude,
                coordinats : json.coordinats
            },
        })
    }


</script>
@endsection
        
