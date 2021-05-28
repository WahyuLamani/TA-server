<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Server\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function create(Request $request)
    {
        $data = $this->Validation($request->all());
        Auth::user()->company()->create($data);
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
            'thumnail' => ['image', 'mimes:jpeg,png,jpg', 'max:5100'],
        ])->validate();
    }
}
