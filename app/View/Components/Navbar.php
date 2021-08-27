<?php

namespace App\View\Components;

use App\Models\Client\{Agent, Distributor, Post};
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $agents = Post::byOwner(Agent::class)->byCompanyId(Auth::user()->userable->id)->get();
        $distributors = Post::byOwner(Distributor::class)->get();

        return view('components.navbar', compact([
            'agents',
            'distributors'
        ]));
    }
}
