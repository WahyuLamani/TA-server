<?php

namespace App\Http\Controllers;

use App\Models\Client\{Agent, Distributor, Post};
use App\Models\Client\Transactions\Distribution;
use App\Models\Server\Company;
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
        $agent = Post::byOwner(Agent::class)->byCompanyId(Auth::user()->userable->id)->get();
        $distributors = Post::byOwner(Distributor::class)->get();
        session()->put([
            'agent' => $agent,
            'distributors' => $distributors
        ]);

        // $fecthPost = [];
        // foreach ($posts as $i) {
        //     if ($i->owner->company_id === Auth::user()->userable->id) {
        //         array_push($fecthPost, $i);
        //     }
        // }
        $agentOnline = Agent::where('company_id', Auth::user()->userable->id)
            ->byContainerOnTruck()->get();
        // code lama
        // $sumDisItem = Distribution::whereHas('container', function ($q) {
        //     $q->whereHas('agent', function ($q) {
        //         $q->where('company_id', Auth::user()->userable->id);
        //     });
        // })->get();
        // code baru
        $distributed = Distribution::byCompany(Auth::user()->userable->id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('index', compact(['count', 'distributed', 'agentOnline']));
    }

    public function handle()
    {
        if (Auth::user()->userable_type == Company::class && !Auth::user()->userable) {
            return view('company.register');
        }
        if (Auth::user()->userable_type == Agent::class && !Auth::user()->userable->address) {
            return view('clients.register.agent-form-register');
        }
        if (Auth::user()->userable_type == Agent::class || Auth::user()->userable_type == Distributor::class) {
            return redirect(route('clients'));
        } else {
            return redirect(route('home'));
        }
    }
}
