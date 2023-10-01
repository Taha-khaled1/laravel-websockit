<?php

namespace App\Http\Controllers;

use App\Events\NewTrade;
use App\Events\testEvent;
use Illuminate\Http\Request;

class PostController extends Controller
{
 public function test()  {
      event(new NewTrade('hi'));
      return event(new testEvent('hi'));
       //  return 'done';
 }
  public function goToChat()  {
              return view('web.chat');
 }
}