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
            return response(['message' => $validator->errors()]);
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

        return response(['message' => 'Ur Logined', 'user' => Auth::user(), 'token' => $token], 200);
    }


    /**
     * register user if @var function_getAuth succesfull
     * accept identifier @var Auth request from Bearer Token
     */
    public function register(Request $request)
    {

        // $validatedData = $request->validate([
        //     // 'name' => 'required|max:55',
        //     'address' => 'required',
        //     'telp_num' => 'required|numeric|digits_between:10,14',
        //     // 'thumnail' => 'image|mimes:jpeg,png,jpg|max:5100',
        //     // 'email' => 'email|required|unique:users',
        //     // 'password' => 'required|confirmed'
        // ]);

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'address' => 'required',
            'telp_num' => 'required|numeric|digits_between:10,14',
        ]);
        if ($validator->fails()) {
            return response(['message' => $validator->errors()]);
        }

        /**
         * get agent data
         */
        // $user = User::where('email', $request->email)->first();
        Auth::user()->password = Hash::make($request->password);
        Auth::user()->save();
        // $agent = Agent::find($user->userable->id);
        $agent = Agent::find(Auth::user()->userable->id);
        $agent->update([
            'address' => $request->address,
            'telp_num' => $request->telp_num,
        ]);
        // $user = new User();
        // $user->userable_type = Agent::class;
        // $user->userable_id = $agent->id;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->save();
        // $user = User::create([
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'userable_type' => Agent::class,
        //     'userable_id' => $agent->id,
        // ]);
        // if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
        //     Auth::user()->last_login = Carbon::now()->toDateTimeString();
        //     Auth::user()->save();
        // }
        // // Auth::user()->sendEmailVerificationNotification();

        // $accessToken = $user->createToken('authToken')->accessToken;

        return response(['message' => 'Successfull', 'user' => $agent], 200);
    }

    public function login(Request $request)
    {
        $login = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required',
        ]);
        if ($login->fails()) {
            return response(['message' => $login->errors()]);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
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
        ], 200);
    }
    public function logout()
    {
        //
    }
}
