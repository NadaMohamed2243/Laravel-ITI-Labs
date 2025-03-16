<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\Post;



// Route::get('/posts', [PostController::class, 'index']);
Route::middleware(['auth'])->get('/posts', [PostController::class, 'index'])->name('posts.index');

// show form
Route::middleware(['auth'])->get('/posts/create', [PostController::class, 'create'])->name('posts.create');

//store the data from the form
Route::middleware(['auth'])->post('/posts', [PostController::class, 'store'])->name('posts.store');



// Edit & Update
Route::middleware(['auth'])->get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::middleware(['auth'])->put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');


// /posts/{post} ==> called route parameter
Route::middleware(['auth'])->get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


Route::middleware(['auth'])->delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


Route::middleware(['auth'])->post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::middleware(['auth'])->delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


// Edit a comment
Route::middleware(['auth'])->get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
// Update a comment
Route::middleware(['auth'])->put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');






Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';


// Use Inertia.js to create a new Posts page similar to what we have inside posts/index.blade.php that lists table of posts.

// Route::get('/posts', function () {
//     return Inertia::render('Posts/PostsIndex',['posts' => Post::with('user')->paginate(10)]);
// })->middleware(['auth'])->name('posts.index');


// Route::get('/storage/{filename}', function ($filename) {
//     return response()->file(storage_path('app/public/' . $filename));
// })->where('filename', '.*');
