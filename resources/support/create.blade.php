@extends('layouts.app')

@section('content')
<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Submit Support Ticket</h1>

    @if($errors->any())
        <ul class="text-red-500 mb-4">
            @foreach($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('support.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Subject</label>
            <input type="text" name="subject" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Message</label>
            <textarea name="message" class="w-full p-2 border rounded" rows="5" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Attachment (optional)</label>
            <input type="file" name="attachment" class="w-full">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit Ticket</button>
    </form>
</div>
@endsection
