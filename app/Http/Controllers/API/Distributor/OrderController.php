<?php

namespace App\Http\Controllers\API\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllResource;
use App\Models\Client\Transactions\Order;
use App\Models\Server\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orderWaiting = Order::where('agent_id', null)
            ->where('distributor_id', Auth::user()->userable->id)->get();
        $orderAccepted = Order::where('on_progress', 1)
            ->where('distributor_id', Auth::user()->userable->id)->get();
        $orderAccepted->load('agent');
        $orderAccepted->load('company');

        $productType = ProductType::all();

        return response([
            'productType' => AllResource::collection($productType),
            'orderWaiting' => AllResource::collection($orderWaiting),
            'orderAccepted' => AllResource::collection($orderAccepted),
            'message' => 'Retrieved successfully'
        ], 200);
    }

    public function store(Request $request)
    {
        $order = Validator::make($request->all(), [
            'req_amount' => 'required|integer',
            'product_type_id' => 'required'
        ]);
        if ($order->fails()) {
            return response(['message' => $order->errors()]);
        }
        $request->user()->userable->order()->create($request->all());

        return response(['message' => 'Order successfully'], 201);
    }

    public function deleteOrder(Order $order)
    {
        if ($order->on_progress === 1) {
            return response(['message' => 'Please confirm with agent who receive this order']);
        } else {
            $order->delete();
            return response(['message' => 'Order deleted'], 200);
        }
    }
}
