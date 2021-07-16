<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllResource;
use App\Models\Client\Agent;
use App\Models\Client\Container;
use App\Models\Client\Post;
use App\Models\Server\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiHomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->userable_type === Agent::class) {
            $post = Post::byAgentId(Auth::user()->userable->id)->get();
            $container = Container::where('agent_id', Auth::user()->userable->id)
                ->where('count_down_amount', '>', '0')
                ->get();

            return response([
                'message' => 'welcome ' . Auth::user()->userable->name,
                'posts' => AllResource::collection($post),
                'containers' => AllResource::collection($container)
            ], 200);
        } else {
            $company = Company::all();
            $company->load('product_type');
            return response([
                'message' =>  'welcome ' . Auth::user()->userable->name,
                'companyList' => AllResource::collection($company)
            ], 200);
        }
    }
}
