@extends('layouts.app')
@php
    use Illuminate\Support\Str;
@endphp
@section('content')
<div class="w-full">

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6 border border-green-300 mx-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Page Heading --}}
    <div class="flex justify-between items-center px-6 py-4 border-b">
        <h1 class="text-2xl font-bold">Support Tickets</h1>
        <a href="{{ route('support.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Submit Ticket
        </a>
    </div>

    {{-- Filter (Optional) --}}
    <form method="GET" class="px-6 py-4">
        <label class="mr-2 font-semibold">Category:</label>
        <select name="category" onchange="this.form.submit()" class="p-2 border rounded">
            <option value="">All</option>
            <option value="inquiry" {{ request('category') === 'inquiry' ? 'selected' : '' }}>Inquiry</option>
            <option value="complaint" {{ request('category') === 'complaint' ? 'selected' : '' }}>Complaint</option>
            <option value="general" {{ request('category') === 'general' ? 'selected' : '' }}>General</option>
        </select>
    </form>

    {{-- Ticket List --}}
    <div class="flex flex-col space-y-4 px-6 pb-10">
        @forelse($tickets as $ticket)
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition-all duration-200">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-primary-700">Issue: {{ $ticket->subject }}</h2>
                    <span class="text-sm text-gray-500">#Ticket-{{ $ticket->id }}</span>
                </div>

                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($ticket->message, 120, '...') }}</p>

                <div class="flex justify-between items-center">
                    <span class="text-xs px-2 py-1 rounded-full capitalize
                        @if($ticket->status === 'open') bg-yellow-100 text-yellow-800
                        @elseif($ticket->status === 'in_progress') bg-blue-100 text-blue-800
                        @elseif($ticket->status === 'resolved') bg-green-100 text-green-800
                        @endif">
                        {{ $ticket->status }}
                    </span>

                    <a href="{{ route('support.show', $ticket->id) }}"
                        class="text-blue-600 hover:text-blue-800 font-medium transition-all duration-200 text-sm">
                        View Details →
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 mt-8">No support tickets found.</div>
        @endforelse
    </div>

</div>
@endsection



{{-- old content  --}}
{{-- @extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Support Tickets</h1>

    <a href="{{ route('support.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
        Submit New Ticket
    </a>

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
                    <th class="p-2 border">Reply</th>
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
                <tr>
                    <td colspan="6" class="bg-gray-50 p-4">
                        <p><strong>Message:</strong> {{ $ticket->message }}</p>
                        @if($ticket->admin_reply)
                            <hr class="my-2">
                            <p><strong>Admin Reply:</strong> {{ $ticket->admin_reply }}</p>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}
