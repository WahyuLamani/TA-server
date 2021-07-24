<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\Agent;
use App\Models\Client\Transactions\Distribution;
use App\Models\Server\ProductType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentsController extends Controller
{
    public function index()
    {
        $agents = Agent::where('company_id', Auth::user()->userable->id)->get();
        return view('agents.agents', compact('agents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
        ]);

        $agent = auth()->user()->userable->agent()->create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'thumbnail' => 'images/avatar/default.png',
        ]);
        // $agent = new Agent();
        // $agent->name = ucwords($request->name);
        // $agent->save();

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->email),
            'userable_type' => Agent::class,
            'userable_id' => $agent->id,
        ]);

        // $user->createToken('authToken')->accessToken;
        session()->flash('success', ucwords('Agent successfully created'));
        return redirect()->back();
    }

    public function details(Agent $agent)
    {
        if ($agent->company_id !== Auth::user()->userable->id) {
            abort(404);
        }

        $product_type = ProductType::where('company_id', Auth::user()->userable->id);
        $distribution = Distribution::byAgent($agent->id);
        return view('agents.agent-details', compact([
            'product_type',
            'distribution',
            'agent'
        ]));
    }

    public function destroy(Agent $agent)
    {
        $agent->user->delete();
        $agent->delete();
        // User::find($agent->id, 'userable_id')->token()->revoke();
        session()->flash('success', ucwords('Agent Has Ben Deleted'));
        return redirect()->to('agents');
    }
}
