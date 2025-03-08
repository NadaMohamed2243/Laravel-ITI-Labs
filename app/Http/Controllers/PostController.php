<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'laravel', 'posted_by' => 'Ahmed', 'created_at' => '2025-03-08 12:47:00'],
            ['id' => 2, 'title' => 'php', 'posted_by' => 'Mohamed', 'created_at' => '2025-05-10 11:23:00'],
            ['id' => 3, 'title' => 'html', 'posted_by' => 'Ahmed', 'created_at' => '2025-03-08 10:09:00'],
        ];
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
}
