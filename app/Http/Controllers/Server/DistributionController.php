<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\Transactions\Distribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistributionController extends Controller
{
    public function index()
    {
        return view('distribution.index', [
            'distributions' =>
            Distribution::select('distributions.*', 'agents.name', 'agents.thumbnail', 'distributors.name as disname', 'distributors.thumbnail as disthumbnail')
                ->join('distributors', 'distributors.id', 'distributions.distributor_id')
                ->join('agents', 'agents.id', 'distributions.agent_id')
                ->where('agents.company_id', Auth::user()->userable->id)->get()
        ]);
    }
}
