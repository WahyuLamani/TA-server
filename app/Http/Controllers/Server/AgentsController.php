<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllResource;
use App\Models\Client\Agent;
use App\Models\Client\Transactions\Distribution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AgentsController extends Controller
{
    public function index()
    {
        $agents = Agent::where('company_id', Auth::user()->userable->id)->get();
        return view('agents.agents', compact('agents'));
    }

    public function create(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|string|email|unique:user',
        // ]);
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect('agents')
                ->withErrors($validator)
                ->withInput(['data' => 'kambing']);
        }
    }

    public function details(Agent $agent)
    {
        $agent = User::select('users.email', 'users.last_login', 'agents.*')
            ->join('agents', 'agents.id', 'users.userable_id')
            ->where('userable_id', $agent->id)->first();

        $distribution = Distribution::select('agents.name', 'distributions.*')
            ->join('agents', 'agents.id', 'distributions.agent_id')->get();
        return view('agents.agent-details', compact([
            'agent',
            'distribution'
        ]));
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
