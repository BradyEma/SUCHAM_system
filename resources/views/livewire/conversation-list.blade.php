<div class="divide-y divide-gray-200">
    @forelse($conversations as $conversation)
        <div 
            class="px-6 py-4 hover:bg-gray-50 cursor-pointer transition-colors"
            wire:click="selectConversation({{ $conversation['id'] }})"
        >
            <div class="flex items-center space-x-4">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                        {{ substr($conversation['other_user']['name'], 0, 1) }}
                    </div>
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-900 truncate">
                            {{ $conversation['other_user']['name'] }}
                        </h3>
                        <div class="flex items-center space-x-2">
                            @if($conversation['unread_count'] > 0)
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                    {{ $conversation['unread_count'] }}
                                </span>
                            @endif
                            <span class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($conversation['updated_at'])->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    
                    @if($conversation['latest_message'])
                        <p class="text-sm text-gray-500 truncate mt-1">
                            {{ $conversation['latest_message']['sender_id'] === auth()->id() ? 'You: ' : '' }}
                            {{ Str::limit($conversation['latest_message']['body'], 50) }}
                        </p>
                    @else
                        <p class="text-sm text-gray-400 italic mt-1">No messages yet</p>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="px-6 py-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No conversations</h3>
            <p class="mt-1 text-sm text-gray-500">Start a new conversation to begin messaging.</p>
        </div>
    @endforelse
</div> 