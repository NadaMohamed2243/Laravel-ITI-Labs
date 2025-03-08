<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/posts',[PostController::class,'index'])->name('posts.index');

// show form
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');

//store the data from the form
Route::post('/posts',[PostController::class,'store'])->name('posts.store');



// Edit & Update
Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');

Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update');


// /posts/{post} ==> called route parameter
Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show');


Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');


