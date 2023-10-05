<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
      protected $fillable = [
        'chat_id',
        'user_id',
        'message',
    ];

    /**
     * Get the user that sent the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the chat that the message belongs to.
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}