<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/posts',[PostController::class,'index']);

Route::get('/posts/create',[PostController::class,'create']);

// /posts/{post} ==> called route parameter
Route::get('/posts/{post}',[PostController::class,'show']);


