<div class=" bg black flex flex-col h-full"> 

    {{-- Chat Header --}}
    <div class="flex items-center gap-3 p-4 bg-blue-400 text-white shadow">
        <div class="w-10 h-10 bg-white rounded-full"></div>
        <div>
            <div class="font-semibold text-md">
                {{ App\Models\User::find($receiver_id)?->name ?? 'Chat' }}
            </div>
            <div class="text-xs">last seen recently</div>
        </div>
    </div>

    {{-- Messages --}}
    <div class="flex-1 overflow-y-auto p-6 bg-gray-100 space-y-2" wire:poll.3s>
        @foreach($messages as $msg)
            <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-[60%] px-4 py-2 rounded-lg shadow
                    {{ $msg->sender_id === auth()->id() ? 'bg-green-300' : 'bg-white' }}">
                    <p class="text-sm">{{ $msg->message }}</p>
                   <div class="text-right text-[10px] text-gray-600 mt-1 flex items-center justify-end gap-1">
    {{ $msg->created_at->format('H:i') }}
    
    @if ($msg->sender_id === auth()->id())
        @if ($msg->read)
            <span class="text-blue-500 text-xs">✓✓</span>
        @else
            <span class="text-gray-500 text-xs">✓</span>
        @endif
    @endif
</div>

                </div>
            </div>
        @endforeach
    </div>

    {{-- Input --}}
    <div class="p-4 bg-white border-t">
        <form wire:submit.prevent="sendMessage" class="flex gap-2">
            <input type="text" wire:model="messageText" placeholder="Type a message"
                class="flex-1 px-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-green-400" />
            <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-full hover:bg-green-700">
                Send
            </button>
        </form>
    </div>

</div> <!-- ✅ Closing root wrapper -->
