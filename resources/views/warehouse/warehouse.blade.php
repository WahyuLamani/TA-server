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
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Distributor List</h4>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Product Types</h4>
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
                                <tr>
                                    <th>1</th>
                                    <td>Kolor Tea Shirt For Man</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
