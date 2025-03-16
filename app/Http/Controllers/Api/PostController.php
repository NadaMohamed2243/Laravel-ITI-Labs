<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(){
        // $posts= Post::all();
         //eager loading and pagination
        $posts = Post::with('user')->paginate(10);
        return PostResource::collection($posts);

    }

    public function show($id){
        // $post= Post::findOrFail($id);
        //eager loading
        $post = Post::with('user')->findOrFail($id);
        return new PostResource($post);

    }

    public function store(PostRequest $request)
    {

        $post = Post::create([
            'title' => request()->title,
            'description' => request()->description,
            'user_id' => request()->creator,
            'image' => request()->file('image') ?? null,
        ]);

        return new PostResource($post);
    }
}
