@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white py-8 px-4">
    <div class="max-w-2xl mx-auto bg-gray-800 p-6 rounded shadow">

        <h2 class="text-2xl font-bold mb-4">Supplier Details</h2>

        <div class="space-y-4 text-sm">
            <div>
                <strong>Name:</strong> {{ $supplier->name }}
            </div>
            <div>
                <strong>Email:</strong> {{ $supplier->email }}
            </div>
            <div>
                <strong>Status:</strong>
                <span class="inline-block px-2 py-1 text-xs rounded font-semibold
                    @if($supplier->verification_status == 'approved') bg-green-600
                    @elseif($supplier->verification_status == 'rejected') bg-red-600
                    @else bg-yellow-600 @endif">
                    {{ ucfirst($supplier->verification_status) }}
                </span>
            </div>
            <div>
                <strong>PDF Document:</strong>
                @if($supplier->pdf_path)
                    <a href="{{ asset('storage/' . $supplier->pdf_path) }}" class="text-blue-300 underline" target="_blank">View PDF</a>
                @else
                    N/A
                @endif
            </div>
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-2">Approval History</h3>

                @if($supplier->approvals->count())
                    <ul class="space-y-2 text-sm">
                        @foreach($supplier->approvals as $log)
                            <li class="bg-gray-700 p-3 rounded">
                                <strong>{{ ucfirst($log->action) }}</strong>
                                by {{ optional($log->user)->name ?? 'Unknown user' }}
                                <span class="text-gray-400">— {{ $log->created_at->diffForHumans() }}</span>
                                @if($log->note)
                                    <div class="text-gray-300 text-xs mt-1">{{ $log->note }}</div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400 text-sm">No approval history yet.</p>
                @endif
            </div>

            <div class="mt-6">
                <a href="{{ route('suppliers.index') }}" class="text-white bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
                    ← Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
