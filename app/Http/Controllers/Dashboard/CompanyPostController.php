<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyPostController extends Controller
{
    public function posting(Request $request)
    {
        $request->validate([
            'post' => 'required|string'
        ]);

        Auth::user()->userable->post()->create([
            'post' => $request->post
        ]);
        session()->flash('success', ucwords('Post Created'));
        return redirect()->back();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('success', ucwords('Post Deleted'));
        return redirect()->back();
    }
}
