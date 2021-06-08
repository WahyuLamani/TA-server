<?php

namespace App\Http\Controllers;

use App\Models\Client\{Agent, Distributor, ProblemReporting};
use App\Models\Client\Transactions\Distribution;
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
        $sumDisItem = Distribution::join('agents', 'agents.id', '=', 'distributions.agent_id')
            ->where('agents.company_id', Auth::user()->userable->id)->sum('dis_item');
        // $sum = Model::where('status', 'paid')->sum('sum_field');
        // $date = Carbon::now()->toRfc850String();
        return view('index', compact(['count', 'sumDisItem']));
    }

    public function profile()
    {
        $reports = ProblemReporting::select('problem_reportings.*', 'agents.name', 'agents.thumbnail')
            ->join('agents', 'agents.id', '=', 'problem_reportings.agent_id')
            ->where('agents.company_id', Auth::user()->userable->id)
            ->get();
        return view('profile', compact('reports'));
    }

    public function edit()
    {
        $user = Auth::user()->userable;
        // $array = explode('/', $user->thumbnail);
        // $user->thumbnail = end($array);
        return view('edit-profile', compact('user'));
    }

    public function handle()
    {
        if (!Auth::user()->userable) {
            return view('company.register');
        } elseif (Auth::user()->userable_type == Agent::class || Auth::user()->userable_type == Distributor::class) {
            Auth::guard()->logout();
            return redirect(route('login'));
        } else {
            return redirect(route('home'));
        }
    }
}
