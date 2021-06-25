<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client\Distributor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthDistributorController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'address' => 'required',
            'telp_num' => 'required|numeric|digits_between:10,14',
            // 'thumnail' => 'image|mimes:jpeg,png,jpg|max:5100',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $distributor = Distributor::create([
            'name' => ucwords($request->name),
            'company_id' => $request->company_id,
            'address' => $request->address,
            'thumbnail' => 'images/avatar/default.png',
            'telp_num' => $request->telp_num,
        ]);
        // $user = new User();
        // $user->userable_type = Distributor::class;
        // $user->userable_id = $distributor->id;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->save();
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'userable_type' => Distributor::class,
            'userable_id' => $distributor->id,
        ]);

        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            Auth::user()->last_login = Carbon::now()->toDateTimeString();
            Auth::user()->save();
        }

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
        } else {
            Auth::user()->last_login = Carbon::now()->toDateTimeString();
            Auth::user()->save();
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response([
            'user' => Auth::user(),
            'user_detail' => Auth::user()->userable,
            'access_token' => $accessToken
        ]);
    }
    public function logout()
    {
        //
    }
}
