<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'post' => 'required|string',
            'pict' => 'image|mimes:jpeg,png,jpg|max:5100'
        ]);
        if ($validation->fails()) {
            return response(['errors' => $validation->errors()], 400);
        }
        if (isset($request->pict)) {
            $pictUrl = $request->file('pict')->store("images/posts");
            $post = Auth::user()->userable->post()->create([
                'post' => $request->post,
                'pict' => $pictUrl
            ]);

            return response(['message' => 'Posted', 'post' => new AllResource($post)], 200);
        } else {
            $post = Auth::user()->userable->post()->create([
                'post' => $request->post
            ]);
            return response(['message' => 'Posted', 'post' => new AllResource($post)], 200);
        }
    }
}
