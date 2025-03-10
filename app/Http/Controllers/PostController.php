<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(10);

        return view("posts.index", ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view("posts.show", ['post' => $post]);
    }

    public function create()
    {
        //we want the creator dropdown menu to be filled with the users from users table
        //1- get all users from users table
        //2- pass the users to the view


        $users = User::all();
        return view("posts.create", ["users" => $users]);
    }

    public function store(PostRequest $request)
    {
        // 1- get the form submission data into variables
        // 2- data validation
        // 3- store the data in the database
        // 4- redirection

        $title = request()->title;
        $description = request()->description;
        $creator = request()->creator;

        //==========================data validation================================
        // request()->validate([
        //     'title' => ['required','min:3' , 'unique:posts'],
        //     'description' => ['required' ,'min:10'],
        //     'creator' => ['required','exists:users,id'],
        // ]);

        $post = Post::create(["title" => $title, 'description' => $description, 'user_id' => $creator]);
        return to_route('posts.show', $post->id);
    }

    public function edit($id)
    {
        $users = User::all();
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    public function update(PostRequest $request,$id)
    {
        //1- Validate form data
        //2- Find the existing post
        //3- Update the post's details
        //4- redirection

        $post = Post::find($id);
        $title = request()->title;
        $description = request()->description;
        $creator = request()->creator;


        // request()->validate([
        //     'title' => ['required','min:3' , Rule::unique('posts')->ignore($id)],
        //     'description' => ['required' ,'min:10'],
        //     'creator' => ['required','exists:users,id'],
        // ]);


        $post->update([
            'title' => $title,
            'description' => $description,
            'user_id' => $creator,
        ]);


        return to_route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();


        return to_route('posts.index');
    }

}
