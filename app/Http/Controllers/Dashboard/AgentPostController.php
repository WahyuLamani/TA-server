<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client\Post;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class AgentPostController extends Controller
{
    public function detail(Post $post)
    {
        return view('reporting.agent-reporting', compact('post'));
    }
}
