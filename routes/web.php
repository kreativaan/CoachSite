<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home']);


Route::get('/about', [PageController::class, 'publicProfile']);

Route::get('/trainer', [PageController::class, 'trainer']);
Route::post('trainer-profile', [PageController::class, 'saveTrainerProfile']);

Route::get('/trainer-profile', [PageController::class, 'getTrainer']);


Route::get('/contact', [PageController::class, 'contact']);
Route::post('/contact', [PageController::class, 'sendMessage']);

Route::view('/admin/blog', 'admin-blog');
Route::post('/posts', [PostController::class, 'store']);

Route::view('/blog', 'blog');
Route::get('/api/posts', [PostController::class, 'index']);

Route::get('/api/posts/{id}', [PostController::class, 'show']);
Route::get('/blog/{id}', function ($id) {
    return view('blog-post', ['id' => $id]);
});


//update a post
Route::put('/api/posts/{id}', [PostController::class, 'update']);
//delete a post
Route::delete('/api/posts/{id}', [PostController::class, 'destroy']);
//edit post
Route::get('/admin/blog/edit/{id}', function ($id) {
    return view('edit-post', ['id' => $id]);
});


// comments
Route::post('/comments', [CommentController::class, 'store']);
Route::get('api/posts/{id}/comments', function ($id) {
    return Comment::where('post_id', $id)->latest()->get();
});
