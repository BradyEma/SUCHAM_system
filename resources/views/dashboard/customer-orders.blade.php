<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <title>My Orders | GoldenFields</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        secondary: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .order-tab.active {
            border-bottom: 3px solid #eab308;
            color: #16a34a;
            font-weight: 600;
        }
        .order-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .nav-item {
            transition: all 0.3s ease;
        }
        .nav-item:hover {
            background-color: rgba(255, 215, 0, 0.1);
        }
        .nav-item.active {
            background-color: #f0fdf4;
            color: #14532d;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-primary-800 to-primary-900 text-white p-6 space-y-8 shadow-xl">
            @php
    $user = auth()->user();
@endphp

<div class="flex items-center space-x-3"> 
    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-md">
        <img 
            src="{{ asset('storage/' . auth()->user()->profile_picture) }}" 
            alt="Profile Picture" 
            class="h-14 w-14 rounded-full object-cover"
        >
    </div>
    <div>
        <div class="text-xl font-bold text-white">GoldenFields</div>
        <div class="text-xs text-primary-200">Customer Dashboard</div>
    </div>
</div>

            <nav class="space-y-1">
                 <a href="{{ route('customer.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span class="text-white">Dashboard</span>
                </a>
               
                <a href="{{ route('customer.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item active hover:bg-primary-700">
                    <i class="fas fa-clipboard-list w-5 text-center "></i>
                    <span class="text-black">Orders</span>
                </a>
                <a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 relative">
                    <i class="fas fa-comment-dots w-5 text-center "></i>
                    <span class="text-white">Chat</span>
                    @if($unreadCount > 0)
                        <span class="absolute right-4 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
                 <a href="{{ route('customer.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700">
                    <i class="fas fa-user w-5 text-center "></i>
                    <span class="text-white">Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 cursor-pointer">
                    @csrf
                    <i class="fas fa-sign-out-alt w-5 text-center "></i>
                    <span class="text-white">Logout</span>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="max-w-6xl mx-auto">
                <!-- Page Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">My Orders</h1>
                    <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-plus mr-2"></i> New Order
                    </button>
                </div>

                <!-- Order Tabs -->
                <div class="mb-6 border-b border-gray-200">
                    <div class="flex space-x-6">
                        <button class="order-tab active py-3 px-1 text-sm font-medium">
                            All Orders <span class="ml-1 bg-gray-200 text-gray-800 rounded-full px-2 py-0.5 text-xs">24</span>
                        </button>
                        <button class="order-tab py-3 px-1 text-sm font-medium text-gray-500 hover:text-gray-700">
                            Pending <span class="ml-1 bg-yellow-100 text-yellow-800 rounded-full px-2 py-0.5 text-xs">5</span>
                        </button>
                        <button class="order-tab py-3 px-1 text-sm font-medium text-gray-500 hover:text-gray-700">
                            Processing <span class="ml-1 bg-blue-100 text-blue-800 rounded-full px-2 py-0.5 text-xs">3</span>
                        </button>
                        <button class="order-tab py-3 px-1 text-sm font-medium text-gray-500 hover:text-gray-700">
                            Shipped <span class="ml-1 bg-purple-100 text-purple-800 rounded-full px-2 py-0.5 text-xs">8</span>
                        </button>
                        <button class="order-tab py-3 px-1 text-sm font-medium text-gray-500 hover:text-gray-700">
                            Delivered <span class="ml-1 bg-green-100 text-green-800 rounded-full px-2 py-0.5 text-xs">7</span>
                        </button>
                    </div>
                </div>

                <!-- Orders List -->
                <div class="space-y-4">
                    <!-- Order Card 1 -->
                    <div class="order-card bg-white p-4 rounded-lg border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-medium text-gray-800">Order #GF-2023-0456</h3>
                                <p class="text-sm text-gray-500">Placed on Oct 15, 2023</p>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">
                                Processing
                            </span>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <div class="flex -space-x-2">
                                <img src="whitesugar.jpg" alt="Product" class="w-10 h-10 rounded-full border-2 border-white">
                                <img src="brownsugar.jpg" alt="Product" class="w-10 h-10 rounded-full border-2 border-white">
                                <div class="w-10 h-10 rounded-full bg-gray-100 border-2 border-white flex items-center justify-center text-xs text-gray-500">
                                    +2
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">4 items • UGX 1,250,000</p>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-truck mr-1"></i> Standard Delivery
                            </div>
                            <div class="space-x-2">
                                <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                                    View Details
                                </button>
                                <button class="text-sm text-red-600 hover:text-red-700 font-medium">
                                    Cancel Order
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Order Card 2 -->
                    <div class="order-card bg-white p-4 rounded-lg border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-medium text-gray-800">Order #GF-2023-0455</h3>
                                <p class="text-sm text-gray-500">Placed on Oct 10, 2023</p>
                            </div>
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-medium">
                                Shipped
                            </span>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <div class="flex -space-x-2">
                                <img src="darkbrownsugar.png" alt="Product" class="w-10 h-10 rounded-full border-2 border-white">
                                <img src="molasses.jpg" alt="Product" class="w-10 h-10 rounded-full border-2 border-white">
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">2 items • UGX 850,000</p>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-shipping-fast mr-1"></i> Express Delivery
                            </div>
                            <div class="space-x-2">
                                <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                                    Track Order
                                </button>
                                <button class="text-sm text-gray-600 hover:text-gray-700 font-medium">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Order Card 3 -->
                    <div class="order-card bg-white p-4 rounded-lg border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-medium text-gray-800">Order #GF-2023-0450</h3>
                                <p class="text-sm text-gray-500">Placed on Sep 28, 2023</p>
                            </div>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">
                                Delivered
                            </span>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <div class="flex -space-x-2">
                                <img src="whitesugar.jpg" alt="Product" class="w-10 h-10 rounded-full border-2 border-white">
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">1 item • UGX 3,200,000</p>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-check-circle mr-1 text-green-500"></i> Delivered Oct 2
                            </div>
                            <div class="space-x-2">
                                <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                                    Reorder
                                </button>
                                <button class="text-sm text-gray-600 hover:text-gray-700 font-medium">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-100">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary-600 text-white font-medium">
                            1
                        </button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                            2
                        </button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                            3
                        </button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-100">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </main>
    </div>
</body>
</html>