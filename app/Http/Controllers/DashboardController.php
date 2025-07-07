<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $postCount = Post::count();
        $messageCount = Message::count();
        $unreadMessageCount = Message::where('is_read', false)->count();
        $adminName = Auth::user()->name;

        $recentPosts = Post::latest()->take(3)->get();
        $recentMessages = Message::latest()->take(3)->get();

        return view('dashboard', [
            'postCount' => $postCount,
            'messageCount' => $messageCount,
            'unreadMessageCount' => $unreadMessageCount,
            'adminName' => $adminName,
            'recentPosts' => $recentPosts,
            'recentMessages' => $recentMessages,
        ]);
    }
}
