<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Chat extends Component
{
    public $conversationId;
    public $body = '';
    public $messages = [];
    public $conversation;
    public $otherUser;
    public $searchQuery = '';
    public $searchResults = [];
    public $showUserSearch = false;
    public $contacts = [];

    public function mount($conversationId = null)
    {
        $this->conversationId = $conversationId;
        $this->loadContacts();
        if ($conversationId) {
            $this->loadConversation();
        }
    }

    public function loadContacts()
    {
        $user = Auth::user();
        // Get all users except the current user
        $allUsers = User::where('id', '!=', $user->id)->get();
        // Filter users by chat permission
        $filteredUsers = $allUsers->filter(function($contactUser) use ($user) {
            return $user->canChatWith($contactUser);
        });
        // Get existing conversations
        $conversations = Conversation::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver', 'messages' => function($query) {
                $query->latest()->limit(1);
            }])
            ->get();
        $this->contacts = $filteredUsers->map(function($contactUser) use ($user, $conversations) {
            $conversation = $conversations->first(function($conv) use ($contactUser, $user) {
                return ($conv->sender_id == $user->id && $conv->receiver_id == $contactUser->id) ||
                       ($conv->sender_id == $contactUser->id && $conv->receiver_id == $user->id);
            });
            $latestMessage = null;
            $unreadCount = 0;
            $lastActivity = $contactUser->created_at;
            if ($conversation) {
                $latestMessage = $conversation->getLatestMessage();
                $unreadCount = $conversation->getUnreadCount($user->id);
                $lastActivity = $conversation->updated_at;
            }
            return [
                'id' => $contactUser->id,
                'name' => $contactUser->name,
                'email' => $contactUser->email,
                'role' => $contactUser->role,
                'conversation_id' => $conversation ? $conversation->id : null,
                'latest_message' => $latestMessage,
                'unread_count' => $unreadCount,
                'last_activity' => $lastActivity,
                'has_conversation' => $conversation ? true : false
            ];
        })
        ->sortByDesc('last_activity')
        ->values()
        ->toArray();
    }

    public function loadConversation()
    {
        if (!$this->conversationId) return;

        $this->conversation = Conversation::with(['sender', 'receiver', 'messages.sender'])
            ->find($this->conversationId);

        if (!$this->conversation) return;

        $user = Auth::user();
        
        // Check if user is part of this conversation
        if ($this->conversation->sender_id != $user->id && $this->conversation->receiver_id != $user->id) {
            return;
        }

        $this->otherUser = $this->conversation->sender_id == $user->id 
            ? $this->conversation->receiver 
            : $this->conversation->sender;

        $this->loadMessages();
        
        // Mark messages as read
        $this->conversation->messages()
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    public function loadMessages()
    {
        if (!$this->conversation) return;

        $this->messages = $this->conversation->messages()
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function sendMessage()
    {
        if (empty(trim($this->body))) return;

        $user = Auth::user();
        
        if (!$this->conversation) return;

        // Check if user is part of this conversation
        if ($this->conversation->sender_id != $user->id && $this->conversation->receiver_id != $user->id) {
            return;
        }

        Message::create([
            'conversation_id' => $this->conversation->id,
            'sender_id' => $user->id,
            'body' => trim($this->body),
            'is_read' => false
        ]);

        // Clear the message input
        $this->body = '';
        
        $this->loadMessages();
        $this->loadContacts(); // Refresh contacts to update last activity
        
        // Emit event for real-time updates
        $this->dispatch('message-sent');
        
        // Scroll to bottom of messages
        $this->dispatch('scroll-to-bottom');
        
        // Reset the input field
        $this->dispatch('reset-input');
    }

    public function updatedBody()
    {
        // This method will be called whenever the body property is updated
        // We can use this to handle real-time validation if needed
    }

    #[On('reset-input')]
    public function resetInput()
    {
        $this->body = '';
    }

    public function searchUsers()
    {
        if (strlen($this->searchQuery) < 2) {
            $this->searchResults = [];
            return;
        }

        $user = Auth::user();
        
        $this->searchResults = User::where('id', '!=', $user->id)
            ->where(function($query) {
                $query->where('name', 'like', "%{$this->searchQuery}%")
                      ->orWhere('email', 'like', "%{$this->searchQuery}%");
            })
            ->limit(10)
            ->get();
    }

    public function startConversation($userId)
    {
        $user = Auth::user();
        
        // Check if conversation already exists
        $conversation = Conversation::where(function($query) use ($user, $userId) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($user, $userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $user->id);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'sender_id' => $user->id,
                'receiver_id' => $userId
            ]);
        }

        $this->conversationId = $conversation->id;
        $this->loadConversation();
        $this->loadContacts(); // Refresh contacts
        $this->searchQuery = '';
        $this->searchResults = [];
        $this->showUserSearch = false;
    }

    public function selectContact($contactId)
    {
        $contact = collect($this->contacts)->firstWhere('id', $contactId);
        
        if ($contact['has_conversation']) {
            $this->conversationId = $contact['conversation_id'];
            $this->loadConversation();
        } else {
            $this->startConversation($contactId);
        }
        
        $this->loadContacts(); // Refresh the list to update unread counts
    }

    #[On('message-sent')]
    public function refreshMessages()
    {
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}