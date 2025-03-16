<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

use Illuminate\Support\Facades\Log;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(10);
        return view("posts.index", ['posts' => $posts]);
        // $posts = Post::all()->toArray();
        // return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view("posts.show", ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();
        return view("posts.create", ["users" => $users]);
    }

    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();

        $post = Post::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'user_id' => $validatedData['creator'],
            'image' => $request->file('image') ?? null,  // Image will be handled by Mutator
        ]);

        return redirect()->route('posts.show', $post->id);
    }

    public function edit($id)
    {
        $users = User::all();
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
    $validatedData = $request->validated();

    if ($request->hasFile('image')) {
        // Delete the old image if a new one is uploaded
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $imagePath = $request->file('image')->store('images', 'public');
    } else {
        $imagePath = $post->image; // Keep the existing image
    }

    $post->update([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'user_id' => $validatedData['creator'],
        'image' => $imagePath,
    ]);

    return redirect()->route('posts.index');
    }

    public function destroy($id)
    {

        $post = Post::find($id);
        // Log::info('Image stored in DB:', ['image' => $post->image]);
        // if ($post->image) {
        //     Storage::disk('public')->delete($post->image);
        // }

        $post->delete();


        return to_route('posts.index');
    }

}
