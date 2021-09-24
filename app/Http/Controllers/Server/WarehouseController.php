<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\Container;
use App\Models\Server\{ProductType, Warehouse};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    public function index()
    {
        $recordWarehouse = Warehouse::where('company_id', Auth::user()->userable->id)
            ->whereRaw('created_at = updated_at')
            ->get();
        $warehouse = Warehouse::where('company_id', Auth::user()->userable->id)
            ->whereRaw('created_at != updated_at')->paginate(6);
        $products = ProductType::whereHas('company', function ($q) {
            $q->where('company_id', Auth::user()->userable->id);
        })->get();
        return view('warehouse.warehouse', compact([
            'products',
            'recordWarehouse',
            'warehouse',
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer',
            'product_type' => 'required'
        ]);

        $warehouse = Warehouse::where('product_type_id', $request->product_type)
            // ->whereRaw('created_at != updated_at')
            ->latest('updated_at')->first();
        $this->newWarehouseData($request);
        //     // update warehouse data
        $warehouse->update([
            'amount' => $warehouse->amount + $request->amount,
            'count_down_amount' => $warehouse->count_down_amount + $request->amount,
        ]);

        session()->flash('success', ucwords('Warehouse data successfully created'));
        return redirect()->back();
    }

    public function newWarehouseData($request)
    {
        Auth::user()->userable->warehouse()->create([
            'product_type_id' => $request->product_type,
            'amount' => $request->amount,
            'count_down_amount' => $request->amount,
        ]);
    }

    public function detail(Warehouse $warehouse)
    {
        if ($warehouse->company_id !== Auth::user()->userable->id) {
            abort(404);
        }
        $container = Container::where('warehouse_id', $warehouse->id)->paginate(6);
        return view('warehouse.warehouse-detail', compact([
            'container'
        ]));
    }

    public function createProductType(Request $request)
    {
        $request->validate([
            'product_type' => 'required',
            'product_unit' => 'required'
        ]);

        $product = Auth::user()->userable->product_type()->create([
            'type' => ucwords($request->product_type),
            'unit' => ucwords($request->product_unit)
        ]);
        Auth::user()->userable->warehouse()->create([
            'product_type_id' => $product->id,
            'amount' => 0,
            'count_down_amount' => 0
        ]);

        session()->flash('success', 'Product type successfully created!!');
        return redirect()->back();
    }
}
