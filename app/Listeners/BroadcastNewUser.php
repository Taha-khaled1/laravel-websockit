<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use App\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BroadcastNewUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(\Illuminate\Auth\Events\Registered $event): void
    {
         broadcast(new NewUserRegistered($event->user->id));
        //Registered $event
    }
}