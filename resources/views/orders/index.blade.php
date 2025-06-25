@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white py-8 px-4 sm:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white">📋 Order List</h2>
            <a href="{{ route('orders.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
               ➕ Add Order
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-600 text-white px-4 py-2 rounded mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg shadow-lg bg-gray-800">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-700 text-sm text-white uppercase tracking-wider">
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Customer</th>
                        <th class="px-6 py-3 text-left">Product</th>
                        <th class="px-6 py-3 text-left">Qty</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300 text-sm">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-700 transition">
                            <td class="px-6 py-3">{{ $order->order_id }}</td>
                            <td class="px-6 py-3">{{ $order->customer_id }}</td>
                            <td class="px-6 py-3">{{ $order->product }}</td>
                            <td class="px-6 py-3">{{ $order->quantity }}</td>
                            <td class="px-6 py-3">{{ $order->order_date }}</td>
                            <td class="px-6 py-3">
                                <span class="inline-block px-2 py-1 text-xs rounded font-semibold
                                    @if($order->status == 'pending') bg-yellow-500
                                    @elseif($order->status == 'shipped') bg-blue-500
                                    @elseif($order->status == 'delivered') bg-green-500
                                    @else bg-gray-500 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Orders</h2>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Add Order</a>
    <table class="table">
        <thead><tr>
            <th>ID</th><th>Customer</th><th>Product</th><th>Qty</th><th>Date</th><th>Status</th>
        </tr></thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->customer_id }}</td>
                <td>{{ $order->product }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</div>
@endsection --}}
