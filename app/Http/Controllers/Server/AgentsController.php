<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentsController extends Controller
{
    public function index()
    {
        $agents = Agent::where('company_id', Auth::user()->userable->id)->get();
        return view('agents.agents', compact('agents'));
    }

    public function details(Agent $agent)
    {
        $agent = User::select('users.email', 'agents.*')
            ->join('agents', 'agents.id', 'users.userable_id')
            ->where('userable_id', $agent->id)->first();
        return view('agents.agent-details', compact('agent'));
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
