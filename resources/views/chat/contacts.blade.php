<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="icon" href="favicon-sucham.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sky-100 min-h-screen">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="w-1/4 bg-blue overflow-y-auto shadow">
            <div class="p-4 font-bold bg-sky-600 text-white text-lg border-b">Chat Contacts</div>
            <!--to generate contact list-->

            @foreach(App\Models\User::where('id', '!=', auth()->id())->get() as $contact)
                <a href="{{ route('chat', $contact->id) }}" 
                   class="flex items-center p-3 hover:bg-sky-100 
                          {{ request()->route('receiver_id') == $contact->id ? 'bg-sky-200' : '' }}">
                    <div class="w-10 h-10 rounded-full bg-sky-300 text-white font-bold mr-3 flex items-center justify-center">
                        {{ substr($contact->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-semibold">{{ $contact->name }}</div>
                        <div class="text-xs text-gray-500">Last message...</div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Chat Area -->
        <div class="flex-1 flex flex-col bg-gray-300">

            <!-- Messages -->
            <div class="flex-1 overflow-y-auto p-4 space-y-2">
                @isset($messages)
                    @foreach($messages as $msg)
                        <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[75%] p-3 rounded-lg 
                                {{ $msg->sender_id === auth()->id() ? 'bg-sky-300 text-white' : 'bg-white' }}">
                                <p>{{ $msg->message }}</p>
                                <div class="text-xs text-gray-700 text-right mt-1">
                                    {{ $msg->created_at->format('h:i A') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="h-full flex items-center justify-center text-gray-500">
                        Select a contact to chat
                    </div>
                @endisset
            </div>

            <!-- Input -->
            <div class="p-3 bg-white border-t">
                <form wire:submit.prevent="sendMessage" class="flex gap-2">
                    <input type="text" wire:model="messageText" placeholder="Type a message" 
                           class="flex-1 px-4 py-2 border rounded-full focus:ring-2 focus:ring-sky-400" />
                    <button type="submit" class="p-2 text-sky-600 hover:text-sky-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" 
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
