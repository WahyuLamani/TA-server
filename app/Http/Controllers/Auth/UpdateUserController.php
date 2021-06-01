<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Server\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UpdateUserController extends Controller
{


    public function update(Request $request, User $user)
    {
        $company = Company::find($user->userable->id);
        $request->validate([
            'oldpassword' => 'required',
        ]);

        $hashing = $request->oldpassword;
        if (Hash::check($hashing, Auth::user()->password)) {
            if ($request->file('thumnail')) {
                $request->validate([
                    'thumnail' => 'image|mimes:jpeg,png,jpg|max:5100',
                ]);
                if ($company->thumbnail !== 'images/avatar/default.png') {
                    \Storage::delete($company->thumbnail);
                }
                $thumnailUrl = $request->file('thumnail')->store("images/avatar");
                // $company->update([
                //     'thumnail' => $thumnailUrl,
                // ]);
                $company->thumbnail = $thumnailUrl;
                $company->save();
            }

            if ($request->company_name !== $company->company_name) {
                $request->validate([
                    'company_name' => 'required|string|max:255',
                ]);
                // $company->update([
                //     'company_name' => $request->company_name,
                // ]);
                $company->company_name = $request->company_name;
                $company->save();
            }

            if ($request->name !== $company->ceo_name) {
                $request->validate([
                    'name' => 'required|string|max:255',
                ]);
                // $company->update([
                //     'ceo_name' => $request->name,
                // ]);
                $company->ceo_name = $request->name;
                $company->save();
            }

            if ($request->email !== $company->company_email) {
                $request->validate([
                    'email' => 'required|string|email|max:255|unique:users',
                ]);
                // $company->update([
                //     'company_email' => $request->email,
                // ]);
                $company->company_email = $request->email;
                $company->save();
            }

            if ($request->address !== $company->company_address) {
                $request->validate([
                    'address' => 'required|string|max:255',
                ]);
                // $company->update([
                //     'company_address' => $request->address,
                // ]);
                $company->company_address = $request->address;
                $company->save();
            }

            if ($request->telp_num !== $company->company_telp_num) {
                $request->validate([
                    'telp_num' => 'required|numeric|digits_between:10,14',
                ]);
                // $company->update([
                //     'company_telp_num' => $request->telp_num,
                // ]);
                $company->company_telp_num = $request->telp_num;
                $company->save();
            }

            if ($request->password !== null) {
                $request->validate([
                    'password' => 'required|string|min:8|confirmed',
                ]);
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }
            session()->flash('success', ucwords('your profile has successfull updated'));
        } else {
            session()->flash('error', ucwords('password uncorrect'));
        }
        return redirect()->to('profile');
    }
}
