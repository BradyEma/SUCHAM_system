<!DOCTYPE html>
<html lang="en" x-data="wishlistComponent()" x-init="initWishlist()">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <title>Customer Dashboard | GoldenFields</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="goldenfields.ico" type="image/x-icon">
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
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item active">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="text-black">Products</span>
            </a>

            <a href="{{ route('wishlist.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-item hover:bg-primary-700 relative">
                <i class="fas fa-heart w-5 text-center text-primary-200"></i>
                <span class="text-white">My Wishlist</span>
                <span x-show="wishlist.length > 0"
                      class="absolute top-3 right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full"
                      x-text="wishlist.length"></span>
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
        <button type="submit"
            class="w-full flex items-center justify-center px-4 py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-yellow-600 hover:bg-secondary-700">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-primary-800">Our Products</h2>
            <div class="text-sm text-primary-600">
                <span x-text="wishlist.length"></span> items in wishlist
            </div>
        </div>

        <div x-data="cartComponent()">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
        <template x-for="product in products" :key="product.name">
            <div class="product-card relative flex flex-col rounded-2xl shadow-md p-4 bg-white hover:shadow-lg transition-shadow duration-300">
                <div class="relative w-full h-48 overflow-hidden rounded-xl mb-4">
                    <img :src="product.img" :alt="product.name"
                         class="w-full h-full object-cover product-image transition-transform duration-300">
                    <button @click.prevent="openModal(product)"
                            class="absolute top-3 right-3 bg-white bg-opacity-90 hover:bg-primary-100 text-primary-700 rounded-full w-8 h-8 flex items-center justify-center shadow transition z-10">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-1" x-text="product.name"></h3>
                <p class="text-primary-600 font-semibold mb-3" x-text="'UGX ' + product.price"></p>
                <div class="flex justify-between mt-auto">
                    <button
                      @click.prevent="addToCart(product)"
                      class="bg-primary-600 hover:bg-primary-700 text-white text-sm px-4 py-2 rounded-lg font-medium transition">
                        Add to Cart
                    </button>

                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-2 rounded-lg font-medium transition">
                        Order Now
                    </button>
                </div>
            </div>
        </template>
    </div>
</div>

        <!-- Modal -->
        <div x-show="showModal" x-transition class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" style="display: none;">
            <div class="bg-white rounded-xl shadow-2xl p-8 w-96">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Add to Wishlist</h3>
                    <button @click="showModal = false" type="button" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <p class="mb-6 text-gray-600">
                    Add <span class="font-semibold text-primary-700" x-text="modalProduct?.name"></span> to your wishlist?
                </p>

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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mb-8 mt-10">
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
    </main>
 
</div>




<script>
    function wishlistComponent() {
        return {
            wishlist: [],
            showModal: false,
            modalProduct: null,

            products: [
                {
                    name: "Brown Sugar",
                    price: 5000,
                    img: "/product_images/brownsugar.jpg"
                },
                {
                    name: "White Sugar",
                    price: 5500,
                    img: "/product_images/whitesugar.jpg"
                },
                {
                    name: "Raw Sugar",
                    price: 3500,
                    img: "/product_images/raw-sugar.jpg"
                },
                {
                    name: "Sugar Cubes",
                    price: 6000,
                    img: "/product_images/sugarcubes.png"
                },
                {
                    name: "Molasses",
                    price: 2000,
                    img: "/product_images/molasses.jpg"
                },
                {
                    name: "Bagase",
                    price: 2500,
                    img: "/product_images/bagase.png"
                }
            ],

            openModal(product) {
                this.modalProduct = product;
                this.showModal = true;
            },

            initWishlist() {
                fetch('/wishlist/count')
                    .then(res => res.json())
                    .then(data => {
                        this.wishlist = Array(data.count).fill({});
                    });
            },

            addToWishlist(product) {
                fetch('/wishlist', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_name: product.name,
                        product_image: product.img,
                        price: product.price
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error("Network response was not ok");
                    return response.json();
                })
                .then(data => {
                    alert(data.message);
                    this.wishlist.push(product);
                    this.showModal = false;
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Failed to add to wishlist.");
                });
            }
        }
    }

    // ✅ MOVE THIS OUTSIDE
    function cartComponent() {
        return {
            products: [
                {
                    name: "Brown Sugar",
                    price: 5000,
                    img: "/product_images/brownsugar.jpg"
                },
                {
                    name: "White Sugar",
                    price: 5500,
                    img: "/product_images/whitesugar.jpg"
                },
                {
                    name: "Raw Sugar",
                    price: 3500,
                    img: "/product_images/raw-sugar.jpg"
                },
                {
                    name: "Sugar Cubes",
                    price: 6000,
                    img: "/product_images/sugarcubes.png"
                },
                {
                    name: "Molasses",
                    price: 2000,
                    img: "/product_images/molasses.jpg"
                },
                {
                    name: "Bagase",
                    price: 2500,
                    img: "/product_images/bagase.png"
                }
            ],

            addToCart(product) {
                fetch('{{ route('customer.cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        product_name: product.name,
                        price: product.price,
                        quantity: 1
                    })
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(err => {
                    console.error(err);
                    alert('Error adding to cart');
                });
            }
        }
    }
</script>



</body>
</html>
