<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\Distributor;
use App\Models\Client\Transactions\Distribution;
use App\Models\Server\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();
        return view('distributor.distributor', compact('distributors'));
    }

    public function details(Distributor $distributor)
    {
        $product_type = ProductType::where('company_id', Auth::user()->userable->id);
        $distribution = Distribution::byDistributor($distributor->id);

        return view('distributor.distributor-details', compact([
            'distributor',
            'product_type',
            'distribution'
        ]));
    }

    public function destroy(Distributor $distributor)
    {
        $distributor->user->delete();
        $distributor->delete();
        // User::find($distributor->id, 'userable_id')->token()->revoke();
        session()->flash('success', ucwords('Distributor Has Ben Deleted'));
        return redirect()->to('distributors');
    }
}
