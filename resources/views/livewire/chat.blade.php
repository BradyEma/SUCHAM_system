<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-1/3 md:w-1/4 bg-white border-r flex flex-col">
        <!-- User profile and search -->
        <div class="p-4 flex items-center border-b bg-green-500">
            <div class="w-10 h-10 rounded-full bg-yellow-400 flex items-center justify-center text-black font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span class="ml-3 font-bold text-black">{{ auth()->user()->name }}</span>
        </div>
        
        <!-- Chats list -->
        <div class="flex-1 overflow-y-auto">
            @foreach($contacts as $contact)
            
                <div wire:click="selectContact({{ $contact['id'] }})" class="flex items-center p-3 hover:scale-105 transition duration-150 cursor-pointer {{ $contact['conversation_id'] == $conversationId ? 'bg-green-900' : '' }}" >
                         
                    <!-- Yellow round avatar with contact initial -->
                    
                    <div class="ml-3 flex-1 min-w-0">
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-800 truncate">{{ $contact['name'] }}</span>
                            <span class="text-xs text-gray-800 whitespace-nowrap">
                                {{ $contact['last_activity'] ? $contact['last_activity']->format('H:i') : '' }}
                            </span>
                        </div>
                        <div class="text-xs text-white rounded px-1 truncate">
                            {{ $contact['latest_message']['body'] ?? 'No messages yet' }}
                        </div>
                    </div>
                    
                    @if($contact['unread_count'] > 0)
                        <span class="ml-2 bg-green-500 text-white text-xs rounded-full px-2 py-1 min-w-[20px] flex justify-center">
                            {{ $contact['unread_count'] }}
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    </aside>

    <!-- Main Chat Area -->
    <main class="flex-1 flex flex-col bg-gray-30">
        @if($conversation)
            <!-- Chat header -->
            <div class="flex items-center p-4 border-b bg-white sticky top-0 z-10">
                <div class="w-10 h-10 rounded-full bg-yellow-400 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                </div>
                <div class="ml-3">
                    <div class="font-semibold text-gray-800">{{ $otherUser->name }}</div>
                   <div class="text-xs {{ $otherUser->isOnline() ? 'text-green-500' : 'text-gray-400' }}">
    {{ $otherUser->isOnline() ? 'Online' : 'Offline' }}
                    </div>
                </div>
            </div>
            
            <!-- Messages -->
            <div class="flex-1 overflow-y-auto p-4" id="messages-container">
                @foreach($messages as $message)
                    <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} mb-3">
                        <div class="max-w-xs md:max-w-md px-4 py-2 rounded-lg 
                                    {{ $message->sender_id === auth()->id() ? 'bg-green-600 text-white' : 'bg-white border border-gray-200' }}">
                            <div class="text-sm break-words">{{ $message->body }}</div>
                            <div class="text-xs mt-1 flex items-center justify-end space-x-1
                                        {{ $message->sender_id === auth()->id() ? 'text-green-100' : 'text-gray-400' }}">
                                {{ $message->created_at->format('H:i') }}
                                @if($message->sender_id === auth()->id())
                                    @if($message->is_read)
                                        <i class="fas fa-check-double ml-1"></i>
                                    @else
                                        <i class="fas fa-check ml-1"></i>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Input -->
            <div class="p-4 bg-white border-t sticky bottom-0 flex items-center gap-2">
                <button class="p-2 text-gray-500 hover:text-gray-700">
                    <i class="far fa-smile"></i>
                </button>
                <input type="text" 
                       wire:model="body" 
                       placeholder="Type your message here" 
                       class="flex-1 p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-transparent" 
                       id="message-input"
                       wire:keydown.enter="sendMessage" />
                <button wire:click="sendMessage" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full transition-colors duration-150">
                    Send
                </button>
            </div>
        @else
            <div class="flex-1 flex flex-col items-center justify-center text-gray-500 p-6">
                <div class="w-24 h-24 mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="fas fa-comments text-gray-300 text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium mb-1">No conversation selected</h3>
                <p class="text-sm">Select a contact to start chatting</p>
            </div>
        @endif
    </main>
</div>

<script>
    // Auto-scroll to bottom when new messages arrive
    document.addEventListener('DOMContentLoaded', function() {
       Livewire.on('message-sent', () => {
    const container = document.getElementById('messages-container');
    container.scrollTop = container.scrollHeight;
    document.getElementById('message-input').focus();
});
    });
</script>