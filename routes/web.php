<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
