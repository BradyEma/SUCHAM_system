<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldenFields - Retailer Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <script src="https://cdn.tailwindcss.com"></script>
     <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        accent: {
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
<body class="min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
         <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-primary-800 text-white">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 px-4 border-b border-primary-700">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-leaf text-yellow-400 text-xl"></i>
                        <span class="text-xl font-bold">GoldenFields</span>
                        <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full ml-2">RETAILER</span>
                    </div>
                </div>
                
                <!-- Retailer Profile -->
                <div class="p-4 border-b border-primary-700 flex items-center space-x-3">
                    <img 
        src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-avatar.png') }}" 
        alt="{{ $user->name }}" 
        class="h-10 w-10 rounded-full border-2 border-yellow-400"
    >
                    <div>
                        <p class="font-medium">{{ $user->name }}</p>
                        <p class="text-xs text-primary-200">Retailer</p>
                    </div>
                </div>
                
                <!-- Main Navigation -->
                <div class="flex-1 overflow-y-auto py-4">
                    <nav class="px-2 space-y-1">
                        <!-- Dashboard -->
                        <a href="{{ route('retailer.dashboard') }}" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                            <i class="fas fa-tachometer-alt mr-3 "></i>
                            Dashboard
                        </a>
                        
                        <!-- Inventory -->
                        <a href="{{ route('retailer.inventory.index') }}" class="bg-white text-black group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                            <i class="fas fa-boxes mr-3 text-black"></i>
                            Inventory
                            <span class="bg-black text-white text-xs font-bold px-2 py-0.5 rounded-full ml-auto">{{ number_format($lowStockCount) }}</span>
                        </a>
                        
                        <!-- Orders -->
                        <a href="{{ route('retailer.orders') }}" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                            <i class="fas fa-shopping-cart mr-3"></i>
                            My Orders
                            <span class="bg-yellow-400 text-black text-xs font-bold px-2 py-0.5 rounded-full ml-auto">{{ $pendingOrders }}</span>
                        </a>
                        
                        <a href="#" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                                <i class="fas fa-bell mr-3"></i>
                                Messages
                        </a>
                        
                        <!-- Support -->
                        <a href="#" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                            <i class="fas fa-headset mr-3"></i>
                            Support Center
                        </a>
                        
                        <a  href="{{ route('retailer.profile') }}" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                            <i class="fas fa-headset mr-3"></i>
                            Profile
                        </a>

                    </nav>
                    
                   
                </div>
                
                <!-- Logout -->
                <div class="p-4 border-t border-primary-700">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-yellow-500 hover:bg-secondary-700">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </button>
    </form>
</div>
            </div>
        </div>

        <!-- Mobile sidebar -->
        <div class="md:hidden fixed inset-0 z-40 hidden" id="mobile-sidebar">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
            <div class="relative flex flex-col w-72 max-w-xs bg-primary-800 text-white">
                <div class="flex items-center justify-between h-16 px-4 border-b border-primary-700">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-leaf text-secondary-400 text-xl"></i>
                        <span class="text-xl font-bold">GoldenFields</span>
                    </div>
                    <button type="button" class="text-white focus:outline-none" id="close-mobile-sidebar">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto py-4">
                    <!-- Mobile navigation items would go here -->
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-black">
                        <span class="gold-gradient-text text-black">Inventory Management</span>
                    </h1>
                    <p class="text-primary-800">Manage your product listings and inventory</p>
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
            <div class="text-2xl font-bold text-green-800">{{ number_format($totalProducts) }}</div>
        </div>
        <div class="bg-green-100 p-2 rounded-lg">
            <i class="fas fa-boxes text-green-600"></i>
        </div>
    </div>
</div>

                
                <div class="card bg-white p-5 border-l-4 border-green-500">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-1">Out of Stock</h3>
            <div class="text-2xl font-bold text-blue-800">{{ number_format($outOfStockCount) }}</div>
        </div>
        <div class="bg-blue-100 p-2 rounded-lg">
            <i class="fas fa-check-circle text-blue-600"></i>
        </div>
    </div>
</div>

                
                <div class="card bg-white p-5 border-l-4 border-green-500">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-1">Low Stock</h3>
            <div class="text-2xl font-bold text-amber-800">{{ number_format($lowStockCount) }}</div>
        </div>
        <div class="bg-amber-100 p-2 rounded-lg">
            <i class="fas fa-exclamation-triangle text-amber-600"></i>
        </div>
    </div>
</div>

                
                <div class="card bg-white p-5 border-l-4 border-green-500">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-1">Total Amount</h3>
            <div class="text-2xl font-bold text-red-800">
                UGX {{ number_format($totalAmount) }}
            </div>
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
   <form action="{{ route('retailer.inventory.index') }}" method="GET" class="mb-4">
    <input type="text" name="search" id="search"
        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
        placeholder="Search products..." value="{{ request('search') }}">
</form>

</div>

                    
                    <div class="flex space-x-3">
                        
                        <a href="{{ route('retailer.inventory.create') }}" >
                            <button class="btn-primary bg-green-600 flex items-center text-white">
                                <i class="fas fa-plus mr-2"></i> Add Product
                            </button>
                        </a>
                        <form action="{{ route('retailer.inventory.index') }}" method="GET" class="flex items-center gap-4 mb-4">
   
    <!-- Filter dropdown -->
    <select name="status" class="py-2 px-3 border border-gray-300 rounded-lg">
        <option value="">All Status</option>
        <option value="low" {{ request('status') == 'low' ? 'selected' : '' }}>Low Stock</option>
        <option value="out" {{ request('status') == 'out' ? 'selected' : '' }}>Out of Stock</option>
        <option value="in" {{ request('status') == 'in' ? 'selected' : '' }}>In Stock</option>
    </select>

    <button type="submit"
        class="flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
        <i class="fas fa-filter mr-2"></i> Filter
    </button>
</form>

                    </div>
                </div>
            </div>
            
            <!-- Inventory Table -->
           <div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center">
                            Product
                            <button class="ml-1 text-gray-400 hover:text-gray-500">
                                <i class="fas fa-sort"></i>
                            </button>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Measurement</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($items as $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $item->product_image) }}" alt="{{ $item->product_name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->sku }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->quantity }}</div>
                            <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                                @php
                                    $minStock = $item->minimum_stock_level ?: 1;
                                    $percentage = $minStock > 0 ? min(100, ($item->quantity / $minStock) * 100) : 0;
                                @endphp
                                <div class="bg-primary-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ number_format($item->unit_price) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->unit_of_measurement }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->quantity == 0)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Out of Stock</span>
                            @elseif($item->quantity <= $item->minimum_stock_level)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Low Stock</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('retailer.inventory.edit', $item->id) }}" class="text-primary-600 hover:text-primary-900 transition-colors duration-200">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('retailer.inventory.destroy', $item->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200" onclick="return confirm('Are you sure you want to delete this item?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('retailer.inventory.show', $item->id) }}" class="text-gray-600 hover:text-gray-900 transition-colors duration-200" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ $items->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $items->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $items->total() }}</span>
                    results
                </p>
            </div>
            <div class="flex space-x-2">
                {{-- Previous --}}
                @if ($items->onFirstPage())
                    <span class="inline-flex px-4 py-2 bg-gray-100 text-sm text-gray-400 rounded-md">Previous</span>
                @else
                    <a href="{{ $items->previousPageUrl() }}" class="inline-flex px-4 py-2 bg-white text-sm text-gray-700 hover:bg-gray-50 border rounded-md">Previous</a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                    @if ($page == $items->currentPage())
                        <span class="inline-flex px-4 py-2 bg-primary-50 text-primary-600 text-sm font-medium border border-primary-500 rounded-md">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="inline-flex px-4 py-2 bg-white text-sm text-gray-700 hover:bg-gray-50 border rounded-md">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($items->hasMorePages())
                    <a href="{{ $items->nextPageUrl() }}" class="inline-flex px-4 py-2 bg-white text-sm text-gray-700 hover:bg-gray-50 border rounded-md">Next</a>
                @else
                    <span class="inline-flex px-4 py-2 bg-gray-100 text-sm text-gray-400 rounded-md">Next</span>
                @endif
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</body>
</html>