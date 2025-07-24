<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management | GoldenFields</title>
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
        .chart-bar:hover {
            opacity: 0.8;
            transition: opacity 0.2s ease;
        }
        .highlight-row {
            animation: highlight 2s ease-out;
        }
        @keyframes highlight {
            0% { background-color: rgba(34, 197, 94, 0.3); }
            100% { background-color: transparent; }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar Navigation (unchanged) -->
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
                    
                    <a href="{{ route('admin.raw_materials.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-shopping-cart w-5 text-center"></i>
                        <span>Procurement</span>
                    </a>
                    
                    <a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
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
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 p-6">
            <div class="max-w-6xl mx-auto space-y-6">
                <!-- Header Section -->
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                            <span class="bg-primary-100 text-primary-800 p-2 rounded-lg mr-3">
                                <i class="fas fa-boxes"></i>
                            </span>
                            Final Product Inventory
                        </h1>
                        <p class="text-gray-600 mt-1">Manage your product stock levels</p>
                    </div>
                </div>

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Inventory Chart -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">
                        <i class="fas fa-chart-bar mr-2 text-primary-600"></i>Inventory Overview
                    </h2>
                    <div class="h-64">
                        <canvas id="inventoryChart" 
                                data-products='@json($inventory->pluck("product"))' 
                                data-quantities='@json($inventory->pluck("quantity"))'></canvas>
                    </div>
                </div>

                <!-- Inventory Table -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">
                            <i class="fas fa-box-open mr-2 text-primary-600"></i>Product Inventory
                        </h2>
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" id="search" placeholder="Search products..." 
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity (kg)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($inventory as $item)
                                <tr class="hover:bg-gray-50" data-product="{{ strtolower(str_replace(' ', '-', $item->product)) }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-primary-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-box text-primary-600"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->product }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->quantity }} kg</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $item->updated_at->format('M d, Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($item->quantity < 50)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Low Stock
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                In Stock
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        No inventory data available
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get inventory data from canvas element
            const products = JSON.parse(document.getElementById('inventoryChart').dataset.products);
            const quantities = JSON.parse(document.getElementById('inventoryChart').dataset.quantities);
            
            // Initialize chart
            const ctx = document.getElementById('inventoryChart').getContext('2d');
            const inventoryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: products,
                    datasets: [{
                        label: 'Current Stock (kg)',
                        data: quantities,
                        backgroundColor: '#22c55e',
                        borderColor: '#166534',
                        borderWidth: 1,
                        hoverBackgroundColor: '#16a34a',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    onClick: (e, elements) => {
                        if (elements.length > 0) {
                            const index = elements[0].index;
                            const productSlug = products[index].toLowerCase().replace(/\s+/g, '-');
                            const row = document.querySelector(`tr[data-product="${productSlug}"]`);
                            
                            if (row) {
                                row.classList.add('highlight-row');
                                row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                setTimeout(() => row.classList.remove('highlight-row'), 2000);
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantity (kg)'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                afterLabel: function(context) {
                                    const index = context.dataIndex;
                                    const status = quantities[index] < 50 ? 'Low Stock' : 'In Stock';
                                    return `Status: ${status}`;
                                }
                            }
                        }
                    }
                }
            });

            // Search functionality
            document.getElementById('search').addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const productName = row.dataset.product;
                    if (productName.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>