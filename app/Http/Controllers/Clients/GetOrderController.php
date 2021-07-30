<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client\Container;
use App\Models\Client\Transactions\Distribution;
use App\Models\Client\Transactions\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetOrderController extends Controller
{
    public function acceptOrder(Order $order)
    {
        if ($order->on_progress === 'Accepted') {
            $order->update([
                'on_progress' => 1,
                'agent_id' => null,
            ]);
            return redirect()->route('clients')->with('success', 'Order Canceled');
        }
        $order->update([
            'on_progress' => 2,
            'agent_id' => Auth::user()->userable->id,
        ]);
        return redirect()->route('clients')->with('success', 'order diterima');
    }

    public function delete(Order $order)
    {
        $order->delete();
        return redirect()->route('clients')->with('success', 'order dicancel');
    }

    public function completeOrder(Order $order)
    {
        if ($order->distribution !== null) {
            $order->update([
                'on_progress' => 3
            ]);
            return redirect()->route('clients')->with('success', 'Order telah diterima');
        }

        return redirect()->route('clients')->with('error', 'Orderan belum didistribusikan');
    }

    public function distributed(Request $request, Order $order)
    {
        if ($order->distribution !== null) {
            return redirect()->route('clients')->with('error', 'Orderan telah selesai, pastikan Distributor mengupdate orderan');
        }
        $container = Container::where('agent_id', Auth::user()->userable->id)
            ->where('on_truck', 1)
            ->whereHas('warehouse', function ($q) use ($order) {
                $q->whereHas('product_type', function ($q) use ($order) {
                    $q->where('type', $order->product_type->type);
                });
            })->first();

        if ($container === null) {
            return redirect()->route('clients')->with('error', 'Tidak ada produk ini didalam truck anda');
        }
        if ($container->count_down_amount < $order->req_amount) {
            return redirect()->route('clients')->with('error', 'Produk ditruk tidak cukup');
        }
        $container->count_down_amount = $container->count_down_amount - $order->req_amount;
        $container->save();

        $container->distribution()->create([
            'order_id' => $order->id,
            'amount' => $order->req_amount,
            'added_at' => Carbon::now(),
            'info' => $request->info ?? null
        ]);
        return redirect()->route('clients')->with('success', 'Orderan Terdistribusikan, pastikan Distributor mengupdate order !!');
    }

    public function order(Request $request)
    {
        $product = explode(',', $request->product);
        $request->validate([
            'amount' => 'required|integer',
            'product' => 'required'
        ]);
        $request->user()->userable->order()->create([
            'company_id' => $product[1],
            'product_type_id' => $product[0],
            'req_amount' => $request->amount,
        ]);
        return redirect()->route('clients')->with('success', 'Order Berhasil, Mohon tunggu hingga di terima Agent !');
    }
}
