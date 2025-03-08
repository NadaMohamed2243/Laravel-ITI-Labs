<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = [
            ['id' => 1 , 'title' => 'laravel' , 'posted_by' => 'ahmed' , 'created_at' => '2025-03-08 12:47:00'],
            ['id' => 2 , 'title' => 'php' , 'posted_by' => 'mohamed' , 'created_at' => '2025-05-10 11:23:00'],
            ['id' => 3 , 'title' => 'html' , 'posted_by' => 'ahmed' , 'created_at' => '2025-03-08 10:09:00'],
        ];
        return view("posts.index",[ 'posts' => $posts ]);
    }
}
