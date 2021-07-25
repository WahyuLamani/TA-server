<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client\Distributor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{Auth, Hash, Validator};

class AuthDistributorController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'address' => 'required',
            'telp_num' => 'required|numeric|digits_between:10,14',
            // 'thumnail' => 'image|mimes:jpeg,png,jpg|max:5100',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }

        $distributor = Distributor::create([
            'name' => ucwords($request->name),
            'slug' => Str::slug($request->name),
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
        $user->load('userable');
        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            Auth::user()->last_login = Carbon::now()->toDateTimeString();
            Auth::user()->save();
        }

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken], 201);
    }
}
