<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Server\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function create(Request $request)
    {
        // validation
        $data = $this->Validation($request->all());
        if (!isset($data['thumbnail'])) {
            $data['thumbnail'] = 'images/avatar/default.png';
        }
        $data['slug'] = Str::slug($request->company_name);

        // store data
        $Company = Company::create($data);
        $user = User::find(Auth::user()->id);
        $user->userable_type = Company::class;
        $user->userable_id = $Company->id;
        $user->save();
        return redirect(route('home'));
    }

    protected function Validation(array $data)
    {
        return Validator::make($data, [
            'company_name' => ['required', 'string'],
            'company_address' => ['required', 'string'],
            'ceo_name' => ['required', 'string'],
            'company_email' => ['required', 'string', 'email'],
            'company_telp_num' => ['required', 'numeric', 'digits_between:10,14'],
            'about' => ['required', 'string'],
            'thumbnail' => ['image', 'mimes:jpeg,png,jpg', 'max:5100'],
        ])->validate();
    }
}
