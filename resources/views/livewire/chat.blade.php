<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
</head>
<body>
   <div class="flex h-screen font-sans">

    {{-- Sidebar --}}
    <div class="w-1/4 bg-white border-r overflow-y-auto">
        <div class="p-4 font-bold text-lg border-b">Contacts</div>

        @foreach(App\Models\User::where('id', '!=', auth()->id())->get() as $contact)
            <a href="{{ route('chat', $contact->id) }}"
               class="flex items-center gap-2 px-4 py-3 hover:bg-gray-200
                      {{ request()->route('receiver_id') == $contact->id ? 'bg-gray-100 font-bold' : '' }}">
                <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                <div>
                    <div class="font-semibold">{{ $contact->name }}</div>
                    <div class="text-xs text-gray-500">Online</div>
                </div>
            </a>
        @endforeach
    </div>

    {{-- Chat Window --}}
    <div class="flex flex-col flex-1">

        {{-- Header --}}
        <div class="flex items-center gap-3 p-4 bg-green-600 text-white shadow">
            <div class="w-10 h-10 bg-white rounded-full"></div>
            <div>
                <div class="font-semibold text-md">
                    {{ App\Models\User::find($receiver_id)?->name ?? 'Chat' }}
                </div>
                <div class="text-xs">last seen recently</div>
            </div>
        </div>

        {{-- Chat Messages --}}
        <div class="flex-1 overflow-y-auto p-6 bg-gray-100 space-y-2" wire:poll.3s>
            @foreach($messages as $msg)
                <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[60%] px-4 py-2 rounded-lg shadow
                        {{ $msg->sender_id === auth()->id() ? 'bg-green-300' : 'bg-white' }}">
                        <p class="text-sm">{{ $msg->message }}</p>
                        <div class="text-right text-[10px] text-gray-600 mt-1">
                            {{ $msg->created_at->format('H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Message Input --}}
        <div class="p-4 bg-white border-t">
            <form wire:submit.prevent="sendMessage" class="flex gap-2">
                <input type="text" wire:model="messageText" placeholder="Type a message"
                    class="flex-1 px-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-green-400" />
                <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-full hover:bg-green-700">
                    Send
                </button>
            </form>
        </div>

    </div>
</div>

</body>
</html>