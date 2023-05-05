<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Chat;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chat,id',
            'message' => 'required'
        ]);

        $chat = Chat::find($request->chat_id);

        if (!$chat) {
            return response()->json(['error' => 'Chat not found'], 404);
        }

        $message = new Message;
        $message->chat_id = $request->chat_id;
        $message->message = $request->message;
        $message->datetime = now();
        $message->save();

        return response()->json($message, 201);
    }

    public function index(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chat,id'
        ]);

        $chat = Chat::find($request->chat_id);

        if (!$chat) {
            return response()->json(['error' => 'Chat not found'], 404);
        }

        $messages = $chat->messages()->orderBy('datetime')->get();

        return response()->json($messages);
    }

    public function destroy(Request $request, $id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $message->delete();

        return response()->json(['message' => 'Message deleted']);
    }
}
