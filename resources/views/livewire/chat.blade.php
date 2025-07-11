<div class="flex h-screen bg-gray-50">
    <!-- Sidebar - Chat List -->
    <aside class="w-1/3 md:w-1/4 bg-white border-r border-gray-200 flex flex-col shadow-sm">
        <!-- User profile header -->
        <div class="p-4 flex items-center border-b border-gray-200 bg-white">
            <div class="relative">
                @if(auth()->user()->profile_picture)
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                         alt="Profile Picture"
                         class="w-10 h-10 rounded-full object-cover shadow-sm">
                @else
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-green-500 flex items-center justify-center text-white font-bold shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-black rounded-full"></span>
            </div>
            <div class="ml-3">
                <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>
                <p class="text-xs text-gray-500">Active now</p>
            </div>
        </div>
        
        <!-- Search bar -->
        <div class="p-3 border-b border-gray-200">
            <div class="relative">
                <input type="text" placeholder="Search contacts..." 
                       class="w-full pl-10 pr-4 py-2 bg-gray-100 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:bg-white">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
            </div>
        </div>
        
        <!-- Chats list with fixed height and scroll -->
        <div class="flex-1 overflow-y-auto relative">
            <div class="absolute top-0 left-0 right-0 bottom-12 overflow-y-auto">
                @foreach($contacts as $contact)
                    <div wire:click="selectContact({{ $contact['id'] }})" 
                         class="flex items-center p-3 hover:bg-green-600 transition duration-150 cursor-pointer 
                                {{ $contact['conversation_id'] == $conversationId ? 'bg-green-500' : '' }}">
                        <!-- User avatar with status indicator -->
                        <div class="relative flex-shrink-0">
                            @if(!empty($contact['profile_picture']))
                                <img src="{{ asset('storage/' . $contact['profile_picture']) }}"
                                     alt="{{ $contact['name'] }}"
                                     class="w-10 h-10 rounded-full object-cover shadow-sm">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 flex items-center justify-center text-white font-bold shadow-sm">
                                    {{ strtoupper(substr($contact['name'], 0, 1)) }}
                                </div>
                            @endif
                            <span class="absolute bottom-0 right-0 w-3 h-3 {{ $contact['is_online'] ? 'bg-green-500' : 'bg-gray-400' }} border-2 border-black rounded-full"></span>
                        </div>
                        
                        <div class="ml-3 flex-1 min-w-0">
                            <div class="flex justify-between items-center">
                                <span class="font-medium text-gray-800 truncate">{{ $contact['name'] }}</span>
                                <span class="text-xs text-gray-500 whitespace-nowrap ml-2">
                                    {{ $contact['last_activity'] ? $contact['last_activity']->format('H:i') : '' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center mt-1">
                                <p class="text-sm text-white ">
                                    {{ $contact['latest_message']['body'] ?? 'Start a conversation' }}
                                </p>
                                @if($contact['unread_count'] > 0)
                                    <span class="ml-2 bg-green-600 text-white text-xs rounded-full px-2 py-0.5 min-w-[20px] flex justify-center">
                                        {{ $contact['unread_count'] }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                 <!-- Fixed exit link at bottom -->
           <div class="absolute bottom-3 left-0 right-0 p-3 bg-green-800 border-t border-gray-400">
    <a 
        href="
            @if(\Illuminate\Support\Facades\Auth::user()->role === 'admin')
                {{ route('admin.dashboard') }}
            @elseif(\Illuminate\Support\Facades\Auth::user()->role === 'supplier')
                {{ route('supplier.dashboard') }}
            @elseif(\Illuminate\Support\Facades\Auth::user()->role === 'retailer')
                {{ route('retailer.dashboard') }}
            @elseif(\Illuminate\Support\Facades\Auth::user()->role === 'wholesaler')
                {{ route('wholesaler.dashboard') }}
            @else
                {{ route('home') }}
            @endif
        " 
        class="flex items-center justify-center w-full p-2 text-white hover:text-green-600 transition-colors duration-150"
    >
        <i class="fas fa-arrow-left mr-2"></i> Exit to Dashboard
    </a>
</div>


            </div>
            
           
        </div>
    </aside>

    <!-- Main Chat Area -->
    <main class="flex-1 flex flex-col bg-white">
        @if($conversation)
            <!-- Chat header -->
            <div class="flex items-center p-4 border-b border-gray-200 bg-white sticky top-0 z-10 shadow-sm">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 flex items-center justify-center text-white font-bold shadow-sm">
                        {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                    </div>
                    <span class="absolute bottom-0 right-0 w-3 h-3 {{ $otherUser->isOnline() ? 'bg-green-500' : 'bg-gray-400' }} border-2 border-black rounded-full"></span>
                </div>
                <div class="ml-3">
                    <div class="font-semibold text-gray-800">{{ $otherUser->name }}</div>
                    <div class="text-xs {{ $otherUser->isOnline() ? 'text-green-500' : 'text-gray-500' }}">
                        {{ $otherUser->isOnline() ? 'Online' : ($otherUser->last_activity ? 'Last seen ' . $otherUser->last_activity->diffForHumans() : 'Last seen: Unknown') }}
                    </div>
                </div>
                <div class="ml-auto flex space-x-2">
                    <button class="p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100">
                        <i class="fas fa-phone-alt"></i>
                    </button>
                    <button class="p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100">
                        <i class="fas fa-video"></i>
                    </button>
                    <button class="p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>
            
            <!-- Messages -->
            <div class="flex-1 overflow-y-auto p-4 bg-gray-50" id="messages-container">
                <div class="max-w-3xl mx-auto">
                    @foreach($messages as $message)
                        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} mb-4">
                            @if($message->sender_id !== auth()->id())
                                <div class="flex-shrink-0 mr-2 mt-1">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 flex items-center justify-center text-white text-xs font-bold">
                                        {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                                    </div>
                                </div>
                            @endif
                            <div class="max-w-xs md:max-w-md">
                                <div class="px-4 py-2 rounded-xl shadow-sm
                                            {{ $message->sender_id === auth()->id() ? 'bg-green-600 text-white rounded-tr-none' : 'bg-white border border-gray-200 rounded-tl-none' }}">
                                    <div class="text-sm break-words">{{ $message->body }}</div>
                                    <div class="text-xs mt-1 flex items-center justify-end space-x-1
                                                {{ $message->sender_id === auth()->id() ? 'text-green-100' : 'text-gray-500' }}">
                                        {{ $message->created_at->format('H:i') }}
                                        @if($message->sender_id === auth()->id())
                                            @if($message->is_read)
                                                <i class="fas fa-check-double ml-1 text-xs"></i>
                                            @else
                                                <i class="fas fa-check ml-1 text-xs"></i>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Message input -->
            <div class="p-4 bg-white border-t border-gray-200 sticky bottom-0">
                <div class="flex items-center gap-2">
                    <button class="p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100">
                        <i class="far fa-smile"></i>
                    </button>
                    <button class="p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100">
                        <i class="fas fa-paperclip"></i>
                    </button>
                    <input type="text" 
                           wire:model="body" 
                           placeholder="Type your message..." 
                           class="flex-1 p-3 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-transparent shadow-sm" 
                           id="message-input"
                           wire:keydown.enter="sendMessage" />
                    <button wire:click="sendMessage" 
                            class="bg-green-600 hover:bg-green-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors duration-150 shadow-sm">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        @else
            <!-- Empty state -->
            <div class="flex-1 flex flex-col items-center justify-center text-gray-400 p-6 bg-gray-50">
                <div class="w-24 h-24 mb-4 rounded-full bg-white border-2 border-dashed border-gray-200 flex items-center justify-center">
                    <i class="fas fa-comments text-gray-300 text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-500 mb-1">No conversation selected</h3>
                <p class="text-sm text-gray-400">Select a contact to start chatting</p>
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