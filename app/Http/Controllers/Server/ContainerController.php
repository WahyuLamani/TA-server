<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\{Agent, Container};
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
        $request->validate([
            'product_amount' => 'required|integer',
            'warehouse_id' => 'required'
        ]);

        $agent = Agent::find($request->agent_id);
        $warehouse = Warehouse::find($request->warehouse_id);
        if ($warehouse->count_down_amount < $request->product_amount) {
            session()->flash('error', ucwords('Produk yang di bawa ' . $agent->name . ' Terlalu berlebihan'));
            return redirect()->back();
        }

        $warehouse->count_down_amount = $warehouse->count_down_amount - $request->product_amount;
        $warehouse->save();

        $agent->container()->create([
            'warehouse_id' => $request->warehouse_id,
            'amount' => $request->product_amount,
            'count_down_amount' => $request->product_amount,
        ]);


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
}
