<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class ConversationList extends Component
{
    public $conversations = [];
    public $searchQuery = '';

    public function mount()
    {
        $this->loadConversations();
    }

    public function loadConversations()
    {
        $user = Auth::user();
        
        $this->conversations = Conversation::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver', 'messages' => function($query) {
                $query->latest()->limit(1);
            }])
            ->get()
            ->map(function($conversation) use ($user) {
                $otherUser = $conversation->sender_id == $user->id 
                    ? $conversation->receiver 
                    : $conversation->sender;
                
                $latestMessage = $conversation->getLatestMessage();
                $unreadCount = $conversation->getUnreadCount($user->id);
                
                return [
                    'id' => $conversation->id,
                    'other_user' => $otherUser,
                    'latest_message' => $latestMessage,
                    'unread_count' => $unreadCount,
                    'updated_at' => $conversation->updated_at
                ];
            })
            ->sortByDesc('updated_at')
            ->values()
            ->toArray();
    }

    public function selectConversation($conversationId)
    {
        $this->dispatch('conversation-selected', conversationId: $conversationId);
    }

    public function searchConversations()
    {
        if (empty($this->searchQuery)) {
            $this->loadConversations();
            return;
        }

        $user = Auth::user();
        
        $this->conversations = Conversation::where(function($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
        })
        ->whereHas('sender', function($query) {
            $query->where('name', 'like', "%{$this->searchQuery}%")
                  ->orWhere('email', 'like', "%{$this->searchQuery}%");
        })
        ->orWhereHas('receiver', function($query) {
            $query->where('name', 'like', "%{$this->searchQuery}%")
                  ->orWhere('email', 'like', "%{$this->searchQuery}%");
        })
        ->with(['sender', 'receiver', 'messages' => function($query) {
            $query->latest()->limit(1);
        }])
        ->get()
        ->map(function($conversation) use ($user) {
            $otherUser = $conversation->sender_id == $user->id 
                ? $conversation->receiver 
                : $conversation->sender;
            
            $latestMessage = $conversation->getLatestMessage();
            $unreadCount = $conversation->getUnreadCount($user->id);
            
            return [
                'id' => $conversation->id,
                'other_user' => $otherUser,
                'latest_message' => $latestMessage,
                'unread_count' => $unreadCount,
                'updated_at' => $conversation->updated_at
            ];
        })
        ->sortByDesc('updated_at')
        ->values()
        ->toArray();
    }

    public function render()
    {
        return view('livewire.conversation-list');
    }
} 