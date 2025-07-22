<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Products - GoldenFields Customer Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            background: linear-gradient(180deg, #166534 0%, #14532d 100%);
        }
        .nav-item:hover {
            background-color: rgba(255, 215, 0, 0.1);
        }
        .nav-item.active {
            background-color: #f0fdf4;
            color: #14532d;
            font-weight: 600;
        }
        .badge-in-stock {
            background-color: #f0fdf4;
            color: #166534;
        }
        .badge-low-stock {
            background-color: #fef3c7;
            color: #92400e;
        }
        .badge-out-of-stock {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 sidebar text-white p-6 space-y-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md">
                    <img src="{{ asset('goldenfields.png') }}" alt="GoldenFields Logo" class="h-8 w-8 rounded-full">
                </div>
                <div>
                    <div class="text-xl font-bold">GoldenFields</div>
                    <div class="text-xs text-green-200">Customer Portal</div>
                </div>
            </div>
            <nav class="space-y-1">
                <a href="{{ route('customer.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('customer.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-box w-5 text-center"></i>
                    <span>My Orders</span>
                </a>
                <a href="{{ route('customer.products') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
                    <i class="fas fa-store w-5 text-center"></i>
                    <span>Browse Products</span>
                </a>
                <a href="{{ route('support.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-question-circle w-5 text-center"></i>
                    <span>Support</span>
                </a>
                <a href="{{ route('customer.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-user w-5 text-center"></i>
                    <span>Profile</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-green-800">Available Products</h1>
                <p class="text-gray-600">Choose from a variety of quality agricultural products</p>
            </div>

            <!-- Product Listing -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Example Product Card -->
                @foreach ($products as $product)
                <div class="bg-white rounded-xl shadow-md overflow-hidden border product-card">
                    <img src="{{ asset($product->image ?? 'default.jpg') }}" class="w-full h-48 object-cover" alt="{{ $product->name }}">
                    <div class="p-6 space-y-2">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-bold text-green-800">{{ $product->name }}</h3>
                            <span class="text-sm {{ $product->stock > 0 ? 'badge-in-stock' : 'badge-out-of-stock' }}">
                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500">{{ $product->category }}</p>
                        <p class="text-green-600 font-semibold">UGX {{ number_format($product->price) }}{{ $product->unit ? '/' . $product->unit : '' }}</p>

                        <form action="{{ route('customer.orders.create') }}" method="GET">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit"
                                class="mt-3 w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg text-sm font-medium">
                                Order Now
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination (if using pagination) -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </main>
    </div>
</body>
</html>
