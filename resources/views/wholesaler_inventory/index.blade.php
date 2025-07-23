<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldenFields - Wholesaler Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
        :root {
            --primary-green: #166534; /* Deep green */
            --secondary-green: #22c55e; /* Vibrant green */
            --gold: #d4af37; /* Luxury gold */
            --light-gold: #fef3c7; /* Light gold for backgrounds */
            --dark-text: #1f2937;
            --light-text: #6b7280;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f3f4f6;
        }
        
        .card {
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .btn-primary {
            background-color: var(--gold);
            color: white;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #b8860b;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(212, 175, 55, 0.3);
        }
        
        .sidebar {
            background: linear-gradient(180deg, #166534 0%, #14532d 100%);
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
        .search-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }
        
        .table-row:hover {
            background-color: #f9fafb;
        }
        
        .gold-gradient-text {
            background: linear-gradient(90deg, var(--gold), #fbbf24);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar text-white w-64 flex-shrink-0 hidden md:flex md:flex-col">
            <div class="flex items-center justify-center p-6 border-b border-yellow-500">
                <div class="flex items-center">
                    <i class="fas fa-store-alt text-yellow-400 text-2xl mr-3"></i>
                    <span class="text-xl font-bold">GoldenFields</span>
                </div>
            </div>
            <div class="flex-grow p-4 overflow-y-auto">
                <nav class="space-y-1">
                    <a href="{{ route('wholesaler.dashboard') }}"   class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('wholesaler.inventory.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
                        <i class="fas fa-boxes mr-3"></i>
                        Inventory
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-shopping-cart mr-3"></i>
                        Orders
                        <span class="ml-auto bg-yellow-500 text-black text-xs px-2 py-1 rounded-full">3</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-truck mr-3"></i>
                        Deliveries
                    </a>
                   
                    <a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-chart-line mr-3"></i>
                        Messages
                        <span class="ml-auto bg-yellow-500 text-black text-xs px-2 py-1 rounded-full">5</span>
                    </a>
                    <a href="{{ route('support.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-question-circle w-5 text-center"></i>
                        <span>Support Center</span>
                    </a>
                    
                    <a href="{{ route('wholesaler.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-comments mr-3"></i>
                        Profile
                        
                    </a>
                </nav>
                
                <div class="mt-auto p-4">
                    
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        <span class="gold-gradient-text">Inventory Management</span>
                    </h1>
                    <p class="text-gray-600">Manage your product listings and inventory</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-bell text-gray-400"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="card bg-white p-5 border-l-4 border-green-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Total Products</h3>
                            <div class="text-2xl font-bold text-green-800">{{ $totalProducts }}</div>
                        </div>
                        <div class="bg-green-100 p-2 rounded-lg">
                            <i class="fas fa-boxes text-green-600"></i>
                        </div>
                    </div>
                </div>

                <div class="card bg-white p-5 border-l-4 border-blue-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">In Stock</h3>
                            <div class="text-2xl font-bold text-blue-800">{{ $inStock }}</div>
                        </div>
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <i class="fas fa-check-circle text-blue-600"></i>
                        </div>
                    </div>
                </div>

                <div class="card bg-white p-5 border-l-4 border-amber-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Low Stock</h3>
                            <div class="text-2xl font-bold text-amber-800">{{ $lowStock }}</div>
                        </div>
                        <div class="bg-amber-100 p-2 rounded-lg">
                            <i class="fas fa-exclamation-triangle text-amber-600"></i>
                        </div>
                    </div>
                </div>

                <div class="card bg-white p-5 border-l-4 border-red-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Out of Stock</h3>
                            <div class="text-2xl font-bold text-red-800">{{ $outOfStock }}</div>
                        </div>
                        <div class="bg-red-100 p-2 rounded-lg">
                            <i class="fas fa-times-circle text-red-600"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Bar -->
            <div class="card bg-white p-4 mb-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                    <div class="relative w-full md:w-64">
                        <input type="text" placeholder="Search products..." class="search-input w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-gold-500">
                        <span class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-search"></i></span>
                    </div>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('wholesaler_inventory.create') }}">
                            <button class="btn-primary flex items-center">
                                <i class="fas fa-plus mr-2"></i> Add Product
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Inventory Table -->
            <div class="card bg-white overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price (UGX)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Measurements</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($products as $product)
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-box text-green-600"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $product->product_name }}</div>
                                                <div class="text-sm text-gray-500">Category</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->product_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->stock }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ number_format($product->unit_price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->measurements }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($product->stock > 20)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle mr-1"></i> In Stock
                                            </span>
                                        @elseif($product->stock > 0)
                                            <span class="badge badge-warning">
                                                <i class="fas fa-exclamation-triangle mr-1"></i> Low Stock
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times-circle mr-1"></i> Out of Stock
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <!-- View -->
                                            <a href="{{ route('wholesaler_inventory.show', $product->id) }}" class="text-green-600 hover:text-green-900">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('wholesaler_inventory.edit', $product->id) }}" class="text-amber-600 hover:text-amber-900">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('wholesaler_inventory.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Showing 
                    <span class="font-medium">{{ $products->firstItem() }}</span> 
                    to 
                    <span class="font-medium">{{ $products->lastItem() }}</span> 
                    of 
                    <span class="font-medium">{{ $products->total() }}</span> 
                    results
                </div>

                <!-- Custom Pagination Styling -->
                <div class="flex space-x-2">
                    {{-- Previous Page Link --}}
                    @if ($products->onFirstPage())
                        <span class="px-3 py-1 border rounded-lg text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <span class="px-3 py-1 border rounded-lg bg-green-800 text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 border rounded-lg hover:bg-gray-100">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="px-3 py-1 border rounded-lg text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>