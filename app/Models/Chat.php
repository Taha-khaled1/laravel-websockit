<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    /**
     * Get the messages in the chat.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the participants of the chat.
     */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants');
    }
}