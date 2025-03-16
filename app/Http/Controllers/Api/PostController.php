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
        $post= Post::all();
        return PostResource::collection($post);

    }

    public function show($id){
        $post= Post::findOrFail($id);
        // return [
        //     "id" => $post -> id ,
        //     "title" => $post -> title,
        //     "description" => $post -> description,
        //     "creator" => $post -> user -> name,
        //     "image" => $post -> image,
        // ];
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

        // return [
        //     "id" => $post -> id ,
        //     "title" => $post -> title,
        //     "description" => $post -> description,
        //     "creator" => $post -> user -> name,
        //     "image" => $post -> image,
        // ];

        return new PostResource($post);
    }
}
