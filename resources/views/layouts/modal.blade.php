@if ($post->owner->slug ?? false)
    @php
        $modalUrl = $post->owner->slug.$post->id;
    @endphp
@endif

<div class="modal fade" id="{{$agent->slug ?? $modalUrl ?? $distributor->slug ?? ($container->agent->slug.$container->id)}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h5>@if ($container ?? false)
                    Sisa Produk :
                    @else
                    Name :
                    @endif 
                    {!!$agent->name ?? $distributor->name ?? $post->post ?? $container->count_down_amount!!}</h5>
                <small>@if ($container ?? false)
                    Tanggal pengambilan :
                    @else
                    Registered at :
                    @endif
                     {{($agent->created_at ?? $distributor->created_at ?? $post->created_at ?? $container->created_at)->format("d F, Y")}}</small>
            </div>
            <form action="/@yield('type')/delete/{{$agent->id ?? $post->id ?? $distributor->id ?? $container->id}}" method="post">
                @csrf
                @method('delete')
                @if ($container ?? false)
                    <div class="form-check form-check-inline mt-3 mb-1">
                        <input name="refund" class="form-check-input ml-3" type="checkbox" id="inlineCheckbox1" value="1" checked>
                        <label class="form-check-label" for="inlineCheckbox1">Pengembalian produk ke-gudang?</label>
                    </div>
                @endif
                <div class="d-flex mt-2">
                <button class="btn btn-sm btn-danger mr-2" type="submit">yes</button>
                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">No</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>