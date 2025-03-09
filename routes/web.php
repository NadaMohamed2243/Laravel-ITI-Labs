<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// show form
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

//store the data from the form
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');



// Edit & Update
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');


// /posts/{post} ==> called route parameter
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


// Edit a comment
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
// Update a comment
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');