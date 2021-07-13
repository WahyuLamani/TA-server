<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client\Transactions\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowOrderController extends Controller
{
    public function show()
    {
        $orderLists = Order::where('company_id', Auth::user()->userable->id)
            ->where('on_progress', 0)
            ->paginate(4, ['*'], 'orderLists');
        $orderAccepts = Order::where('company_id', Auth::user()->userable->id)
            ->where('on_progress', 1)
            ->paginate(4, ['*'], 'orderAccepts');

        return view('order.order', compact([
            'orderLists',
            'orderAccepts'
        ]));
    }
}
