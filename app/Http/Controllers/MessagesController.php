<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    //

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|string|max:5000',
        ]);

        Message::create([
            'sender_id' => $formFields['sender_id'],
            'receiver_id' => $formFields['receiver_id'],
            'body' => $formFields['body'],
            'is_read' => false,
        ]);

        return back()->with('message', 'Message sent successfully!');
    }

    //show all messages
    public function index()
    {
        $userId = Auth::id();

        $sentMessages = Message::where('sender_id', $userId)->with('receiver')->latest()->get();
        $receivedMessages = Message::where('receiver_id', $userId)->with('sender')->latest()->get();

        return view('messages.messages', compact('sentMessages', 'receivedMessages'));
    }
}
