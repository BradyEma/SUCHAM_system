@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">

    <a href="{{ route('support.index') }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block">
        ← Back to Support Tickets
    </a>

    <div class="bg-white p-6 rounded-xl shadow border border-gray-200">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Support Ticket #{{ $ticket->id }}</h2>
            <span class="text-xs px-2 py-1 rounded-full 
                @if($ticket->status === 'open') bg-yellow-100 text-yellow-800 
                @elseif($ticket->status === 'in_progress') bg-blue-100 text-blue-800 
                @elseif($ticket->status === 'resolved') bg-green-100 text-green-800 
                @endif capitalize">
                {{ $ticket->status }}
            </span>
        </div>

        {{-- Metadata --}}
        <div class="mb-4">
            <p class="text-sm text-gray-500 mb-1">Submitted by: <strong>{{ $ticket->user->name }}</strong></p>
            <p class="text-sm text-gray-500">Date: {{ $ticket->created_at->format('F j, Y h:i A') }}</p>
        </div>

        <hr class="my-4">

        {{-- Subject --}}
        <div class="mb-4">
            <h3 class="font-semibold text-gray-700 mb-2">Subject:</h3>
            <p class="text-gray-800">{{ $ticket->subject }}</p>
        </div>

        {{-- Original Message --}}
        <div class="mb-4">
            <h3 class="font-semibold text-gray-700 mb-2">Message:</h3>
            <p class="text-gray-700 whitespace-pre-wrap">{{ $ticket->message }}</p>
        </div>

        {{-- Attachment --}}
        @if ($ticket->attachment)
            <div class="mb-4">
                <h3 class="font-semibold text-gray-700 mb-2">Attachment:</h3>
                <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank" class="text-blue-600 hover:underline">
                    View Attachment
                </a>
            </div>
        @endif

        {{-- Conversation Thread --}}
        @if ($ticket->replies->count())
            <div class="mt-6 space-y-4">
                <h3 class="text-lg font-semibold text-gray-700">Conversation Thread</h3>

                @foreach($ticket->replies as $reply)
                    <div class="p-3 border border-gray-200 rounded bg-gray-50">
                        <div class="text-sm text-gray-500 mb-1">
                            <strong>{{ $reply->user->name }}</strong> – {{ $reply->created_at->diffForHumans() }}
                        </div>
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $reply->message }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Admin One-Time Reply (if exists) --}}
        @if ($ticket->admin_reply)
            <div class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded">
                <h3 class="font-semibold text-gray-800 mb-2">Admin Reply:</h3>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $ticket->admin_reply }}</p>
            </div>
        @endif

        {{-- Reply Form --}}
        <form action="{{ route('support.reply.store', $ticket->id) }}" method="POST" class="mt-6">
            @csrf
            <label class="block font-semibold mb-1">Reply</label>
            <textarea name="message" rows="4" class="w-full border p-2 rounded" required></textarea>

            <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Send Reply
            </button>
        </form>

        {{-- change ticket status --}}
        @can('update', $ticket)
    <form action="{{ route('support.updateStatus', $ticket->id) }}" method="POST" class="mt-6">
        @csrf
        @method('PATCH')

        <label class="block font-semibold mb-1">Change Ticket Status</label>
        <select name="status" class="p-2 border rounded w-full max-w-sm inline-block" required>
            <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
            <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
        </select>

        <button type="submit" class="ml-2 mt-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Update Status
        </button>
    </form>
@endcan


    </div>
</div>
@endsection
