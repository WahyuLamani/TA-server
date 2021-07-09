@extends('layouts.apps')
@section('title', 'Warehouse')

@section('contents')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Warehouse</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Accordion</h4>
                        <p class="text-muted"><code></code>
                        </p>
                        <div id="accordion-one" class="accordion">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa" aria-hidden="true"></i> Accordion Header One</h5>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordion-one">
                                    <div class="card-body">
                                        <div class="custom-media-object-2">
                                            <div class="media border-bottom-1 p-t-15">
                                                <img class="mr-3 rounded-circle" src="images/avatar/1.jpg" alt="">
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            <h5>John Tomas</h5>
                                                            <p>tomas@example.com</p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <p class="text-muted f-s-14">10 Deals</p>
                                                        </div>
                                                        <div class="col-lg-5 text-right">
                                                            <h5 class="text-muted"><i class="cc BTC m-r-5"></i> <span class="BTC m-l-10">Send BTC</span></h5>
                                                            <p class="f-s-13 text-muted">Last 10 min ago</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media border-bottom-1 p-t-15">
                                                <img class="mr-3 rounded-circle" src="images/avatar/2.jpg" alt="">
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            <h5>Elora Smith</h5>
                                                            <p>elorasmith@example.com</p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <p class="text-muted f-s-14">8 Deals</p>
                                                        </div>
                                                        <div class="col-lg-5 text-right">
                                                            <h5 class="text-muted"><i class="cc LTC m-r-5"></i> <span class="LTC m-l-10">Send LTC</span></h5>
                                                            <p class="f-s-13 text-muted">Last 20 min ago</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media border-bottom-1 p-t-15">
                                                <img class="mr-3 rounded-circle" src="images/avatar/3.jpg" alt="">
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            <h5>John Abraham</h5>
                                                            <p>abraham@example.com</p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <p class="text-muted f-s-14">3 Deals</p>
                                                        </div>
                                                        <div class="col-lg-5 text-right">
                                                            <h5 class="text-muted"><i class="cc BTC m-r-5"></i> <span class="BTC m-l-10">Send BTC</span></h5>
                                                            <p class="f-s-13 text-muted">Last 10 min ago</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media p-t-15">
                                                <img class="mr-3 rounded-circle" src="images/avatar/1.jpg" alt="">
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            <h5>John Abraham</h5>
                                                            <p>abraham@example.com</p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <p class="text-muted f-s-14">3 Deals</p>
                                                        </div>
                                                        <div class="col-lg-5 text-right">
                                                            <h5 class="text-muted"><i class="cc BTC m-r-5"></i> <span class="BTC m-l-10">Send BTC</span></h5>
                                                            <p class="f-s-13 text-muted">Last 10 min ago</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa" aria-hidden="true"></i> Accordion Header Two</h5>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion-one">
                                    <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa" aria-hidden="true"></i> Accordion Header Tne</h5>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent="#accordion-one">
                                    <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree"><i class="fa" aria-hidden="true"></i> Accordion Header Tne</h5>
                                </div>
                                <div id="collapseFour" class="collapse" data-parent="#accordion-one">
                                    <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
