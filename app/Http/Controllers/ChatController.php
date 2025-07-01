<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get all conversations for the current user
        $conversations = Conversation::where('sender_id', $user->id)
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
            ->sortByDesc('updated_at');

        return view('chat.index', compact('conversations'));
    }

    public function show($conversationId)
    {
        $conversation = Conversation::with(['sender', 'receiver', 'messages.sender'])
            ->findOrFail($conversationId);
        
        $user = Auth::user();
        
        // Check if user is part of this conversation
        if ($conversation->sender_id != $user->id && $conversation->receiver_id != $user->id) {
            abort(403);
        }

        // Mark messages as read
        $conversation->messages()
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $otherUser = $conversation->sender_id == $user->id 
            ? $conversation->receiver 
            : $conversation->sender;

        return view('chat.show', compact('conversation', 'otherUser'));
    }

    public function startConversation(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id'
        ]);

        $user = Auth::user();
        $receiverId = $request->receiver_id;

        // Check if conversation already exists
        $conversation = Conversation::where(function($query) use ($user, $receiverId) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $receiverId);
        })->orWhere(function($query) use ($user, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $user->id);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'sender_id' => $user->id,
                'receiver_id' => $receiverId
            ]);
        }

        return redirect()->route('chat.show', $conversation->id);
    }

    public function sendMessage(Request $request, $conversationId)
    {
        $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        $conversation = Conversation::findOrFail($conversationId);
        $user = Auth::user();

        // Check if user is part of this conversation
        if ($conversation->sender_id != $user->id && $conversation->receiver_id != $user->id) {
            abort(403);
        }

        $message = Message::create([
            'conversation_id' => $conversationId,
            'sender_id' => $user->id,
            'body' => $request->body,
            'is_read' => false
        ]);

        return response()->json([
            'success' => true,
            'message' => $message->load('sender')
        ]);
    }

    public function searchUsers(Request $request)
    {
        $query = $request->get('q');
        $user = Auth::user();

        $users = User::where('id', '!=', $user->id)
            ->where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->limit(10)
            ->get();

        return response()->json($users);
    }

    public function livewire()
    {
        return view('chat.livewire');
    }

    public function test()
    {
        return 'Chat route is working!';
    }
}