<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard | GoldenFields</title>
    <script src="https://cdn.tailwindcss.com"></script>
     <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
        .stat-card {
            transition: all 0.3s ease;
            border-left: 4px solid;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .product-card:hover .product-image {
            transform: scale(1.05);
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
                 <a href="{{ route('customer.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item active hover:bg-primary-700">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span class="text-black">Dashboard</span>
                </a>
               
                <a href="{{ route('customer.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700">
                    <i class="fas fa-clipboard-list w-5 text-center text-primary-200"></i>
                    <span class="text-white">Orders</span>
                </a>
                <a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 relative">
                    <i class="fas fa-comment-dots w-5 text-center text-primary-200"></i>
                    <span class="text-white">Chat</span>
                    @if($unreadCount > 0)
                        <span class="absolute right-4 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
                 <a href="{{ route('customer.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700">
                    <i class="fas fa-user w-5 text-center text-primary-200"></i>
                    <span class="text-white">Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 cursor-pointer">
                    @csrf
                    <i class="fas fa-sign-out-alt w-5 text-center text-primary-200"></i>
                    <span class="text-white">Logout</span>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-auto">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-primary-800">Welcome, {{ $user->name }}!</h1>
                    <p class="text-primary-600">Here's what's happening with your account today</p>
                </div>
                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-4 border-primary-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Active Orders</h2>
                            <p class="text-3xl font-bold text-primary-700">{{ $stats['active_orders'] }}</p>
                        </div>
                        <div class="p-3 rounded-full text-primary-700 bg-primary-100">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                    <p class="text-sm text-primary-600 mt-2 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        {{ $recentActivity }} recent activities
                    </p>
                </div>
                
                <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-4 border-primary-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Total Spent</h2>
                            <p class="text-3xl font-bold text-primary-700">UGX {{ number_format($stats['total_spent']) }}</p>
                        </div>
                        <div class="p-3 rounded-full text-primary-700 bg-primary-100">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                    <p class="text-sm text-primary-600 mt-2 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        This month
                    </p>
                </div>
                
                <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-4 border-primary-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Messages</h2>
                            <p class="text-3xl font-bold text-primary-700">{{ $stats['messages'] }}</p>
                        </div>
                        <div class="p-3 rounded-full text-primary-700 bg-primary-100">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <p class="text-sm text-red-600 mt-2 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        Unread messages
                    </p>
                </div>
                
                <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-4 border-primary-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Wishlist</h2>
                            <p class="text-3xl font-bold text-primary-700">{{ $stats['wishlist_items'] }}</p>
                        </div>
                        <div class="p-3 rounded-full text-primary-700 bg-primary-100">
                            <i class="fas fa-heart"></i>
                        </div>
                    </div>
                    <p class="text-sm text-primary-600 mt-2 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        Saved items
                    </p>
                </div>
            </div>

            <!-- Products Section -->
            <div x-data="{
                wishlist: [],
                showModal: false,
                modalProduct: null,
                addToWishlist(product) {
                    if (!this.wishlist.includes(product)) {
                        this.wishlist.push(product);
                    }
                    this.showModal = false;
                },
                openModal(product) {
                    this.modalProduct = product;
                    this.showModal = true;
                }
            }">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-primary-800">Our Products</h2>
                    <div class="text-sm text-primary-600">
                        <span x-text="wishlist.length"></span> items in wishlist
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                    <!-- Product Cards -->
                    <template x-for="product in [
                        {name: 'Granulated White Sugar', img: 'whitesugar.jpg', price: '25,000'},
                        {name: 'Light Brown Sugar', img: 'brownsugar.jpg', price: '28,000'},
                        {name: 'Dark Brown Sugar', img: 'darkbrownsugar.png', price: '30,000'},
                        {name: 'Molasses', img: 'molasses.jpg', price: '35,000'},
                        {name: 'Cube Sugar', img: 'sugarcubes.png', price: '32,000'},
                        {name: 'Bagasse', img: 'bagase.png', price: '15,000'}
                    ]" :key="product.name">
                        <div class="product-card relative flex flex-col rounded-2xl shadow-md p-4 bg-white hover:shadow-lg transition-shadow duration-300">
                            <div class="relative w-full h-48 overflow-hidden rounded-xl mb-4">
                                <img :src="'{{ asset('') }}' + product.img" :alt="product.name" 
                                     class="w-full h-full object-cover product-image transition-transform duration-300">
                                <button @click.prevent="openModal(product)" 
                                        class="absolute top-3 right-3 bg-white bg-opacity-90 hover:bg-primary-100 text-primary-700 rounded-full w-8 h-8 flex items-center justify-center shadow transition z-10">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-1" x-text="product.name"></h3>
                            <p class="text-primary-600 font-semibold mb-3" x-text="'UGX ' + product.price"></p>
                            <div class="flex justify-between mt-auto">
                                <button class="bg-primary-600 hover:bg-primary-700 text-white text-sm px-4 py-2 rounded-lg font-medium transition">
                                    Add to Cart
                                </button>
                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-2 rounded-lg font-medium transition">
                                    Order Now
                                </button>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Wishlist Modal -->
                <div x-show="showModal" x-transition class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" style="display: none;">
                    <div class="bg-white rounded-xl shadow-2xl p-8 w-96">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-800">Add to Wishlist</h3>
                            <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <p class="mb-6 text-gray-600">Add <span class="font-semibold text-primary-700" x-text="modalProduct?.name"></span> to your wishlist?</p>
                        <div class="flex justify-end gap-3">
                            <button @click="showModal = false" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-100 transition">
                                Cancel
                            </button>
                            <button @click="addToWishlist(modalProduct)" 
                                    class="px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition">
                                Add to Wishlist
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Conversations -->
            @if($conversations->count() > 0)
            <div class="mt-12 bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Recent Conversations</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($conversations->take(5) as $conversation)
                        @php
                            $otherUser = $conversation->sender_id == $user->id ? $conversation->receiver : $conversation->sender;
                            $latestMessage = $conversation->messages->first();
                        @endphp
                        <a href="{{ route('chat.livewire') }}" class="flex items-center p-4 hover:bg-gray-50 transition">
                            <div class="relative">
                                <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center text-black font-bold shadow-sm">
                                    {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                                </div>
                                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                            </div>
                            <div class="ml-4 flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <h4 class="font-semibold text-gray-800 truncate">{{ $otherUser->name }}</h4>
                                    <span class="text-xs text-gray-500 whitespace-nowrap ml-2">
                                        {{ $conversation->updated_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 truncate">
                                    {{ $latestMessage ? Str::limit($latestMessage->body, 60) : 'No messages yet' }}
                                </p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 ml-2"></i>
                        </a>
                    @endforeach
                </div>
                <div class="p-4 bg-gray-50 text-center">
                    <a href="{{ route('chat.livewire') }}" class="text-primary-600 hover:text-primary-800 font-medium">
                        View all conversations <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endif
        </main>
    </div>
</body>
</html>