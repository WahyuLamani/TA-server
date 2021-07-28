<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Server\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->userable_type === Company::class) {
            return redirect(route('home'));
        }
        return view('clients.index');
    }
}
