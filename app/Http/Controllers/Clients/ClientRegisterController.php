<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client\{Agent, Distributor};
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, Validator};
use Illuminate\Support\Str;

class ClientRegisterController extends Controller
{
    public function distributorRegister(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required|numeric',
            'telp_num' => 'required|numeric|digits_between:10,14',
            // 'thumnail' => 'image|mimes:jpeg,png,jpg|max:5100',
        ]);

        if ($validation->fails()) {
            // $encode = json_encode($validation->errors()->messages());
            return redirect()
                ->route('distributor.register')
                ->with('error', 'Harap Lengkapi formulir dengan benar !')
                ->withInput();
        }

        $name = $request->firstName . ' ' . $request->lastName;
        $address = $request->address . ' ,' . $request->kota . '. Kode Pos ' . $request->kode_pos;

        $distributor = Distributor::create([
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'address' => $address,
            'thumbnail' => 'images/avatar/default.png',
            'telp_num' => $request->telp_num,
        ]);
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'userable_type' => Distributor::class,
            'userable_id' => $distributor->id,
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            Auth::user()->last_login = Carbon::now()->toDateTimeString();
            Auth::user()->save();
        }
        return redirect()->route('clients');
    }


    public function agentRegister(Request $request)
    {
        $request->validate(['email' => 'email|required']);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->email])) {
            Auth::user()->last_login = Carbon::now()->toDateTimeString();
            Auth::user()->userable_type = Agent::class;
            Auth::user()->save();
            return redirect()->route('handle');
        } else {
            return redirect()->route('agent.register')->with('error', 'Email tidak Terdaftar');
        }
    }

    public function agentRegisterStepTwo(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'address' => 'required',
            'telp_num' => 'required|numeric|digits_between:10,14',
        ]);

        Auth::user()->password = Hash::make($request->password);
        Auth::user()->last_login = Carbon::now()->toDateTimeString();
        Auth::user()->save();
        $agent = Agent::find(Auth::user()->userable->id);
        $agent->update([
            'address' => $request->address,
            'telp_num' => $request->telp_num,
        ]);

        return redirect()->route('handle');
    }
}
