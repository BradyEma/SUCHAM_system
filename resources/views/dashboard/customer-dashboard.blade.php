@extends('components.layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside class="w-64 bg-green-800 text-white p-6 space-y-8">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md">
                <img src="{{ asset('sucham.jpg') }}" alt="Logo" class="h-8 w-8 rounded-full">
            </div>
            <div>
                <div class="text-xl  text-green-800 font-bold">GoldenFields</div>
                <div class="text-xs text-green-800">Customer Dashboard</div>
            </div>
        </div>
        <nav class="space-y-1">
            <a href="{{ route('customer.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                 <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span>Profile</span>
            </a>
            <a href="{{ route('customer.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                 <i class="fas fa-clipboard-list w-5 text-center"></i>
                <span>Order</span>
            </a>
              <a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                <i class="fas fa-comment-dots w-5 text-center"></i>
                <span>Chat</span>
                @if($unreadCount > 0)
                    <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full ml-auto">{{ $unreadCount }}</span>
                @endif
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-auto">
        <div class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-3xl font-bold text-green-800">Welcome, {{ $user->name }}!</h1>
                </div>



            <div class="relative">
                <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
        
        <!-- Alpine.js for wishlist functionality -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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
            <h2 class="text-xl font-bold text-green-800 mb-4">Our Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                <!-- Product Card Template -->
                <template x-for="product in [
                    {name: 'Granulated White Sugar', img: 'whitesugar.jpg'},
                    {name: 'Light Brown Sugar', img: 'brownsugar.jpg'},
                    {name: 'Dark Brown Sugar', img: 'darkbrownsugar.png'},
                    {name: 'Mollases', img: 'molasses.jpg'},
                    {name: 'Cube Sugar', img: 'sugarcubes.png'},
                    {name: 'Bagase', img: 'bagase.png'}
                ]" :key="product.name">
                    <div class="relative flex flex-col items-center rounded-3xl shadow-lg p-4 group bg-white">
                        <div class="relative w-full">
                            <img :src="'{{ asset('') }}' + product.img" :alt="product.name" class="w-full h-40 object-cover rounded-2xl group-hover:scale-105 transition-transform duration-300">
                            <!-- Plus icon -->
                            <button @click.prevent="openModal(product)" class="absolute top-2 right-2 bg-white bg-opacity-80 hover:bg-green-200 text-green-700 rounded-full w-8 h-8 flex items-center justify-center shadow transition z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            </button>
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 px-4 py-3 flex flex-col items-center rounded-b-2xl">
                                <span class="block text-base font-bold text-white mb-2" x-text="product.name"></span>
                                <div class="w-full flex justify-between items-center">
                                    <button class="bg-green-700 bg-opacity-70 hover:bg-opacity-90 text-white text-xs px-3 py-1 rounded-full font-semibold transition">Add to Cart</button>
                                    <button class="bg-yellow-500 bg-opacity-70 hover:bg-opacity-90 text-white text-xs px-3 py-1 rounded-full font-semibold transition">Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Modal for Add to Wishlist -->
            <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50" style="display: none;">
                <div class="bg-white rounded-xl shadow-lg p-8 w-80 text-center">
                    <h3 class="text-lg font-bold mb-4">Add to Wishlist</h3>
                    <p class="mb-6">Add <span class="font-semibold" x-text="modalProduct?.name"></span> to your wishlist?</p>
                    <div class="flex justify-center gap-4">
                        <button @click="addToWishlist(modalProduct)" class="bg-green-700 text-white px-4 py-2 rounded-full font-semibold hover:bg-green-800">Yes</button>
                        <button @click="showModal = false" class="bg-gray-300 px-4 py-2 rounded-full font-semibold hover:bg-gray-400">Cancel</button>
                    </div>
                </div>
            </div>
           
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-lg font-semibold mb-2 text-gray-500">Active Orders</h2>
                        <p class="text-3xl font-bold text-green-700">{{ $stats['active_orders'] }}</p>
                    </div>
                    <div class="p-3 rounded-full text-black bg-green-100">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                </div>
                <p class="text-sm text-green-600 mt-2 flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i>
                    {{ $recentActivity }} recent activities
                </p>
            </div>
            <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-lg font-semibold mb-2 text-gray-500">Total Spent</h2>
                        <p class="text-3xl font-bold text-green-700">UGX {{ number_format($stats['total_spent']) }}</p>
                    </div>
                    <div class="p-3 rounded-full text-black bg-green-100">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
                <p class="text-sm text-green-600 mt-2 flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i>
                    This month
                </p>
            </div>
            <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-lg font-semibold mb-2 text-gray-500">Messages</h2>
                        <p class="text-3xl font-bold text-green-700">{{ $stats['messages'] }}</p>
                    </div>
                    <div class="p-3 rounded-full text-black bg-green-100">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                <p class="text-sm text-red-600 mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    Unread messages
                </p>
            </div>
            <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-lg font-semibold mb-2 text-gray-500">Wishlist</h2> 
                         <div class="mt-10">
                <h3 class="text-lg font-bold text-green-800 mb-2">Wishlist</h3>
                <div class="flex flex-wrap gap-4">
                    <template x-for="item in wishlist" :key="item.name">
                        <div class="bg-white border rounded-xl shadow p-3 flex items-center gap-2">
                           
                            <span class="font-semibold text-gray-800" x-text="item.name"></span>
                        </div>
                    </template>
                    <template x-if="wishlist.length === 0">
                        <span class="text-gray-500">No items in wishlist yet.</span>
                    </template>
                </div>
            </div>
                        <p class="text-3xl font-bold text-green-700">{{ $stats['wishlist_items'] }}</p>
                    </div>
                    <div class="p-3 rounded-full text-black bg-green-100">
                        <i class="fas fa-heart"></i>
                    </div>
                </div>
                <p class="text-sm text-green-600 mt-2 flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i>
                    Saved items
                </p>
            </div>
        </div>

        <!-- Recent Conversations -->
        @if($conversations->count() > 0)
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">Recent Conversations</h2>
            <div class="space-y-3">
                @foreach($conversations->take(5) as $conversation)
                    @php
                        $otherUser = $conversation->sender_id == $user->id ? $conversation->receiver : $conversation->sender;
                        $latestMessage = $conversation->messages->first();
                    @endphp
                    <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg cursor-pointer" onclick="window.location.href='{{ route('chat.livewire') }}'">
                        <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center text-black font-bold">
                            {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="flex justify-between">
                                <span class="font-semibold">{{ $otherUser->name }}</span>
                                <span class="text-xs text-gray-500">{{ $conversation->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="text-sm text-gray-600 truncate">
                                {{ $latestMessage ? Str::limit($latestMessage->body, 50) : 'No messages yet' }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </main>
</div>

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
</style>
@endsection