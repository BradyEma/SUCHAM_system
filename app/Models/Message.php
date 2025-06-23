<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'conversation_id',
        'read',
        'type'
    ];

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'sender_id');
    }
}
