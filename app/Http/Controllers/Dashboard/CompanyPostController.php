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

        $post = Auth::user()->userable->post()->create([
            'post' => $request->postBody
        ]);
        // session()->flash('success', ucwords('Post Created'));
        // return redirect()->back();
        return response(['message' => $post], 200);
    }

    public function updatePost(Request $request)
    {
        $post = Post::find($request->id);
        $post->post = $request->postBody;
        $post->save();
        return response(['message' => $post], 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('success', ucwords('Post Deleted'));
        return redirect()->back();
    }

    public function saveImages(Request $request)
    {
        $imgUrl = $request->file('image')->store("images/posts", 'public2');
        return response(['imgUrl' => asset('uploads/' . $imgUrl)], 200);
    }
}
