@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-4 text-white">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Suppliers</h2>
        <a href="{{ route('suppliers.create') }}" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-white">+ Add Supplier</a>
    </div>

    @if(session('success'))
        <div class="bg-green-700 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
    <div class="bg-red-700 text-white px-4 py-2 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif


    <div class="bg-gray-800 rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-700 text-white uppercase text-xs">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">PDF</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="px-4 py-2">
                            <a href="{{ route('suppliers.show', $supplier) }}" class="text-blue-300 hover:underline">
                                {{ $supplier->name }}
                            </a>    
                        </td>
                        <td class="px-4 py-2">{{ $supplier->email }}</td>
                        <td class="px-4 py-2">
                            <span class="inline-block px-2 py-1 text-xs rounded font-semibold
                            @if($supplier->verification_status == 'approved') bg-green-600
                            @elseif($supplier->verification_status == 'rejected') bg-red-600
                            @else bg-yellow-600 @endif">
                                {{ ucfirst($supplier->verification_status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            @if($supplier->pdf_path)
                                <a href="{{ asset('storage/' . $supplier->pdf_path) }}" class="text-blue-300" target="_blank">View PDF</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-4 py-2 space-x-1">
                            @if($supplier->verification_status !== 'approved')
                                <form action="{{ route('suppliers.approve', $supplier) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button class="bg-green-700 text-white text-xs px-2 py-1 rounded hover:bg-green-800">Approve</button>
                                </form>
                            @endif

                            @if($supplier->verification_status !== 'rejected')
                                <form action="{{ route('suppliers.reject', $supplier) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button class="bg-red-700 text-white text-xs px-2 py-1 rounded hover:bg-red-800">Reject</button>
                                </form>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-400 py-4">No suppliers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $suppliers->links() }}
    </div>
</div>
@endsection
