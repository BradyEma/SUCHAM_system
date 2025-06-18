<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $receiver_id;
    public $messageText;
    public $messages;

    public function mount($receiver_id = null)
{
    $this->receiver_id = $receiver_id;

    if ($receiver_id) {
        $this->loadMessages();
    } else {
        $this->messages = collect(); // empty collection if none selected
    }
}


    public function loadMessages()
    {
        $this->messages = Message::where(function ($q) {
            $q->where('sender_id', Auth::id())
              ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($q) {
            $q->where('sender_id', $this->receiver_id)
              ->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();
    }

    public function sendMessage()
    {
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->receiver_id,
            'message' => $this->messageText,
        ]);

        $this->messageText = '';
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
