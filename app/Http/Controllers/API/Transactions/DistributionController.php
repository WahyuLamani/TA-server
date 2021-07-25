<?php

namespace App\Http\Controllers\API\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllResource;
use App\Models\Client\Container;
use App\Models\Client\Transactions\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DistributionController extends Controller
{
    public function distributedNoOrder(Request $request, Container $container)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }

        if ($container->on_truck === 0) {
            return response(['errors' => 'Please update truck status'], 404);
        }
        if ($container->count_down_amount < $request->amount) {
            return response(['errors' => 'Product on the truck is not enough'], 404);
        }
        $container->count_down_amount = $container->count_down_amount - $request->amount;
        $container->save();
        $distribution = $container->distribution()->create([
            'amount' => $request->amount,
            'info' => $request->info,
            'added_at' => Carbon::now()
        ]);

        return response(['message' => 'Distributed Succesfully', 'Distribution' => new AllResource($distribution)], 200);
    }

    public function distributedWithOrder(Order $order)
    {
        $container = Container::where('agent_id', Auth::user()->userable->id)
            ->where('on_truck', 1)
            ->whereHas('warehouse', function ($q) use ($order) {
                $q->whereHas('product_type', function ($q) use ($order) {
                    $q->where('type', $order->product_type->type);
                });
            })->first();
        if ($container === null) {
            return response(['errors' => "This product not in your truck"], 404);
        }
        if ($container->count_down_amount < $order->req_amount) {
            return response(['errors' => 'Product on the truck is not enough'], 404);
        }
        $container->count_down_amount = $container->count_down_amount - $order->req_amount;
        $container->save();

        $distribution = $container->distribution()->create([
            'order_id' => $order->id,
            'amount' => $order->req_amount,
            'added_at' => Carbon::now()
        ]);
        $order->on_progress = 3;
        $order->save();
        return response(['message' => 'Distributed Succesfully', 'Distribution' => new AllResource($distribution)], 200);
    }
}
