<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart | GoldenFields</title>
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
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
        .cart-item:hover {
            background-color: #f8fafc;
        }
        .quantity-btn {
            transition: all 0.2s ease;
        }
        .quantity-btn:hover {
            background-color: #e5e7eb;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-primary-800 to-primary-900 text-white p-6 pt-0 space-y-8 shadow-xl">
            <div class="flex items-center justify-center h-16 px-4 border-b border-primary-700">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-leaf text-yellow-400 text-xl"></i>
                    <span class="text-xl font-bold">GoldenFields</span>
                    <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full ml-2">Customer</span>
                </div>
            </div>

            <div class="p-1 border-b border-primary-700 flex items-center space-x-3 -mt-5">
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
            <a href="{{ route('customer.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item">
                <i class="fas fa-tachometer-alt w-5 text-center text-primary-200"></i>
                <span class="text-white">Products</span>
            </a>

            <a href="{{ route('wishlist.index') }}"
   class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 relative">
    <i class="fas fa-heart w-5 text-center text-primary-200"></i>
    <span class="text-white">My Wishlist</span>

    @if(isset($wishlistCount) && $wishlistCount > 0)
        <span class="absolute top-3 right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
            {{ $wishlistCount }}
        </span>
    @endif
</a>
           
<a href="{{ route('customer.cart') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 relative active">
    <i class="fas fa-shopping-cart w-5 text-center text-black"></i>
    <span class="text-black">My Cart</span>

    @if(isset($cartCount) && $cartCount > 0)
        <span class="absolute top-3 right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
            {{ $cartCount }}
        </span>
    @endif
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

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-auto">
            <div class="max-w-6xl mx-auto">
                <!-- Page Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">My Shopping Cart</h1>
                        <p class="text-gray-600">Review and checkout your items</p>
                    </div>
                    <a href="{{ route('customer.products') }}" class="flex items-center text-primary-600 hover:text-primary-700">
                        <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                    </a>
                </div>

                <!-- Cart Content -->
                @if($cartItems->isEmpty())
                    <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-shopping-cart text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Your cart is empty</h3>
                        <p class="text-gray-500 mb-6">Add some GoldenFields products to get started</p>
                        <a href="{{ route('customer.dashboard') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                            Browse Products
                        </a>
                    </div>
                @else
                    <!-- Cart Items -->
                    <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
                        <div class="divide-y divide-gray-200">
                            <!-- Cart Table Headers (for larger screens) -->
                            <div class="hidden md:grid grid-cols-12 gap-4 bg-gray-50 p-4">
                                <div class="col-span-5 font-medium text-gray-700">Product</div>
                                <div class="col-span-2 font-medium text-gray-700">Price</div>
                                <div class="col-span-2 font-medium text-gray-700">Quantity</div>
                                <div class="col-span-2 font-medium text-gray-700">Total</div>
                                <div class="col-span-1"></div>
                            </div>
                            
                            <!-- Cart Items -->
                            @foreach($cartItems as $item)
                                <div class="cart-item grid grid-cols-1 md:grid-cols-12 gap-4 p-4 items-center">
                                    <!-- Product Info -->
                                    <div class="col-span-5 flex items-center">
    <img src="{{ asset($item->product_image ?? 'product_images/default.jpg') }}" 
     alt="{{ $item->product_name }}" 
     class="w-16 h-16 object-cover rounded-lg mr-4">
    <div>
        <h3 class="font-medium text-gray-800">{{ $item->product->name ?? $item->product_name }}</h3>
        <p class="text-sm text-gray-500">Product ID: GF-{{ str_pad($item->product_id ?? 0, 2, '0', STR_PAD_LEFT) }}</p>
    </div>
</div>

                                    
                                    <!-- Price -->
                                    <div class="col-span-2 text-gray-700">
                                        UGX {{ number_format($item->price) }}
                                    </div>
                                    
                                    <!-- Quantity -->
                                    <div class="col-span-2">
                                        <div class="flex items-center border border-gray-300 rounded-lg w-24">
                                            <form action="{{ route('cart.decrease', $item->id) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="quantity-btn w-8 h-8 flex items-center justify-center rounded-l-lg">
                                                    <i class="fas fa-minus text-gray-500"></i>
                                                </button>
                                            </form>
                                            <span class="flex-1 text-center">{{ $item->quantity }}</span>
                                            <form action="{{ route('cart.increase', $item->id) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="quantity-btn w-8 h-8 flex items-center justify-center rounded-r-lg">
                                                    <i class="fas fa-plus text-gray-500"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!-- Total -->
                                    <div class="col-span-2 font-medium text-gray-800">
                                        UGX {{ number_format($item->price * $item->quantity) }}
                                    </div>
                                    
                                    <!-- Remove -->
                                    <div class="col-span-1 text-right">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Checkout Section -->
                    <div class="bg-white shadow rounded-lg p-6">
                       <form action="{{ route('cart.checkout') }}" method="POST">
    @csrf
    <h2 class="text-lg font-bold text-gray-800 mb-4">Checkout Details</h2>
    
    <!-- Retailer Selection -->
    <div class="mb-6">
        <label for="retailer_location" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="fas fa-store mr-2 text-primary-600"></i> Select Your Location
        </label>
        <select name="retailer_id" id="retailer_location" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            @foreach($retailers as $retailer)
                <option value="{{ $retailer->id }}">{{ $retailer->branch_name }} - {{ $retailer->location }}</option>
            @endforeach
        </select>
    </div>

    <!-- Static Payment Method Selection -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">
            <i class="fas fa-credit-card mr-2 text-primary-600"></i> Payment Method
        </label>
        <div class="space-y-3">
            <!-- Credit Card -->
            <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-primary-400 transition cursor-pointer">
                <input type="radio" id="credit-card" name="payment_method" value="credit_card" class="h-4 w-4 text-primary-600 focus:ring-primary-500">
                <div class="ml-3 flex items-center">
                    <div class="flex space-x-2 mr-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-6" alt="Visa" onerror="this.style.display='none'">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6" alt="Mastercard" onerror="this.style.display='none'">
                    </div>
                    <label for="credit-card" class="block text-sm font-medium text-gray-700 cursor-pointer">Credit/Debit Card</label>
                </div>
            </div>

            <!-- Mobile Money -->
            <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-primary-400 transition cursor-pointer">
                <input type="radio" id="mobile-money" name="payment_method" value="mobile_money" class="h-4 w-4 text-primary-600 focus:ring-primary-500" checked>
               <div class="flex items-center">
    <i class="fas fa-mobile-alt text-purple-600 text-xl mr-2 ml-5"></i>
    <span class="text-sm">Mobile Money</span>
</div>
            </div>

            <!-- Pay on Delivery -->
            <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-primary-400 transition cursor-pointer">
                <input type="radio" id="cash-on-delivery" name="payment_method" value="cash_on_delivery" class="h-4 w-4 text-primary-600 focus:ring-primary-500">
                <div class="ml-3 flex items-center">
                    <i class="fas fa-money-bill-wave text-green-500 text-xl mr-4"></i>
                    <label for="cash-on-delivery" class="block text-sm font-medium text-gray-700 cursor-pointer">Pay on Delivery</label>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Order Summary -->
    <div class="border-t border-gray-200 pt-4">
        <h3 class="text-md font-medium text-gray-800 mb-3">Order Summary</h3>
        <div class="space-y-2 mb-4">
            <div class="flex justify-between">
                <span class="text-gray-600">Subtotal</span>
                <span class="font-medium">
                    UGX {{ number_format($cartItems->sum(fn($item) => $item->price * $item->quantity)) }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Delivery Fee</span>
                <span class="font-medium">UGX {{ number_format($deliveryFee) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Tax</span>
                <span class="font-medium">UGX {{ number_format($tax) }}</span>
            </div>
        </div>
        <div class="border-t border-gray-200 pt-3 flex justify-between font-bold text-lg">
            <span>Total</span>
            <span class="text-primary-600">UGX {{ number_format($totalAmount) }}</span>
        </div>
    </div>
    
    <!-- Checkout Button -->
    <div class="mt-6">
        <button type="submit" 
                class="w-full bg-primary-600 hover:bg-primary-700 text-white py-3 rounded-lg font-semibold shadow-md transition flex items-center justify-center">
            <i class="fas fa-lock mr-2"></i> Secure Checkout
        </button>
    </div>
</form>
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>