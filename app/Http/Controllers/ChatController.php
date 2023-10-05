<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        // return "sdf";
        try {
            $senderId =  $request->myId; // Assuming you're using authentication
            $receiverId = $request->receiverId;
            $message = new Message();
            $message->sender_id = $senderId;
            $message->receiver_id = $receiverId;
            $message->content = $request->content;
            $message->save();

            // Broadcast the new message to the recipient
            broadcast(new NewMessage($message))->toOthers();

            return response()->json(['message' => 'Message sent successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }

    public function getMessages(Request $request)
    {
        $senderId = $request->myId; // Assuming you're using authentication
        $receiverId = $request->receiverId;
        $messages = Message::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId);
        })
            ->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', $senderId);
            })
            ->orderBy('created_at')
            ->get();

        return response()->json(['messages' => $messages]);
    }
}