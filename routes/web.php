<?php

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;

// Public Pages
Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'publicProfile']);
Route::get('/contact', [PageController::class, 'contact']);
Route::post('/contact', [PageController::class, 'sendMessage']);

// Trainer
Route::get('/trainer', [PageController::class, 'trainer']);
Route::post('/trainer-profile', [PageController::class, 'saveTrainerProfile']);
Route::get('/trainer-profile', [PageController::class, 'getTrainer']);

// Blog Routes
Route::view('/blog', 'blog');
Route::get('/api/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/api/posts/{id}', [PostController::class, 'show']);
Route::put('/api/posts/{id}', [PostController::class, 'update']);
Route::delete('/api/posts/{id}', [PostController::class, 'destroy']);
Route::get('/blog/{id}', function ($id) {
    return view('blog-post', ['id' => $id]);
});

//admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::view('/admin/blog', 'admin-blog');

    Route::get('/admin/blog/edit/{id}', function ($id) {
        return view('edit-post', ['id' => $id]);
    });

    Route::post('/posts', [PostController::class, 'store']);

    Route::put('/api/posts/{id}', [PostController::class, 'update']);

    Route::delete('/api/posts/{id}', [PostController::class, 'destroy']);

    Route::get('/trainer', [PageController::class, 'trainer']);

    Route::post('/trainer-profile', [PageController::class, 'saveTrainerProfile']);
    //messages
    Route::get('/admin/messages', [MessageController::class, 'index']);
    Route::get('/api/messages/count', function () {
        return response()->json(['count' => \App\Models\Message::count()]);
    });
});




// Comments
Route::post('/comments', [CommentController::class, 'store']);
Route::get('api/posts/{id}/comments', function ($id) {
    return Comment::where('post_id', $id)->latest()->get();
});


//breeze


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
