<div wire:poll.5s>
    <a href="{{ route('chat.index') }}" class="relative flex items-center">
        <i class="fas fa-comment-alt mr-2"></i> Chat
        @if ($unreadCount > 0)
            <span class="ml-1 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                {{ $unreadCount }}
            </span>
        @endif
    </a>
</div>
