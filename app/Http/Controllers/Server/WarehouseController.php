<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\Agent;
use App\Models\Client\Container;
use App\Models\Server\{ProductType, Warehouse};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouse = Warehouse::where('company_id', Auth::user()->userable->id)->paginate(6);
        $products = ProductType::whereHas('company', function ($q) {
            $q->where('company_id', Auth::user()->userable->id);
        })->get();
        return view('warehouse.warehouse', compact([
            'products',
            'warehouse'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer',
            'product_type' => 'required'
        ]);

        Auth::user()->userable->warehouse()->create([
            'product_type_id' => $request->product_type,
            'amount' => $request->amount,
            'count_down_amount' => $request->amount,
        ]);


        session()->flash('success', ucwords('Warehouse data successfully created'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * create product type
     * @param Request
     * @return redirect
     */

    public function createProductType(Request $request)
    {
        $request->validate([
            'product_type' => 'required',
            'product_unit' => 'required'
        ]);

        Auth::user()->userable->product_type()->create([
            'type' => $request->product_type,
            'unit' => $request->product_unit
        ]);

        session()->flash('success', 'Product type successfully created!!');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
