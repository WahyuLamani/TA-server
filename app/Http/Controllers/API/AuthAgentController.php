<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client\Agent;
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
            'email' => 'email|required|unique:agents',
            'password' => 'required|confirmed'
        ]);
        $hashing = Hash::make($request->password);
        $agent = Agent::create([
            'user_id' => '1',
            'name' => $request->name,
            'address' => $request->address,
            'telp_num' => $request->telp_num,
            'email' => $request->email,
            'password' => $hashing,
        ]);
        $accessToken = $agent->createToken('authToken')->accessToken;

        return response(['user' => $agent, 'access_token' => $accessToken], 201);
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
