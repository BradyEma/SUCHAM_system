<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management | GoldenFields Agro</title>
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
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar Navigation -->
        <div class="w-64 bg-primary-800 border-r border-gray-200 flex flex-col">
            <!-- Logo -->
           <div class="flex items-center justify-center h-16 px-4 border-b border-primary-700">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-leaf text-yellow-500 text-xl"></i>
                        <span class="text-xl font-bold text-white">GoldenFields</span>
                        <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full ml-2">ADMIN</span>
                    </div>
                </div>
            
            <!-- Navigation -->
            <div class="flex-1 overflow-y-auto py-4 bg-primary-800 text-white">
       <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item ">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span>Activity</span>
           
        </a>
        
        <a href="{{ route('admin.inventory.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
            <i class="fas fa-boxes w-5 text-center"></i>
            <span>Inventory</span>
        </a>
        
        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
            <i class="fas fa-clipboard-list w-5 text-center"></i>
            <span>Order Management</span>
        </a>
        
        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
            <i class="fas fa-shopping-cart w-5 text-center"></i>
            <span>Procurement</span>
        </a>
        
        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
            <i class="fas fa-comment-dots w-5 text-center"></i>
            <span>Chat</span>
            <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full ml-auto">2 unread</span>
        </a>
        
        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
            <i class="fas fa-truck w-5 text-center"></i>
            <span>Logistics</span>
        </a>

         <a href="{{ route('admin.customer.segments') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-chart-pie w-5 text-center"></i>
                    <span>Customer Segments</span>
         </a>
        <a href="{{ route('support.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
            <i class="fas fa-question-circle w-5 text-center"></i>
            <span>Support Center</span>
        </a>

        
        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
            <i class="fas fa-cog w-5 text-center"></i>
            <span>Settings</span>
        </a>
    </nav>
</div>
              
            
            <!-- User Profile -->
            
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-hidden flex flex-col">
            <!-- Top Navigation -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button class="mr-4 text-gray-500 md:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800">Inventory Management</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none relative">
                            <i class="fas fa-bell"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                        </button>
                        <button class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="fas fa-question-circle"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Page Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Inventory Dashboard</h2>
                        <p class="text-gray-600">Manage your agricultural product inventory</p>
                    </div>
                    <div class="mt-4 md:mt-0 flex space-x-3">
                        <a href="{{ route('admin.inventory.create') }}" class="flex items-center bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg shadow transition-colors duration-200">
                            <i class="fas fa-plus mr-2"></i> Add New Item
                        </a>
                        <button class="flex items-center bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg shadow transition-colors duration-200">
                            <i class="fas fa-download mr-2"></i> Export
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-secondary-500 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Products</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalItems }}</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-boxes text-primary-600"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-secondary-500 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Low Stock Items</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $lowStockItems }}</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-exclamation-triangle text-primary-600"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-secondary-500 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Inventory Value</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($totalValue, 2) }}</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <span class="text-primary-600 font-semibold">UGX</span>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search and Filters -->
                <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <form action="{{ route('admin.inventory.index') }}" method="GET" class="mb-4">
                                    <input type="text" name="search" id="search"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Search products..." value="{{ request('search') }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Inventory Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            Product
                                            <button class="ml-1 text-gray-400 hover:text-gray-500">
                                                <i class="fas fa-sort"></i>
                                            </button>
                                        </div>
                                    </th>
                                    
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Stock
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Unit_Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Measurement
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
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
                                                $reorderLevel = $item->reorder_level ?: 1;
                                                $percentage = $reorderLevel > 0 ? min(100, ($item->quantity / $reorderLevel) * 100) : 0;
                                            @endphp
                                            <div class="bg-primary-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->unit_price }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->unit_of_measurement }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($item->quantity == 0)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Out of Stock
                                        </span>
                                        @elseif($item->quantity <= $item->reorder_level)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Low Stock
                                        </span>
                                        @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            In Stock
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-3">
                                            <a href="{{ route('admin.inventory.edit', $item->id) }}" class="text-primary-600 hover:text-primary-900 transition-colors duration-200">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.inventory.destroy', $item->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200" onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.inventory.show', $item->id) }}" class="text-gray-600 hover:text-gray-900 transition-colors duration-200" title="View Details">
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
                                @if ($items->onFirstPage())
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 rounded-md cursor-not-allowed">
                                    Previous
                                </span>
                                @else
                                <a href="{{ $items->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-md transition-colors duration-200">
                                    Previous
                                </a>
                                @endif

                                @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                                    @if ($page == $items->currentPage())
                                    <span class="relative inline-flex items-center px-4 py-2 border border-primary-500 bg-primary-50 text-sm font-medium text-primary-600 rounded-md">
                                        {{ $page }}
                                    </span>
                                    @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-md transition-colors duration-200">
                                        {{ $page }}
                                    </a>
                                    @endif
                                @endforeach

                                @if ($items->hasMorePages())
                                <a href="{{ $items->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-md transition-colors duration-200">
                                    Next
                                </a>
                                @else
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 rounded-md cursor-not-allowed">
                                    Next
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inventory Summary Chart -->
                <div class="mt-8 bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Inventory Overview</h3>
                    </div>
                    <div class="p-6">
                        <div class="h-64">
                            <canvas id="inventoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Initialize inventory chart
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('inventoryChart').getContext('2d');
            const inventoryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Sugar', 'Molasses', 'Syrup', 'Brown Sugar', 'Organic', 'Specialty'],
                    datasets: [{
                        label: 'Current Stock',
                        data: [120, 85, 65, 45, 30, 15],
                        backgroundColor: 'rgba(34, 197, 94, 0.7)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Reorder Level',
                        data: [40, 30, 25, 20, 15, 10],
                        backgroundColor: 'rgba(249, 115, 22, 0.7)',
                        borderColor: 'rgba(249, 115, 22, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        // Search functionality
        document.getElementById('search').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const productName = row.querySelector('td:first-child div div:first-child').textContent.toLowerCase();
                if (productName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>