@extends('layouts.app')

@section('title', 'Wholesaler Orders')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md">
        <div class="p-6 text-center">
            <img src="https://ui-avatars.com/api/?name=Wholesaler&background=22c55e&color=fff" alt="User" class="w-16 h-16 rounded-full mx-auto">
            <h2 class="mt-4 text-xl font-semibold">Wholesaler</h2>
        </div>
        <nav class="mt-10">
            <a href="{{ route('wholesaler.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-100">Dashboard</a>
            <a href="{{ route('wholesaler.orders') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-100 bg-green-100">Orders</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-700">Orders</h1>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left text-sm font-semibold">Transaction ID</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold">Customer</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold">Date</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold">Status</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($orders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-6">{{ $order->transaction_id }}</td>
                            <td class="py-3 px-6">{{ $order->customer_name }}</td>
                            <td class="py-3 px-6">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="py-3 px-6">
                                <span class="px-2 py-1 rounded-full text-xs {{
                                    $order->status === 'Pending' ? 'bg-yellow-200 text-yellow-800' :
                                    ($order->status === 'Completed' ? 'bg-green-200 text-green-800' :
                                    'bg-red-200 text-red-800')
                                }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-3 px-6">
                                <a href="{{ route('wholesaler.orders.show', ['transactionId' => $order->transaction_id]) }}" class="text-green-600 hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
