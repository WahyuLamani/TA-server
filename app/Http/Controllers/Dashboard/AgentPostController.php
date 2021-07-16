<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client\Agent;
use App\Models\Client\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class AgentPostController extends Controller
{
    public function detail(Post $post)
    {
        if ($post->owner->company_id !== Auth::user()->userable->id) {
            abort(404);
        }
        return view('reporting.agent-reporting', compact('post'));
    }
}
