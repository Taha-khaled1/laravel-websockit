<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageEvent;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Models\Message;

class MassgeController extends Controller
{



public function index(Request $request)
{
    // Retrieve the user's chats and include the last message for each chat
    $user = User::find($request->user_id); //auth()->user();

    $chats = $user->chats->map(function ($chat) {
        // Retrieve the last message for each chat
        $lastMessage = $chat->messages()->latest()->first();

        // Add the last message to the chat object
        $chat->last_message = $lastMessage;

        return $chat;
    });

    return response()->json(["chats" => $chats]);
}


    public function show(Request $request)
    {
        // Ensure the user is a participant in the chat
        $user = User::find($request->user_id);
        $chat = Chat::findOrFail($request->chatId);

        if (!$user->chats->contains($chat)) {
            abort(403, 'You do not have access to this chat.');
        }

        // Retrieve the chat's messages
    $messages = $chat->messages()->orderByDesc('created_at')->get();

        return response()->json(["chat"=>$chat,'messages'=>$messages]);
        // view('chat.show', compact('chat', 'messages'));
    }


    public function createChat(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
        ]);

        // Create a new chat and associate the current user as a participant
                 $myId = $request->user_id;
         $peer_id = $request->peer_id;
       // Find the other user by their ID
         $otherUser = User::findOrFail($peer_id);

        // Check if a chat between the authenticated user and the other user already exists
        $existingChat = Chat::whereHas('participants', function ($query) use ($otherUser,$myId) {
            $query->where('user_id', $myId);
        })
        ->whereHas('participants', function ($query) use ($otherUser) {
            $query->where('user_id', $otherUser->id);
        })
        ->first();

        if ($existingChat) {
             return response()->json(['chat' => $existingChat->id,"massge"=>"Chat exist"]);
            // If a chat already exists, redirect to that chat
            // return redirect()->route('chats.show', ['chat' => $existingChat->id]);
        }

        // Create a new chat
        $chat = new Chat();
        $chat->name = $request->name;
        $chat->save();

        // Add participants to the chat (authenticated user and other user)
        $chat->participants()->attach([
            $myId,
            $otherUser->id,
        ]);
        return response()->json(['chat' => $chat->id,"massge"=>"Chat created successfully"]);
        
        // redirect()->route('chats.show', ['chat' => $chat->id])
        //     ->with('success', 'Chat created successfully.');
    }


    public function sendMessage(Request $request)
    {

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Ensure the user is a participant in the chat
        $user = User::find($request->user_id);
        $chat = Chat::findOrFail($request->chatId);

        if (!$user->chats->contains($chat)) {
            abort(403, 'You do not have access to this chat.');
        }

        // Create a new message in the chat
        $message = new Message([
            'user_id' => $user->id,
            'chat_id' => $chat->id,
            'message' => $request->input('message'),
        ]);
        $message->save();
        broadcast(new ChatMessageEvent($message))->toOthers();
        return response()->json(['data' => $message,"massge"=>"Message sent successfully"]);
        
    
    }
}