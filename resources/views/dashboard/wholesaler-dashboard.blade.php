@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white shadow rounded">
    <h1 class="text-2xl font-bold text-green-700">Wholesaler Dashboard</h1>
    <p class="mt-2 text-gray-600">Welcome to your dashboard, valued wholesaler!</p>
</div>

<a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
    <i class="fas fa-comment-dots w-5 text-center"></i>
    <span>Chat</span>
    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-auto">2 unread</span>
</a>
@endsection
