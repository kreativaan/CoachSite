<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        Message::where('is_read', false)->update(['is_read' => true]);
        $messages = Message::latest()->get();

        return view('admin-message', ['messages' => $messages]);
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => false]);

        return view('message-show', compact('message'));
    }
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);
        $message = Message::findOrFail($id);
        $message->reply = $request->reply;
        $message->save();

        return redirect()->route('messages.show', $id)->with('success', 'Reply saved');
    }
}
