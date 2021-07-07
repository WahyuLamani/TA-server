<?php

namespace App\Http\Controllers;

use App\Models\Client\{Agent, Distributor, Post};
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
        $count = [
            'agent' => Agent::where('company_id', Auth::user()->userable->id)->count(),
            'distributor' => Distributor::all()->count()
        ];
        // $reports = ProblemReporting::select('problem_reportings.*', 'agents.name', 'agents.thumbnail')
        //     ->join('agents', 'agents.id', '=', 'problem_reportings.agent_id')
        //     ->where('agents.company_id', Auth::user()->userable->id)
        //     ->get();
        $posts = Post::byOwner(Agent::class)->byCompanyId(Auth::user()->userable->id)->get();

        // ->where('owner_id', '1')->get();

        // dd($posts);
        // $fecthPost = [];
        // foreach ($posts as $i) {
        //     if ($i->owner->company_id === Auth::user()->userable->id) {
        //         array_push($fecthPost, $i);
        //     }
        // }
        // dd(collect($fecthPost));

        // $sumDisItem = Distribution::join('agents', 'agents.id', '=', 'distributions.agent_id')
        //     ->where('agents.company_id', Auth::user()->userable->id)->sum('amount');
        $sumDisItem = Distribution::whereHas('agent', function ($q) {
            $q->where('company_id', Auth::user()->userable->company_id);
        });
        dd($sumDisItem->sum('amount'));
        // $sum = Model::where('status', 'paid')->sum('sum_field');
        // $date = Carbon::now()->toRfc850String();
        return view('index', compact(['count', 'sumDisItem', 'posts']));
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
