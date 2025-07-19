<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Wishlist | GoldenFields</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
        .nav-item:hover {
            background-color: rgba(255, 215, 0, 0.1);
        }
        .nav-item.active {
            background-color: #f0fdf4;
            color: #14532d;
            font-weight: 600;
        }
        .stat-card {
            border-left: 4px solid;
        }
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-50">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-primary-800 to-primary-900 text-white p-6 pt-0 space-y-8 shadow-xl">
        @php $user = auth()->user(); @endphp
        <div class="flex items-center justify-center h-16 px-4 py-0 border-b border-primary-700 mt-0">
            <div class="flex items-center space-x-2">
                <i class="fas fa-leaf text-yellow-400 text-xl"></i>
                <span class="text-xl font-bold">GoldenFields</span>
                <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full ml-2">Customer</span>
            </div>
        </div>
        <div class="p-1 border-b border-primary-700 flex items-center space-x-3 -mt-5">
            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-avatar.png') }}"
                 alt="{{ $user->name }}"
                 class="h-10 w-10 rounded-full border-2 border-yellow-400">
            <div>
                <p class="font-medium">{{ $user->name }}</p>
                <p class="text-xs text-primary-200">Verified Account</p>
            </div>
        </div>
        <nav class="space-y-1">
            <a href="{{ route('customer.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700">
                <i class="fas fa-tachometer-alt w-5 text-center text-primary-200"></i>
                <span class="text-white">Dashboard</span>
            </a>
            <a href="{{ route('wishlist.index') }}"
   class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item active hover:bg-primary-700 relative">
    <i class="fas fa-heart w-5 text-center text-black"></i>
    <span class="text-black">My Wishlist</span>

    @if(isset($wishlistCount) && $wishlistCount > 0)
        <span class="absolute top-3 right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
            {{ $wishlistCount }}
        </span>
    @endif
</a>



            <a href="{{ route('customer.cart') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700">
                    <i class="fas fa-shopping-cart w-5 text-center text-primary-200"></i>
                    <span class="text-white">My Cart</span>
            </a>
            <a href="{{ route('customer.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700">
                <i class="fas fa-clipboard-list w-5 text-center text-primary-200"></i>
                <span class="text-white">Orders</span>
            </a>
            <a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 relative">
                <i class="fas fa-comment-dots w-5 text-center text-primary-200"></i>
                <span class="text-white">Chat</span>
                @if(isset($unreadCount) && $unreadCount > 0)
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
    <main class="flex-1 p-6">
     @if(session('success'))
    <div id="success-alert" 
         class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 relative">
        {{ session('success') }}
        <button onclick="document.getElementById('success-alert').style.display='none'" 
                class="absolute top-1 right-2 text-green-700 font-bold hover:text-green-900
                       text-3xl leading-none w-8 h-8 flex items-center justify-center rounded-full
                       focus:outline-none focus:ring-2 focus:ring-green-400"
                aria-label="Close">&times;</button>
    </div>
@endif

@if(session('error'))
    <div id="error-alert" 
         class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 relative">
        {{ session('error') }}
        <button onclick="document.getElementById('error-alert').style.display='none'" 
                class="absolute top-1 right-2 text-red-700 font-bold hover:text-red-900
                       text-3xl leading-none w-8 h-8 flex items-center justify-center rounded-full
                       focus:outline-none focus:ring-2 focus:ring-red-400"
                aria-label="Close">&times;</button>
    </div>
@endif



        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">My Wishlist</h1>
                    <p class="text-gray-600">Your saved GoldenFields products</p>
                </div>
                <a href="{{ route('customer.dashboard') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                    <i class="fas fa-plus mr-2"></i> Browse Products
                </a>
            </div>

            @if ($wishlistItems->isEmpty())
    <div class="bg-white rounded-xl shadow-sm p-12 text-center">
        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-heart text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-1">Your wishlist is empty</h3>
        <p class="text-gray-500 mb-6">Start adding products you love to your wishlist</p>
        <a href="{{ route('customer.dashboard') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
            Browse Products
        </a>
    </div>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($wishlistItems as $item)
            <div class="wishlist-item bg-white border border-gray-200 rounded-lg overflow-hidden transition duration-300">
                <div class="relative">
                    <img src="{{ asset($item->product_image) }}" 
     alt="{{ $item->product_name }}" 
     class="w-full h-48 object-cover">

                    <div class="absolute top-3 right-3">
                        <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow hover:bg-red-50 text-red-500 hover:text-red-600"
                                    title="Remove from wishlist">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $item->product_name }}</h3>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-primary-600 font-bold">UGX {{ number_format($item->price ?? 0) }}</span>
                        <span class="bg-green-100 text-green-800 stock-badge">In Stock</span>
                    </div>
                    <div x-data="{
    product_id: getProductIdByName('{{ $item->product_name }}')
}">
    <form action="{{ route('customer.cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" :value="product_id">
        <input type="hidden" name="product_name" value="{{ $item->product_name }}">
        <input type="hidden" name="price" value="{{ $item->price }}">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="product_image" value="{{ $item->product_image }}">

        <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-lg">
            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
        </button>
    </form>
</div>

                </div>
            </div>
        @endforeach
    </div>
@endif

        </div>
    </main>
</div>

<script>

     const products = [
        { product_id: 1, name: "Brown Sugar" },
        { product_id: 2, name: "White Sugar" },
        { product_id: 3, name: "Raw Sugar" },
        { product_id: 4, name: "Sugar Cubes" },
        { product_id: 5, name: "Molasses" },
        { product_id: 6, name: "Bagase" },
    ];

    function getProductIdByName(name) {
        const product = products.find(p => p.name === name);
        return product ? product.product_id : null;
    }

    function wishlistPage() {
        return {
            wishlist: [],
            loadWishlist() {
                const stored = localStorage.getItem('wishlist');
                this.wishlist = stored ? JSON.parse(stored) : [];
            },
            removeFromWishlist(index) {
                this.wishlist.splice(index, 1);
                localStorage.setItem('wishlist', JSON.stringify(this.wishlist));
            }
        }
    }
</script>

</body>
</html>
