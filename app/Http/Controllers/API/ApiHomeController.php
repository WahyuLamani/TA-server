<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllResource;
use App\Models\Client\Agent;
use App\Models\Server\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiHomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->userable_type === Agent::class) {
            return response(['message' => 'welcome ' . Auth::user()->userable->name], 200);
        } else {
            $company = Company::all();
            $company->load('product_type');
            return response([
                'companyList' => AllResource::collection($company),
                'message' =>  'welcome ' . Auth::user()->userable->name
            ], 200);
        }
    }
}
