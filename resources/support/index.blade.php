@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Support Tickets</h1>

    <a href="{{ route('support.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Submit New Ticket</a>

    @if(session('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Subject</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Date</th>
                @if(auth()->user()->isAdmin())
                <th class="p-2 border">User</th>
                <th class="p-2 border">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td class="p-2 border">{{ $ticket->subject }}</td>
                    <td class="p-2 border capitalize">{{ $ticket->status }}</td>
                    <td class="p-2 border">{{ $ticket->created_at->format('d M Y') }}</td>
                    @if(auth()->user()->isAdmin())
                        <td class="p-2 border">{{ $ticket->user->name }}</td>
                        <td class="p-2 border">
                            <form action="{{ route('support.reply', $ticket) }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="text" name="reply_text" class="border rounded p-1 w-full" placeholder="Write reply...">
                                <button type="submit" class="bg-green-500 text-white px-2 rounded">Send</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
