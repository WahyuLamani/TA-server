<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\Transactions\Distribution;
use App\Models\Server\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistributionController extends Controller
{
    public function index()
    {
        $distributions = Distribution::byCompany(auth()->user()->userable->id);
        $product_type = ProductType::where('company_id', auth()->user()->userable->id)->get();
        return view('distribution.distribution', compact([
            'distributions',
            'product_type',
        ]));
    }
}
