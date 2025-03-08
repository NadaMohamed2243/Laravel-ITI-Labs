<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/posts',[PostController::class,'index']);

// show form
Route::get('/posts/create',[PostController::class,'create']);

//store the data from the form
Route::post('/posts',[PostController::class,'store']);

// /posts/{post} ==> called route parameter
Route::get('/posts/{post}',[PostController::class,'show']);


