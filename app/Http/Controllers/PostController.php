<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;

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

        // select * from posts where id = $id limit 1
        $post = Post::find($id);   // object type Post Model
        // dd($post);


        //select * from posts where id = $id
        // $post = Post::where('id','=',$id)->get();   // object type collection (not recommended here)
        // dd($post);


        //select * from posts where id = $id limit 1
        // $post = Post::where('id','=',$id)->first();   // object type Post Model
        // dd($post);


        return view("posts.show", ['post' => $post]);
    }

    public function create()
    {
        //we want the creator dropdown menu to be filled with the users from users table
        //1- get all users from users table
        //2- pass the users to the view


        $users = User::all();   //==> User --> model name
        return view("posts.create",["users"=>$users]);
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
        $users = User::all();   //==> User --> model name
        $post = ['id' => $id, 'title' => 'laravel', 'posted_by' => 'Ahmed', 'description' => 'Catch the passed parameter from URL.'];
        return view('posts.edit', ['post' => $post , 'users'=>$users]);
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
