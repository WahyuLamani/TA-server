<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $this->destroyImg($post->post);
        $post->delete();
        return redirect()->back()->with('success', ucwords('Post Deleted'));
    }

    public function saveImages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg|max:5100'
        ]);
        if ($validator->fails()) {
            return response(['error' => 'Ukuran image terlalu besar']);
        }
        $imgUrl = $request->file('image')->store("images/posts", 'public2');
        return response(['imgUrl' => asset('uploads/' . $imgUrl)], 200);
    }

    public function deleteImages(Request $request)
    {
        $this->destroyImg($request->data);
        return response(['message' => 'sucess']);
    }


    public function destroyImg($data)
    {
        $array = array();

        // search string using regex
        preg_match_all("/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/", $data, $array);

        foreach ($array[0] as $filename) {
            Storage::disk('public2')->delete('images/posts/' . $filename);
        }
    }
}
