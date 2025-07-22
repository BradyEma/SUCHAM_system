<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | GoldenFields</title>
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0', 300: '#86efac', 400: '#4ade80', 500: '#22c55e', 600: '#16a34a', 700: '#15803d', 800: '#166534', 900: '#14532d' },
                        secondary: { 50: '#fff7ed', 100: '#ffedd5', 200: '#fed7aa', 300: '#fdba74', 400: '#fb923c', 500: '#f97316', 600: '#ea580c', 700: '#c2410c', 800: '#9a3412', 900: '#7c2d12' }
                    }
                }
            }
        }
    </script>
    <style>
        .order-tab.active { border-bottom: 3px solid #eab308; color: #16a34a; font-weight: 600; }
        .order-card:hover { box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .nav-item { transition: all 0.3s ease; }
        .nav-item:hover { background-color: rgba(255, 215, 0, 0.1); }
        .nav-item.active { background-color: #f0fdf4; color: #14532d; font-weight: 600; }
    </style>
</head>
<body class="bg-gray-50">
<div class="flex min-h-screen">
     <aside class="w-64 bg-gradient-to-b from-primary-800 to-primary-900 text-white p-6 pt-0 space-y-8 shadow-xl">
        <div class="flex items-center justify-center h-16 px-4 border-b border-primary-700">
            <div class="flex items-center space-x-2">
                <i class="fas fa-leaf text-yellow-400 text-xl"></i>
                <span class="text-xl font-bold">GoldenFields</span>
                <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full ml-2">Customer</span>
            </div>
        </div>

        <div class="p-1 border-b border-primary-700 flex items-center space-x-3 -mt-5 ">
    <img 
        src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-avatar.png') }}" 
        alt="{{ $user->name }}" 
        class="h-10 w-10 rounded-full border-2 border-yellow-400"
    >
    <div>
        <p class="font-medium">{{ $user->name }}</p>
        <p class="text-xs text-primary-200">Verified Account</p>
    </div>
</div>

        <nav class="space-y-1">
            <a href="{{ route('customer.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 relative">
                <i class="fas fa-tachometer-alt w-5 text-center text-primary-200"></i>
                <span class="text-white">Products</span>
            </a>

            <a href="{{ route('wishlist.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 relative">
                <i class="fas fa-heart w-5 text-center text-primary-200"></i>
                <span class="text-white">My Wishlist</span>
                @if(isset($wishlistCount) && $wishlistCount > 0)
    <span class="absolute top-3 right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
        {{ $wishlistCount }}
    </span>
@endif

            </a>
             <a href="{{ route('customer.cart') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 relative">
    <i class="fas fa-shopping-cart w-5 text-center text-primary-200"></i>
    <span class="text-white">My Cart</span>

    @if(isset($cartCount) && $cartCount > 0)
        <span class="absolute top-3 right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
            {{ $cartCount }}
        </span>
    @endif
</a>
            <a href="{{ route('customer.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700  active">
                    <i class="fas fa-clipboard-list w-5 text-center text-black"></i>
                    <span class="text-black">Orders</span>
                     @if(isset($pendingOrdersCount) && $pendingOrdersCount > 0)
        <span class="absolute top-2 right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
            {{ $pendingOrdersCount }}
        </span>
    @endif
            </a>
            <a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 relative">
                    <i class="fas fa-comment-dots w-5 text-center text-primary-200"></i>
                    <span class="text-white">Chat</span>
                    @if($unreadCount > 0)
                        <span class="absolute right-4 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadCount }}</span>
                    @endif
            </a>
            <a href="{{ route('support.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-question-circle w-5 text-center text-primary-200"></i>
                    <span>Support Center</span>
                </a>
             <a href="{{ route('customer.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700">
                    <i class="fas fa-user w-5 text-center text-primary-200"></i>
                    <span class="text-white">Profile</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 cursor-pointer">
                   @csrf
        <button type="submit"
            class="w-full flex items-center justify-center px-4 py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-yellow-600 hover:bg-secondary-700">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </button>
            </form>
        </nav>
    </aside>

    <main class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">My Orders</h1>
                <a href="{{ route('customer.cart') }}">
                    <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-plus mr-2"></i> New Order
                    </button>
                </a>
            </div>

            <!-- Enhanced Status Tabs Navigation -->
<div class="mb-8">
    <div class="flex flex-wrap gap-2 sm:gap-4 border-b border-gray-200 pb-1">
        @foreach(['Pending', 'On Delivery', 'Delivered', 'Cancelled'] as $status)
            <a href="#{{ str($status)->slug() }}" 
               class="relative px-3 py-2.5 text-sm font-medium transition-all duration-200
                      text-gray-600 hover:text-primary-600
                      after:absolute after:bottom-[-3px] after:left-0 after:right-0 after:h-0.5 
                      after:bg-transparent after:transition-all after:duration-200
                      hover:after:bg-primary-500
                      group flex items-center">
                @switch($status)
                    @case('Pending')
                        <i class="fas fa-clock mr-2 text-yellow-500 group-hover:text-yellow-600"></i>
                        @break
                    @case('On Delivery')
                        <i class="fas fa-truck mr-2 text-blue-500 group-hover:text-blue-600"></i>
                        @break
                    @case('Delivered')
                        <i class="fas fa-check-circle mr-2 text-green-500 group-hover:text-green-600"></i>
                        @break
                    @case('Cancelled')
                        <i class="fas fa-times-circle mr-2 text-red-500 group-hover:text-red-600"></i>
                        @break
                @endswitch
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

            {{-- Orders Section --}}
            <div class="space-y-4">
               
@php
    $statusMap = [
        'Pending' => 'pending',
        'On Delivery' => 'on delivery',
        'Delivered' => 'completed', // your DB status for delivered orders
        'Cancelled' => 'cancelled',
    ];
@endphp

@foreach(['Pending', 'On Delivery', 'Delivered', 'Cancelled'] as $displayStatus)
    @php
        $actualStatus = $statusMap[$displayStatus];
        $ordersGroupedByTransaction = $groupedOrders[$actualStatus] ?? collect();
    @endphp

    <section id="{{ str($displayStatus)->slug() }}" class="mb-10 scroll-mt-20">
        <div class="flex items-center gap-4 mb-6">
    <div class="flex items-center">
        @switch($displayStatus)
            @case('Pending')
                <div class="p-2.5 rounded-lg bg-yellow-50 text-yellow-600 mr-3">
                    <i class="fas fa-clock text-lg"></i>
                </div>
                @break
            @case('On Delivery')
                <div class="p-2.5 rounded-lg bg-blue-50 text-blue-600 mr-3">
                    <i class="fas fa-truck text-lg"></i>
                </div>
                @break
            @case('Delivered')
                <div class="p-2.5 rounded-lg bg-green-50 text-green-600 mr-3">
                    <i class="fas fa-check-circle text-lg"></i>
                </div>
                @break
            @case('Cancelled')
                <div class="p-2.5 rounded-lg bg-red-50 text-red-600 mr-3">
                    <i class="fas fa-times-circle text-lg"></i>
                </div>
                @break
        @endswitch
        
        <h2 class="text-2xl font-semibold text-gray-800">
            {{ $displayStatus }} Orders
            @if(isset($groupedOrders[strtolower($displayStatus)]) && $groupedOrders[strtolower($displayStatus)]->count() > 0)
                <span class="text-base font-normal text-gray-500 ml-2">
                    ({{ $groupedOrders[strtolower($displayStatus)]->count() }})
                </span>
            @endif
        </h2>
    </div>
    
    <div class="flex-1 border-b border-gray-200"></div>
</div>

        @forelse($ordersGroupedByTransaction as $transactionId => $orderGroup)
            @php
                $firstOrder = $orderGroup->first();
                $totalAmount = $orderGroup->sum('total');
                $date = \Carbon\Carbon::parse($firstOrder->created_at)->format('M d, Y');
                $itemsCount = $orderGroup->count();
            @endphp

            <div class="order-card bg-white p-4 rounded-lg border border-gray-200 mb-4">
                <!-- Order Summary -->
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="font-medium text-gray-800">Order #{{ $transactionId }}</h3>
                        <p class="text-sm text-gray-500">Placed on {{ $date }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium
                        {{ match($displayStatus) {
                            'Pending' => 'bg-yellow-100 text-yellow-800',
                            'On Delivery' => 'bg-purple-100 text-purple-800',
                            'Delivered' => 'bg-green-100 text-green-800',
                            'Cancelled' => 'bg-red-100 text-red-800',
                            default => 'bg-gray-200 text-gray-800'
                        } }}">
                        {{ $displayStatus }}
                    </span>
                </div>

                <!-- Product Images & Summary -->
                <div class="flex items-center mb-4">
                    <div class="flex -space-x-2">
                        @foreach($orderGroup->take(3) as $order)
                            <img src="{{ asset('storage/' . $order->product_image) }}"
                                 alt="Product"
                                 class="w-10 h-10 rounded-full border-2 border-white">
                        @endforeach
                        @if($orderGroup->count() > 3)
                            <div class="w-10 h-10 rounded-full bg-gray-100 border-2 border-white flex items-center justify-center text-xs text-gray-500">
                                +{{ $orderGroup->count() - 3 }}
                            </div>
                        @endif
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">{{ $itemsCount }} item(s) • UGX {{ number_format($totalAmount) }}</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        <i class="fas fa-truck mr-1"></i> Standard Delivery
                    </div>
                    <div class="space-x-2">
                        <a href="{{ route('customer.orders.show', $transactionId) }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                            View Details
                        </a>

                        @if($displayStatus === 'Pending')
                            <form method="POST" action="{{ route('customer.orders.cancel', ['transactionId' => $transactionId]) }}">
                                @csrf
                                <input type="password" name="password" class="border rounded px-2 py-1 text-sm mb-2" placeholder="Enter password to cancel" required>
                                <button type="submit" class="text-sm text-red-600 hover:text-red-700 font-medium">
                                    Cancel Order
                                </button>
                            </form>
                            @if(session('error'))
                                <p class="text-red-600 text-sm mt-1">{{ session('error') }}</p>
                            @endif
                            @if(session('success'))
                                <p class="text-green-600 text-sm mt-1">{{ session('success') }}</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-sm">No {{ strtolower($displayStatus) }} orders yet.</p>
        @endforelse
    </section>
@endforeach


            </div>
        </div>
    </main>
</div>
</body>
</html>
