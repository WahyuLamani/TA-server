<?php

namespace App\Http\Controllers\API\Agent;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllResource;
use App\Models\Client\Transactions\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetOrderController extends Controller
{
    public function acceptOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->update([
            'on_progress' => 2,
            'agent_id' => $request->user()->userable->id,
            'company_id' => $request->user()->userable->company->id
        ]);
        return response(['message' => 'Order accepted'], 200);
    }

    public function cancelReceiveOrder(Order $order)
    {
        $order->update([
            'on_progress' => 1,
            'agent_id' => null,
            'company_id' => null
        ]);

        return response(['message' => 'Order receive canceled'], 200);
    }

    public function deleteReceiveOrder(Order $order)
    {
        $order->delete();

        return response(['message' => 'Order receive deleted'], 200);
    }
}
