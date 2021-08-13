<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Agent</th>
            <th>Items</th>
            <th>Nama Distributor</th>
            <th>Tanggal dan waktu</th>
            <th>Status order</th>
        </tr>
    </thead>
    <tbody>
    @foreach($distributions as $distribution)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$distribution->order->agent->name}}</td>
            <td>
                {{$distribution->amount.' produk '.$distribution->container->warehouse->product_type->type.'/'.$distribution->container->warehouse->product_type->unit}}
            </td>
            <td>{{$distribution->order->distributor->name}}</td>
            {{-- <td>iPhone X</td> --}}
            <td>{{$distribution->created_at->format("d F, Y")}}</td>
            @if($distribution->order->on_progress === 'Clear')
            <td>Selesai</td>
            @else
            <td>Menunggu</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>