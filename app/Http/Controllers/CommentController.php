<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            // 'name' => 'required|string|max:255',
            'content' => 'required|string',

        ]);

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $comment->name = Auth::user()->name;
        $comment->save();


        return response()->json(['message' => 'Comment added!']);
    }
    public function reply(Request $request, $id)
    {
        $request->validate([
            'admin_reply' => 'required|string'
        ]);
        $comment = Comment::findOrFail($id);
        $comment->admin_reply = $request->admin_reply;
        $comment->save();

        return response()->json(['message' => 'Reply saved']);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $request->validate(['content' => 'required|string']);
        $comment->content = $request->content;
        $comment->save();

        return response()->json(['message' => 'Comment Updated']);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Only allow the user who wrote the comment to delete it
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }
}
