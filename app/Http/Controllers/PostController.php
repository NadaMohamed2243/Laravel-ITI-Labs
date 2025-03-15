<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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
        // Get validated data from the request
        $validatedData = $request->validated();

        // dd($request->file('image'));
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // dd($validatedData['image']);
        // Create the post
        $post = Post::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'user_id' => $validatedData['creator'],
            'image' => $validatedData['image'], // Use null if no image is uploaded
        ]);
        // dd($post);


        // Redirect to the post's show page
        return to_route('posts.show', $post->id);
    }

    public function edit($id)
    {
        $users = User::all();
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    public function update(PostRequest $request, $id)
    {


        $post = Post::find($id);
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update the post
        $post->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'user_id' => $validatedData['creator'],
            'image' => $validatedData['image'] ?? $post->image,
        ]);


        return to_route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();


        return to_route('posts.index');
    }

}
