<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-1/3 md:w-1/4 bg-white border-r flex flex-col">
        <!-- User profile and search -->
        <div class="p-4 flex items-center border-b">
            {{-- <img src="{{ auth()->user()->avatar_url ?? 'default.png' }}" class="w-10 h-10 rounded-full" /> --}}
            <span class="ml-3 font-bold">{{ auth()->user()->name }}</span>
        </div>
        
        <!-- Chats list -->
        <div class="flex-1 overflow-y-auto">
            @foreach($contacts as $contact)
                <div class="flex items-center p-3 hover:bg-gray-200 cursor-pointer {{ $contact['conversation_id'] == $conversationId ? 'bg-gray-200' : '' }}" wire:click="selectContact({{ $contact['id'] }})">
                    {{-- <img src="{{ $contact['avatar_url'] ?? 'default.png' }}" class="w-10 h-10 rounded-full" /> --}}
                    <div class="ml-3 flex-1">
                        <div class="flex justify-between">
                            <span class="font-semibold">{{ $contact['name'] }}</span>
                            <span class="text-xs text-gray-500">{{ $contact['last_activity']->format('H:i') }}</span>
                        </div>
                        <div class="text-xs text-gray-500 truncate">{{ $contact['latest_message']['body'] ?? 'No messages yet' }}</div>
                    </div>
                    @if($contact['unread_count'] > 0)
                        <span class="ml-2 bg-green-500 text-white text-xs rounded-full px-2">{{ $contact['unread_count'] }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </aside>

    <!-- Main Chat Area -->
    <main class="flex-1 flex flex-col">
        @if($conversation)
            <!-- Chat header -->
            <div class="flex items-center p-4 border-b bg-white">
                {{-- <img src="{{ $otherUser->avatar_url ?? 'default.png' }}" class="w-10 h-10 rounded-full" /> --}}
                <div class="ml-3">
                    <div class="font-semibold">{{ $otherUser->name }}</div>
                    <div class="text-xs text-green-500">online</div>
                </div>
                
            </div>
            <!-- Messages -->
            <div class="flex-1 overflow-y-auto p-4 bg-chat-pattern" id="messages-container">
                @foreach($messages as $message)
                    <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} mb-2">
                        <div class="max-w-xs px-4 py-2 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-green-100 text-right' : 'bg-white' }}">
                            <div class="text-sm">{{ $message->body }}</div>
                            <div class="text-xs text-gray-400 mt-1 flex items-center justify-end">
                                {{ $message->created_at->format('H:i') }}
                                @if($message->sender_id === auth()->id())
                                    @if($message->is_read)
                                        <i class="fas fa-check-double text-green-500 ml-1"></i>
                                    @else
                                        <i class="fas fa-check text-gray-400 ml-1"></i>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Input -->
            <div class="p-4 bg-white border-t flex items-center gap-2">
                <button><i class="far fa-smile"></i></button>
                <input type="text" wire:model="body" placeholder="Type a message" class="flex-1 p-2 border rounded" id="message-input" />
                <button wire:click="sendMessage" class="bg-green-600 text-white px-4 py-2 rounded">Send</button>
            </div>
        @else
            <div class="flex-1 flex items-center justify-center text-gray-400">Select a chat to start messaging</div>
        @endif
    </main>
</div>