<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/posts',[PostController::class,'index']);

// /posts/{post} ==> called route parameter
Route::get('/posts/{post}',[PostController::class,'show']);
