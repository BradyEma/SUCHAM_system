@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Customer Dashboard</h1>
    <p>Welcome, Customer!</p>
    <a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
        <i class="fas fa-comment-dots w-5 text-center"></i>
        <span>Chat</span>
        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-auto">2 unread</span>
    </a>
</div>
@endsection
