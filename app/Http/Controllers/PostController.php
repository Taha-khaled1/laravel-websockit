<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\NewTrade;
use App\Events\testEvent;
use Illuminate\Http\Request;

class PostController extends Controller
{
 public function test()  {
      event(new NewTrade('man lets go '));
      return event(new testEvent('hi'));
       //  return 'done';
 }
  public function goToChat()  {
              return view('web.chat');
 }

     public function sendMessage(Request $request)
    {
        echo "zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz";
        $message = $request->input('message');
        $user = auth()->user(); // Retrieve authenticated user
        broadcast(new MessageSent($message, $user->name))->toOthers(); // Broadcast event
        return response()->json(['status' => 'success']);
    }
}