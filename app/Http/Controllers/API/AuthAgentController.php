<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client\Agent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthAgentController extends Controller
{

    public function getAuth(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'email|required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->email])) {
            Auth::user()->last_login = Carbon::now()->toDateTimeString();
            Auth::user()->save();
            $token = Auth::user()->createToken('authToken')->accessToken;

            // if (!Auth::user()->email_verified_at) {
            //     // Auth::user()->sendEmailVerificationNotification();
            // }
        } else {
            return response(['message' => 'Email or password uncorrect'], 404);
        }

        return response(['message' => 'Register', 'user' => Auth::user(), 'token' => $token], 200);
    }


    /**
     * register user if @var function_getAuth succesfull
     * accept identifier @var Auth request from Bearer Token
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'address' => 'required',
            'telp_num' => 'required|numeric|digits_between:10,14',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }

        Auth::user()->password = Hash::make($request->password);
        Auth::user()->last_login = Carbon::now()->toDateTimeString();
        Auth::user()->save();
        $agent = Agent::find(Auth::user()->userable->id);
        $agent->update([
            'address' => $request->address,
            'telp_num' => $request->telp_num,
        ]);

        return response(['message' => 'Successfull', 'user' => $agent], 200);
    }
}
