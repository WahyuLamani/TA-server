<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client\Post;
use Illuminate\Http\Request;

class DistributorPostController extends Controller
{
    public function detail(Post $post)
    {
        return view('reporting.distributor-reporting', compact('post'));
    }
}
