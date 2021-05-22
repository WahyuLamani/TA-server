<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function profile()
    {
        return view('profile');
    }

    public function edit()
    {
        return view('edit-profile', [
            'user' => Auth::user()
        ]);
    }

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
            session()->flash('success', ucwords('Your blog is successfully Updated'));
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

    protected function Validation(array $data)
    {
        return Validator::make($data, [
            'company_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'telp_num' => ['required', 'numeric', 'digits_between:10,14'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();
    }
}
