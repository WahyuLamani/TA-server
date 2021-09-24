<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\{Agent, Container};
use App\Models\Client\Transactions\Order;
use App\Models\Server\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContainerController extends Controller
{
    public function index()
    {
        $agents = Agent::where('company_id', Auth::user()->userable->id)->get();
        $warehouse = Warehouse::where('company_id', Auth::user()->userable->id)
            ->where('count_down_amount', '>=', '1')
            ->get();

        return view('container.container', compact([
            'agents',
            'warehouse'
        ]));
    }

    public function store(Request $request)
    {
        $order = Order::find($request->order_id);
        $warehouse = Warehouse::where('product_type_id', $order->product_type->id)
            ->latest('updated_at')->first();
        if ($warehouse->count_down_amount < $order->req_amount) {
            session()->flash('error', ucwords('Produk yang akan dibawa ' . $order->agent->name . ' Melebihi produk gudang'));
            return redirect()->back();
        }

        $order->agent->container()->create([
            'warehouse_id' => $warehouse->id,
            'amount' => $order->req_amount,
            'count_down_amount' => $order->req_amount,
            'order_id' => $order->id,
        ]);

        $warehouse->count_down_amount = $warehouse->count_down_amount - $order->req_amount;
        $warehouse->save();

        session()->flash('success', 'Pengambilan produk agent dengan nama : ' . $order->agent->name . ' ditambahkan !!');
        return redirect()->back();
    }

    // public function handle(Container $container)
    // {
    //     if ($container->on_truck === 1) {
    //         $container->on_truck = 0;
    //         $container->save();
    //     } else {
    //         $container->on_truck = 1;
    //         $container->save();
    //     }

    //     return redirect()->back();
    // }

    public function destroy(Request $request, Container $container)
    {
        if (isset($request->refund)) {
            $container->warehouse->count_down_amount = $container->warehouse->count_down_amount + $container->count_down_amount;
            $container->warehouse->save();
        }
        $container->delete();
        session()->flash('success', isset($request->refund) ? 'Barang berhasil di kembalikan ke gudang' : 'barang terhapus');
        return redirect()->back();
    }
}
