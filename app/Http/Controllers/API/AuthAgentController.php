<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthAgentController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'address' => 'required',
            'telp_num' => 'required|numeric|digits_between:10,14',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);


        $agent = Agent::create([
            'name' => $request->name,
            'address' => $request->address,
            'telp_num' => $request->telp_num,
        ]);
        // $user = new User();
        // $user->userable_type = Agent::class;
        // $user->userable_id = $agent->id;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->save();
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'userable_type' => Agent::class,
            'userable_id' => $agent->id,
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $validatedData, 'access_token' => $accessToken], 201);
    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if (!auth()->attempt($login)) {
            return response(['message' => 'This User does not exist, check your details'], 400);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
}
