<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Server\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use Illuminate\Support\Facades\Storage;


class UpdateUserController extends Controller
{


    public function update(Request $request, User $user)
    {
        $userable = $user->userable;
        $request->validate([
            'oldpassword' => 'required',
        ]);

        $hashing = $request->oldpassword;
        if (Hash::check($hashing, Auth::user()->password)) {
            if ($request->file('thumnail')) {
                $request->validate([
                    'thumnail' => 'image|mimes:jpeg,png,jpg|max:5100',
                ]);
                if ($userable->thumbnail !== 'images/avatar/default.png') {
                    Storage::disk('public2')->delete($userable->thumbnail);
                }
                $thumnailUrl = $request->file('thumnail')->store("images/avatar", 'public2');
                // $userable->update([
                //     'thumnail' => $thumnailUrl,
                // ]);
                $userable->thumbnail = $thumnailUrl;
                $userable->save();
            }
            if (Auth::user()->userable_type === Company::class) {
                if ($request->company_name !== $userable->company_name) {
                    $request->validate([
                        'company_name' => 'required|string|max:255',
                    ]);
                    // $userable->update([
                    //     'company_name' => $request->company_name,
                    // ]);
                    $userable->company_name = $request->company_name;
                    $userable->save();
                }
                if ($request->telp_num !== $userable->company_telp_num) {
                    $request->validate([
                        'telp_num' => 'required|numeric|digits_between:10,14',
                    ]);
                    // $userable->update([
                    //     'company_telp_num' => $request->telp_num,
                    // ]);
                    $userable->company_telp_num = $request->telp_num;
                    $userable->save();
                }
                if ($request->name !== $userable->ceo_name) {
                    $request->validate([
                        'name' => 'required|string|max:255',
                    ]);
                    // $userable->update([
                    //     'ceo_name' => $request->name,
                    // ]);
                    $userable->ceo_name = $request->name;
                    $userable->save();
                }
                if ($request->email !== $userable->company_email) {
                    $request->validate([
                        'email' => 'required|string|email|max:255|unique:users',
                    ]);
                    // $userable->update([
                    //     'company_email' => $request->email,
                    // ]);
                    $userable->company_email = $request->email;
                    $userable->save();
                }
                if ($request->address !== $userable->company_address) {
                    $request->validate([
                        'address' => 'required|string|max:255',
                    ]);
                    // $userable->update([
                    //     'company_address' => $request->address,
                    // ]);
                    $userable->company_address = $request->address;
                    $userable->save();
                }
            } else {
                if ($request->name !== $userable->name) {
                    $request->validate([
                        'name' => 'required|string|max:255',
                    ]);
                    // $userable->update([
                    //     'name' => $request->name,
                    // ]);
                    $userable->name = $request->name;
                    $userable->save();
                }


                if ($request->email !== $user->email) {
                    $request->validate([
                        'email' => 'required|string|email|max:255|unique:users',
                    ]);
                    // $userable->update([
                    //     'email' => $request->email,
                    // ]);
                    $user->email = $request->email;
                    $user->save();
                }

                if ($request->address !== $userable->address) {
                    $request->validate([
                        'address' => 'required|string|max:255',
                    ]);
                    // $userable->update([
                    //     'address' => $request->address,
                    // ]);
                    $userable->address = $request->address;
                    $userable->save();
                }


                if ($request->telp_num !== $userable->telp_num) {
                    $request->validate([
                        'telp_num' => 'required|numeric|digits_between:10,14',
                    ]);
                    // $userable->update([
                    //     'telp_num' => $request->telp_num,
                    // ]);
                    $userable->telp_num = $request->telp_num;
                    $userable->save();
                }

                if ($request->password !== null) {
                    $request->validate([
                        'password' => 'required|string|min:8|confirmed',
                    ]);
                    $user->update([
                        'password' => Hash::make($request->password),
                    ]);
                }
            }


            session()->flash('success', ucwords('your profile has successfull updated'));
        } else {
            session()->flash('error', ucwords('password uncorrect'));
        }
        return redirect()->to('profile');
    }
}
