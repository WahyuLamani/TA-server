<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Client\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();
        return view('distributor.distributor', compact('distributors'));
    }

    public function details(Distributor $distributor)
    {
        dd($distributor);
    }

    public function destroy(Distributor $distributor)
    {
        $distributor->delete();
        User::where('userable_id', $distributor->id)->delete();
        // User::find($distributor->id, 'userable_id')->token()->revoke();
        session()->flash('success', ucwords('Distributor Has Ben Deleted'));
        return redirect()->to('distributors');
    }
}
