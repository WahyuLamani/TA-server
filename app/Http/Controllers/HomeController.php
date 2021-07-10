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
        $posts = Post::byOwner(Agent::class)->byCompanyId(Auth::user()->userable->id)->get();

        // $fecthPost = [];
        // foreach ($posts as $i) {
        //     if ($i->owner->company_id === Auth::user()->userable->id) {
        //         array_push($fecthPost, $i);
        //     }
        // }
        // dd(collect($fecthPost));

        // code lama
        // $sumDisItem = Distribution::whereHas('container', function ($q) {
        //     $q->whereHas('agent', function ($q) {
        //         $q->where('company_id', Auth::user()->userable->id);
        //     });
        // })->get();
        // code baru
        $sumDisItem = Distribution::byAgent(Auth::user()->userable->id)->sum('amount');
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
