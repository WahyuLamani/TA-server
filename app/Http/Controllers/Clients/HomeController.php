<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client\{Agent, Container, Distributor, Post};
use App\Models\Client\Transactions\Distribution;
use App\Models\Client\Transactions\Order;
use App\Models\Server\{Company, ProductType};
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        if (Auth::user()->userable_type === Distributor::class) {
            // if (Auth::user()->userable->location == null) {
            //     return redirect()->route('distloct.view');
            // }
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
            $receivedOrders = Order::where('agent_id', Auth::user()->userable->id)
                ->where('on_progress', 2)
                ->orWhere('on_progress', 4)
                ->latest()->get();

            $ContainersModel = Container::where('agent_id', Auth::user()->userable->id)
                ->where('count_down_amount', '>', '0')->get();

            /* kelompokan data yang sama */
            $containers = array();
            foreach ($ContainersModel as $container) {
                $containers[$container->warehouse->product_type->unit . ' ' . $container->warehouse->product_type->type][] = $container->amount;
            }
            $distributions = Distribution::byAgent(Auth::user()->userable->id)->get();

            /**selesai */
            return view('clients.index', compact([
                'receivedOrders',
                'containers',
                'distributions'
            ]));
        }
    }

    public function saveKoordinats(Request $request)
    {
        $coordinats = Auth::user()->userable->track;
        Auth::user()->userable->track()->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'coordinats' => $coordinats->coordinats . ',' . $request->coordinats
        ]);

        // return response(['message' => 'success']);
    }
}
