{{-- resources/views/chat.blade.php --}}
<x-app-layout>
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

        {{-- Chat Livewire Component --}}
        <div class="flex-1">
            @livewire('chat', ['receiver_id' => $receiver_id])
        </div>
    </div>
</x-app-layout>
