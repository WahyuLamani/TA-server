<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ar u sure want to delete this @yield('type') ?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="text-secondary">
                <h5>Name : {{$agent->name ?? $distributor->name}}</h5>
                <small>Registered at : {{($agent->created_at ?? $distributor->created_at)->format("d F, Y")}}</small>
            </div>
            <form action="/@yield('type')/delete/{{$agent->id ?? $distributor->id}}" method="post">
                @csrf
                @method('delete')
                <div class="d-flex mt-2">
                <button class="btn btn-sm btn-danger mr-2" type="submit">yes</button>
                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">No</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>