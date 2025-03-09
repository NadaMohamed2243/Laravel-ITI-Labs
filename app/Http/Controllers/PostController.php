<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {

        //select * from posts =
        $posts = Post::all();  //==> Post --> model name
        // dd($posts);  //==> this will show collection object(Eloquent)

        // $l=Post::where("title",'=','First Post')->get();
        // dd($l);

        return view("posts.index", ['posts' => $posts]);
    }

    public function show($id)
    {
        //catch the passed parameter from url
        // dd($id);

        $post = [
            'id' => 1,
            'title' => 'laravel',
            'posted_by' => [
                'name' => 'Ahmed',
                'email' => 'Ahmed@gmail.com',
                'created_at' => 'Tuesday 25th of March 2025 12:47:00 PM',
            ],
            'description' => 'Catch the passed parameter from URL.'
        ];
        return view("posts.show", ['post' => $post]);
    }

    public function create()
    {
        return view("posts.create");
    }

    public function store()
    {
        // 1- get the form submission data into variables
        // 2- data validation
        // 3- store the data in the database
        // 4- redirection

        // $post = request()->all();
        // dd($post);

        // $title= $post["title"];
        $title = request()->title;

        // $description= $post["description"];
        $description = request()->description;

        // $creator= $post["creator"];
        $creator = request()->creator;

        // dd($title, $description , $creator);

        //go to the index page (all posts)
        // return to_route('posts.index');

        //go to show post page
        return to_route('posts.show', 1);
    }

    public function edit($id)
    {
        $post = ['id' => $id, 'title' => 'laravel', 'posted_by' => 'Ahmed', 'description' => 'Catch the passed parameter from URL.'];
        return view('posts.edit', ['post' => $post]);
    }

    public function update($id)
    {
        //1- Validate form data
        //2- Find the existing post
        //3- Update the post's details
        //4- redirection


        $data = request()->all();
        $title = request()->title;
        $description = request()->description;
        $creator = request()->creator;

        // dd($data, $title, $description , $id);

        return to_route('posts.index');
    }

    public function destroy($id)
    {
        // The destroy function filters out the post
        // redirects to the index page.
        return to_route('posts.index');
    }

}
