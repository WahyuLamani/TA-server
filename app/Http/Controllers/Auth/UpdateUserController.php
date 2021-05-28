<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UpdateUserController extends Controller
{
    public function update(Request $request, User $user)
    {
        $request->validate([
            'oldpassword' => 'required',
        ]);

        $hashing = $request->oldpassword;
        if (Hash::check($hashing, $user->password)) {
            if ($request->file('thumnail')) {
                $request->validate([
                    'thumnail' => 'image|mimes:jpeg,png,jpg|max:5100',
                ]);
                \Storage::delete($user->thumnail);
                $thumnailUrl = $request->file('thumnail')->store("images/avatar");
                $user->update([
                    'thumnail' => $thumnailUrl,
                ]);
            }

            if ($request->company_name !== $user->company_name) {
                $request->validate([
                    'company_name' => 'required|string|max:255',
                ]);
                $user->update([
                    'company_name' => $request->company_name,
                ]);
            }

            if ($request->name !== $user->name) {
                $request->validate([
                    'name' => 'required|string|max:255',
                ]);
                $user->update([
                    'name' => $request->name,
                ]);
            }

            if ($request->email !== $user->email) {
                $request->validate([
                    'email' => 'required|string|email|max:255|unique:users',
                ]);
                $user->update([
                    'email' => $request->email,
                ]);
            }

            if ($request->address !== $user->address) {
                $request->validate([
                    'address' => 'required|string|max:255',
                ]);
                $user->update([
                    'address' => $request->address,
                ]);
            }

            if ($request->telp_num !== $user->telp_num) {
                $request->validate([
                    'telp_num' => 'required|numeric|digits_between:10,14',
                ]);
                $user->update([
                    'telp_num' => $request->telp_num,
                ]);
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
        // $this->Validation($request->all());
        // $user->update([
        //     'company_name' => $request->company_name,
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'address' => $request->address,
        //     'telp_num' => $request->telp_num,
        // ]);
    }
}
