<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'name' => 'required|string|max:255',
            'content' => 'required|string',

        ]);

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'name' => $request->name,
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Comment added!', 'comment' => $comment]);
    }
}
