@extends('layouts.apps')
@section('title', 'User Profile')

@section('contents')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Agents</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
            </ol>
        </div>
    </div>
    {{-- this your content --}}
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-gray">
                            <small> 
                            @if ($agent->last_login)
                                Last login at {{\Carbon\Carbon::parse($agent->last_login)->diffForHumans()}}
                            @else
                                {{'Unregistered !'}}
                            @endif
                        </small> </h6>
                        <div class="text-center">
                            <img style="width: 180px" src="/storage/{{$agent->thumbnail}}" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">{{$agent->name}}</h5>
                            <p class="m-0">{{$agent->email}}</p>
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal" type="submit">Delete Agent</button>
 
                            {{-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card" id="agent-details">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title text-black-50">Achievement Details</h4>
                            <form id="live-search-form">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" name="search" id="live-search" class="form-control" data-toggle="tooltip" data-placement="top" title="Example : yyyy-mm-dd" placeholder="Search by date & time">
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table header-border table-hover verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date & time</th>
                                        <th scope="col">Items</th>
                                        <th scope="col">Distributor</th>
                                        <th scope="col">Info</th>
                                    </tr>
                                </thead>
                                <tbody id="dynamic-row">
                                    @foreach ($distribution as $item)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{Carbon\Carbon::parse($item->added_at)->format("F d, Y")}}</td>
                                        <td>{{$item->dis_item .' Carton'}}
                                            {{-- <div class="progress" style="height: 10px">
                                                <div class="progress-bar gradient-1" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>  --}}
                                        </td>
                                        <td>{{$item->name}}
                                            {{-- <span class="label gradient-1 btn-rounded">70%</span> --}}
                                        </td>
                                        <td><i class="fa fa-info fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{$item->info}}"></i></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-3">

            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                       <h3 class="card-title text-gray">Total Sales</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    {{-- end your content --}}
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
$( document ).ready(function() {
    $("#foo").submit(function(event) {
    var ajaxRequest;

    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
    $("#result").html('');

    /* Get from elements values */
    var values = $(this).serialize();

    /* Send the data using post and put the results in a div. */
    /* I am not aborting the previous request, because it's an
       asynchronous request, meaning once it's sent it's out
       there. But in case you want to abort it you can do it
       by abort(). jQuery Ajax methods return an XMLHttpRequest
       object, so you can just use abort(). */
       ajaxRequest= $.ajax({
            url: "test.php",
            type: "post",
            data: values
        });

    /*  Request can be aborted by ajaxRequest.abort() */

    ajaxRequest.done(function (response, textStatus, jqXHR){

         // Show successfully for submit message
         $("#result").html('Submitted successfully');
    });

    /* On failure of request this function will be called  */
    ajaxRequest.fail(function (){

        // Show error
        $("#result").html('There is error while submit');
    });
});
</script>
@include('layouts.modal')
@endsection
