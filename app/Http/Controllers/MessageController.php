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
}
