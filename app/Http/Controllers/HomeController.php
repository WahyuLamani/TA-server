<?php

namespace App\Http\Controllers;

use App\Models\Client\Agent;
use App\Models\Client\ProblemReporting;
use App\Models\Client\Transactions\Distribution;
use App\Models\Server\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = Agent::where('company_id', Auth::user()->userable->id)->count();
        $sumDisItem = Distribution::where('agent_id', Auth::user()->id)->sum('dis_item');
        // $sum = Model::where('status', 'paid')->sum('sum_field');
        // $date = Carbon::now()->toRfc850String();
        return view('index', compact(['count', 'sumDisItem']));
    }

    public function profile()
    {
        $reports = ProblemReporting::join('agents', 'agents.id', '=', 'problem_reportings.agent_id')
            ->where('agents.company_id', Auth::user()->userable->id)
            ->get();
        // dd($reports);
        return view('profile', compact('reports'));
    }

    public function edit()
    {
        $user = Auth::user()->userable;
        return view('edit-profile', compact('user'));
    }

    public function form()
    {
        if (!Auth::user()->userable) {
            return view('company.register');
        } else {
            return redirect(route('home'));
        }
    }
}
