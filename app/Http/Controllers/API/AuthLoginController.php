<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client\Agent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthLoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $login = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required',
        ]);
        if ($login->fails()) {
            return response(['errors' => $login->errors()]);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response(['message' => 'This User does not exist, check your details'], 400);
        } else {
            Auth::user()->last_login = Carbon::now()->toDateTimeString();
            Auth::user()->save();
        }

        $user = Auth::user()->load('userable');
        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        if ($user->userable_type === Agent::class) {
            return response([
                'login' => 'agent',
                'user' => $user,
                'access_token' => $accessToken
            ], 200);
        } else {
            return response([
                'login' => 'distributor',
                'user' => $user,
                'access_token' => $accessToken
            ], 200);
        }
    }
}
