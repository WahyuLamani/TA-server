<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\Agent;
use App\Models\Client\Transactions\Distribution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        // $agent = User::select('users.email', 'users.last_login', 'agents.*')
        //     ->join('agents', 'agents.id', 'users.userable_id')
        //     ->where('userable_id', $agent->id)->first();

        $distribution = Distribution::select('agents.name', 'distributions.*')
            ->join('agents', 'agents.id', 'distributions.agent_id')->get();
        return view('agents.agent-details', compact([
            'agent',
            'distribution'
        ]));
    }

    public function liveSearch(Request $request)
    {
        $data = Distribution::select('agents.name', 'distributions.*')
            ->join('agents', 'agents.id', 'distributions.agent_id')
            ->where('added_at', 'like', '%' . $request->get('searchQ') . '%', 'and', 'agents.id', $request->get('agent_id'))->get();
        return response($data);
    }

    public function destroy(Agent $agent)
    {
        $agent->delete();
        User::where('userable_id', $agent->id)->delete();
        // User::find($agent->id, 'userable_id')->token()->revoke();
        session()->flash('success', ucwords('Agent Has Ben Deleted'));
        return redirect()->to('agents');
    }
}
