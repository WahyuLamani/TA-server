<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\{Agent, Container};
use App\Models\Server\Warehouse;
use Carbon\Carbon;
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
        $request->validate([
            'product_amount' => 'required|integer',
            'warehouse_id' => 'required'
        ]);

        $agent = Agent::find($request->agent_id);
        $warehouse = Warehouse::find($request->warehouse_id);
        if ($warehouse->count_down_amount < $request->product_amount) {
            session()->flash('error', ucwords('Produk yang akan dibawa ' . $agent->name . ' Melebihi produk gudang'));
            return redirect()->back();
        }
        $carbon = Carbon::now();
        $container = Container::where('agent_id', $request->agent_id)
            ->where('created_at', 'like', '%' . $carbon->format('y-m-d') . '%')
            ->whereHas('warehouse', function ($q) use ($warehouse) {
                $q->whereHas('product_type', function ($q) use ($warehouse) {
                    $q->where('type', $warehouse->product_type->type)
                        ->where('unit', $warehouse->product_type->unit);
                });
            })->first();

        if (isset($container)) {
            $container->amount = $request->product_amount + $container->amount;
            $container->count_down_amount = $request->product_amount + $container->count_down_amount;
            $container->save();
        } else {
            $agent->container()->create([
                'warehouse_id' => $request->warehouse_id,
                'amount' => $request->product_amount,
                'count_down_amount' => $request->product_amount,
            ]);
        }

        $warehouse->count_down_amount = $warehouse->count_down_amount - $request->product_amount;
        $warehouse->save();

        session()->flash('success', 'Pengambilan produk agent dengan nama : ' . $agent->name . ' ditambahkan !!');
        return redirect()->back();
    }


    public function handle(Container $container)
    {
        if ($container->on_truck === 1) {
            $container->on_truck = 0;
            $container->save();
        } else {
            $container->on_truck = 1;
            $container->save();
        }

        return redirect()->back();
    }

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
