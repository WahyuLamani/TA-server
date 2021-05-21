<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->Validation($request->all());
        $user->update([
            'company_name' => $request->company_name,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'telp_num' => $request->telp_num,
        ]);
        session()->flash('success', ucwords('Your blog is successfully Updated'));
        return redirect()->to('profile');
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
        ]);
    }
}
