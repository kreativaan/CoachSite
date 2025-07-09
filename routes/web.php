<?php

use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

// ------------------
// Public Pages
// ------------------
Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'publicProfile']);
Route::get('/contact', [PageController::class, 'contact']);
Route::post('/contact', [PageController::class, 'sendMessage']);

// ------------------
// Blog
// ------------------
Route::view('/blog', 'blog');
Route::get('/api/posts', [PostController::class, 'index']);
Route::get('/api/posts/{id}', [PostController::class, 'show']);
Route::get('/blog/{id}', fn($id) => view('blog-post', ['id' => $id]));

// ------------------
// Comments
// ------------------
Route::get('/api/posts/{id}/comments', fn($id) => Comment::where('post_id', $id)->latest()->get());

Route::middleware('auth')->group(function () {
    Route::post('/comments', [CommentController::class, 'store']);
    Route::put('/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
});

// ------------------
// Admin Area
// ------------------
Route::middleware(['auth', 'is_admin'])->group(function () {
    // Posts (Blog)
    Route::view('/admin/blog', 'admin-blog');
    Route::get('/admin/blog/edit/{id}', fn($id) => view('edit-post', ['id' => $id]));
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/api/posts/{id}', [PostController::class, 'update']);
    Route::delete('/api/posts/{id}', [PostController::class, 'destroy']);

    // Trainer Profile (admin)
    Route::get('/trainer', [PageController::class, 'trainer']);
    Route::post('/trainer-profile', [PageController::class, 'saveTrainerProfile']);

    // Messages
    Route::get('/admin/messages', [MessageController::class, 'index']);
    Route::get('/api/messages/count', fn() => response()->json(['count' => \App\Models\Message::count()]));
    Route::get('/admin/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/admin/messages/{id}/reply', [MessageController::class, 'reply'])->name('messages.reply');

    // Admin comment replies
    Route::match(['POST', 'DELETE'], '/api/comments/{id}/reply', function ($id, Illuminate\Http\Request $request) {
        $comment = \App\Models\Comment::findOrFail($id);

        if ($request->isMethod('delete')) {
            $comment->admin_reply = null;
            $comment->save();
            return response()->json(['message' => 'Reply deleted']);
        }

        $comment->admin_reply = $request->input('admin_reply');
        $comment->save();
        return response()->json(['message' => 'Reply submitted']);
    });
});

// ------------------
// Breeze Auth Routes
// ------------------
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'is_admin'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
