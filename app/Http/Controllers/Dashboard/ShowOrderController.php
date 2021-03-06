<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client\Agent;
use App\Models\Client\Transactions\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowOrderController extends Controller
{
    public function show()
    {
        $orderLists = Order::where('company_id', Auth::user()->userable->id)
            ->where('on_progress', 1)
            ->orWhere('on_progress', 3)
            ->paginate(6, ['*'], 'orderLists');
        $orderAccepts = Order::where('company_id', Auth::user()->userable->id)
            ->where('on_progress', 2)
            ->paginate(6, ['*'], 'orderAccepts');
        $agents = Agent::where('company_id', Auth::user()->userable->id)->get();

        return view('order.order', compact([
            'orderLists',
            'orderAccepts',
            'agents',
        ]));
    }
}
