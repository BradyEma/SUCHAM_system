<!-- wholesaler-orders.blade.php -->
@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
   {{-- @include('partials.sidebar-wholesaler') <!-- Custom sidebar for wholesalers --> --}} 

    <main class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Wholesale Orders</h1>
                <a href="{{ route('wholesaler.products') }}">
                    <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-plus mr-2"></i> Place New Order
                    </button>
                </a>
            </div>

            <!-- Status Tabs -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-2 sm:gap-4 border-b border-gray-200 pb-1">
                    @foreach(['Pending', 'Processing', 'Shipped', 'Completed', 'Cancelled'] as $status)
                        <a href="#{{ str($status)->slug() }}" 
                           class="relative px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-primary-600 group flex items-center">
                            <i class="fas fa-circle mr-2 text-xs {{
                                match($status) {
                                    'Pending' => 'text-yellow-500',
                                    'Processing' => 'text-blue-500',
                                    'Shipped' => 'text-indigo-500',
                                    'Completed' => 'text-green-500',
                                    'Cancelled' => 'text-red-500',
                                    default => 'text-gray-500'
                                }
                            }}"></i>
                            <span>{{ $status }}</span>
                            @if(isset($groupedOrders[strtolower($status)]) && $groupedOrders[strtolower($status)]->count() > 0)
                                <span class="ml-2 bg-gray-100 group-hover:bg-primary-100 text-gray-600 group-hover:text-primary-800 text-xs px-2 py-0.5 rounded-full">
                                    {{ $groupedOrders[strtolower($status)]->count() }}
                                </span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Orders -->
            @php
                $statusMap = [
                    'Pending' => 'pending',
                    'Processing' => 'processing',
                    'Shipped' => 'shipped',
                    'Completed' => 'completed',
                    'Cancelled' => 'cancelled',
                ];
            @endphp

            @foreach($statusMap as $label => $key)
                @php $orders = $groupedOrders[$key] ?? collect(); @endphp

                <section id="{{ str($label)->slug() }}" class="mb-10 scroll-mt-20">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ $label }} Orders ({{ $orders->count() }})</h2>

                    @forelse($orders as $transactionId => $orderGroup)
                        @php
                            $firstOrder = $orderGroup->first();
                            $totalAmount = $orderGroup->sum('total');
                            $orderDate = \Carbon\Carbon::parse($firstOrder->created_at)->format('M d, Y');
                        @endphp

                        <div class="order-card bg-white p-4 rounded-lg border border-gray-200 mb-4">
                            <div class="flex justify-between mb-3">
                                <div>
                                    <h3 class="font-medium text-gray-800">Order #{{ $transactionId }}</h3>
                                    <p class="text-sm text-gray-500">Placed on {{ $orderDate }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">{{ $label }}</span>
                            </div>

                            <div class="flex items-center mb-4">
                                <div class="flex -space-x-2">
                                    @foreach($orderGroup->take(3) as $order)
                                        <img src="{{ asset('storage/' . $order->product_image) }}" class="w-10 h-10 rounded-full border-2 border-white" alt="Product">
                                    @endforeach
                                    @if($orderGroup->count() > 3)
                                        <div class="w-10 h-10 rounded-full bg-gray-100 border-2 border-white flex items-center justify-center text-xs text-gray-500">
                                            +{{ $orderGroup->count() - 3 }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-600">{{ $orderGroup->count() }} item(s) • UGX {{ number_format($totalAmount) }}</p>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    <i class="fas fa-truck mr-1"></i> Bulk Delivery
                                </div>
                                <div class="space-x-2">
                                    <a href="{{ route('wholesaler.orders.show', $transactionId) }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                                        View Details
                                    </a>

                                    @if($label === 'Pending')
                                        <form method="POST" action="{{ route('wholesaler.orders.cancel', $transactionId) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-sm text-red-600 hover:text-red-700 font-medium">
                                                Cancel Order
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">No {{ strtolower($label) }} orders yet.</p>
                    @endforelse
                </section>
            @endforeach

        </div>
    </main>
</div>
@endsection
