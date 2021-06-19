<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllResource;
use App\Models\Client\Agent;
use App\Models\Server\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthAgentController extends Controller
{
    public function getAuth(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->email])) {
            Auth::user()->last_login = Carbon::now()->toDateTimeString();
            Auth::user()->save();
        }
        // Auth::user()->sendEmailVerificationNotification();
        $token = DB::table('oauth_access_tokens')
            ->select('id')
            ->where('user_id', Auth::user()->id)->first();

        return response(['message' => 'Ur Logined', 'user' => Auth::user(), 'token' => $token->id], 200);
    }

    public function register(Request $request)
    {
        dd($request->address);
        $validatedData = $request->validate([
            // 'name' => 'required|max:55',
            'address' => 'required',
            'telp_num' => 'required|numeric|digits_between:10,14',
            // 'thumnail' => 'image|mimes:jpeg,png,jpg|max:5100',
            // 'email' => 'email|required|unique:users',
            // 'password' => 'required|confirmed'
        ]);
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

        return response(['message' => 'Successfull', 'user' => Auth::user()->userable], 201);
    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($login)) {
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
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Successfully logged out');
    }
}
