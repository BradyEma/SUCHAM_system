<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
     public function index($receiver_id)
    {
        
        $messages = Message::where(function ($query) use ($receiver_id) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($receiver_id) {
            $query->where('sender_id', $receiver_id)
                  ->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        $receiver = User::findOrFail($receiver_id);

        return view('chat.contacts', compact('messages', 'receiver'));
    }

    public function contacts()
    {
        $contacts = User::where('id', '!=', auth()->id())->get();

        foreach ($contacts as $contact) {
            $contact->lastMessage = Message::where(function ($query) use ($contact) {
                $query->where('sender_id', auth()->id())
                      ->where('receiver_id', $contact->id);
            })->orWhere(function ($query) use ($contact) {
                $query->where('sender_id', $contact->id)
                      ->where('receiver_id', auth()->id());
            })->latest()->first();
        }

        return view('chat.contacts', compact('contacts'));
    }
}
