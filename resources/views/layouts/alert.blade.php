@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session()->get('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session()->get('error')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
{{-- <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sweet Message</h4>
            <div class="card-content">
                <div class="sweetalert m-t-30">
                    <button class="btn btn-info btn sweet-message">Sweet Message</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /# card -->
</div> --}}