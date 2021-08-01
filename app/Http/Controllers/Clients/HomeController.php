<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client\{Agent, Container, Distributor, Post};
use App\Models\Client\Transactions\Distribution;
use App\Models\Client\Transactions\Order;
use App\Models\Server\{Company, ProductType};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        if (Auth::user()->userable_type === Distributor::class) {

            $orderWaiting = Order::where('agent_id', null)
                ->where('distributor_id', Auth::user()->userable->id)->get();
            $orderAccepted = Order::where('on_progress', 2)
                ->where('distributor_id', Auth::user()->userable->id)->get();

            $productList = ProductType::byValueOnWarehouse()->get();

            $distributions = Distribution::byDistributor(Auth::user()->userable->id)->get();

            return view('clients.index', compact([
                'orderWaiting',
                'orderAccepted',
                'productList',
                'distributions',
            ]));
        }
        if (Auth::user()->userable_type === Agent::class) {
            $orderLists  = Order::where('on_progress', 1)
                ->where('company_id', Auth::user()->userable->company_id)
                ->orWhere('company_id', null)->get();

            $receivedOrders = Order::where('agent_id', Auth::user()->userable->id)
                ->where('on_progress', '!=', 1)->get();
            $containers = Container::where('agent_id', Auth::user()->userable->id)
                ->where('count_down_amount', '>', '0')->get();

            $distributions = Distribution::byAgent(Auth::user()->userable->id)->get();

            return view('clients.index', compact([
                'orderLists',
                'receivedOrders',
                'containers',
                'distributions'
            ]));
        }
    }
}
