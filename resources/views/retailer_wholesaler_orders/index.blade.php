<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldenFields - Order Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
</head>
<body class="bg-white">
    <div class="min-h-screen">
        <!-- Header -->
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
                            <p class="text-xs text-primary-200">Verified Account</p>
                        </div>
                    </div>
                    
                    <!-- Main Navigation -->
                    <div class="flex-1 overflow-y-auto py-4">
                        <nav class="px-2 space-y-1">
                            <!-- Dashboard -->
                            <a href="#" class="bg-primary-700 text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                                <i class="fas fa-tachometer-alt mr-3 text-yellow-400"></i>
                                Dashboard
                            </a>
                            
                            <!-- Inventory -->
                            <a href="{{ route('retailer.inventory.index') }}" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                                <i class="fas fa-boxes mr-3"></i>
                                Inventory
                                <span class="bg-yellow-400 text-black text-xs font-bold px-2 py-0.5 rounded-full ml-auto">5</span>
                            </a>
                            
                            <!-- Orders -->
                            <a href="retailer_wholesaler_orders.index" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                                <i class="fas fa-shopping-cart mr-3"></i>
                                My Orders
                                <span class="bg-yellow-400 text-black text-xs font-bold px-2 py-0.5 rounded-full ml-auto">3</span>
                            </a>
                            
                            <a href="{{ route('chat.livewire') }}" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                                <i class="fas fa-comment-dots mr-3"></i>
                                <span>Messages</span>
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-auto">2 unread</span>
                            </a>
                            
                            <!-- Support -->
                            <a href="#" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                                <i class="fas fa-headset mr-3"></i>
                                Support Center
                            </a>
                            
                            <a href="{{ route('retailer.profile') }}" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
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

            <!-- Main Content Area -->
            <div class="h-screen flex flex-col flex-1">
                <!-- Main Header - Changed to Tailwind green -->
                <header class="bg-green-600 shadow p-4"> <!-- Changed from bg-white to bg-green-600 -->
                    <h1 class="text-xl font-semibold text-white">Retailer Orders</h1> <!-- Changed text to white for contrast -->
                </header>

                <!-- Scrollable main content -->
                <main class="flex-1 overflow-y-auto p-6 bg-white">
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-lg shadow-md border-l-4 border-green-700 p-6">
                            <div class="text-green-800 text-3xl font-bold">{{ $pendingOrders }}</div>
                            <div class="text-amber-700">Pending Orders</div>
                            
                        </div>
                        <div class="bg-white rounded-lg shadow-md border-l-4 border-amber-500 p-6">
                            <div class="text-green-800 text-3xl font-bold">{{ $processedToday }}</div>
                            <div class="text-amber-700">Processed Today</div>
                           
                        </div>
                        <div class="bg-white rounded-lg shadow-md border-l-4 border-green-600 p-6">
                            <div class="text-green-800 text-3xl font-bold">UG shs{{ number_format($todaysRevenue, 2) }}</div>
                            <div class="text-amber-700">Today's Revenue</div>
                            
                        </div>
                        <div class="bg-white rounded-lg shadow-md border-l-4 border-amber-600 p-6">
                            <div class="text-green-800 text-3xl font-bold">{{ $lowStockItems }}</div>
                            <div class="text-amber-700">Low Stock Items</div>
                           
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4 mb-8">
                        <a href="{{ route('retailer_wholesaler_orders.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Place New Order
                        </a>
                       
<form method="GET" action="{{ route('retailer_wholesaler_orders.index') }}" class="flex space-x-2 items-center">
    <select name="status" class="border border-green-700 rounded px-2 py-1 text-green-800">
        <option value="">All</option>
        <option value="Processing" {{ request('status') == 'Processing' ? 'selected' : '' }}>Processing</option>
        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
        <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>

    <button type="submit" class="bg-white hover:bg-gray-100 text-green-800 border border-green-700 font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
        Filter Orders
    </button>
</form>

                    </div>

                    <!-- Orders Table -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                        <div class="bg-green-600 px-6 py-4"> <!-- Changed from gold-gradient to bg-green-600 -->
                            <h2 class="text-xl font-bold text-white">Recent Orders</h2> <!-- Changed text to white -->
                        </div>
                        <div class="max-h-96 overflow-y-auto overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-green-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Order ID</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Wholesaler</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Amount(UG shs)</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-800">{{ $order->order_code }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">{{ $order->order_date->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">{{ $order->wholesaler_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">${{ number_format($order->order_amount, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($order->order_status === 'Processing') bg-amber-100 text-amber-800
                                                @elseif($order->order_status === 'Completed') bg-green-100 text-green-800
                                                @elseif($order->order_status === 'Cancelled') bg-red-100 text-red-800
                                                @endif
                                            ">
                                            {{ $order->order_status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('retailer_wholesaler_orders.show', $order->id) }}" class="text-green-600 hover:text-green-900 mr-3">View</a>
                                            <a href="{{ route('retailer_wholesaler_orders.edit', $order->id) }}" class="text-amber-600 hover:text-amber-900">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-200">
                            <div class="text-sm text-gray-600">
                                Showing
                                <span class="font-medium">{{ $orders->firstItem() }}</span>
                                to
                                <span class="font-medium">{{ $orders->lastItem() }}</span>
                                of
                                <span class="font-medium">{{ $orders->total() }}</span> orders
                            </div>

                            <div class="flex space-x-2">
                                @if ($orders->onFirstPage())
                                    <span class="px-3 py-1 rounded-md bg-gray-100 text-gray-800 cursor-not-allowed">Previous</span>
                                @else
                                    <a href="{{ $orders->previousPageUrl() }}" class="px-3 py-1 rounded-md bg-gray-100 text-gray-800 hover:bg-gray-200">Previous</a>
                                @endif

                                @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                    @if ($page == $orders->currentPage())
                                        <span class="px-3 py-1 rounded-md bg-green-600 text-white font-medium">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="px-3 py-1 rounded-md bg-gray-100 text-gray-800 hover:bg-gray-200">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if ($orders->hasMorePages())
                                    <a href="{{ $orders->nextPageUrl() }}" class="px-3 py-1 rounded-md bg-gray-100 text-gray-800 hover:bg-gray-200">Next</a>
                                @else
                                    <span class="px-3 py-1 rounded-md bg-gray-100 text-gray-800 cursor-not-allowed">Next</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                        <!-- Orders Chart -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-bold text-green-800">Weekly Orders</h3>
                                <select class="bg-gray-50 border border-gray-200 text-gray-800 rounded px-2 py-1 text-sm">
                                    <option>This Week</option>
                                    <option>Last Week</option>
                                    <option>This Month</option>
                                </select>
                            </div>
                            <canvas id="ordersChart" class="w-full h-64"></canvas>
                        </div>
                        
                        <!-- Revenue Chart -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-bold text-green-800">Revenue Trend</h3>
                                <select class="bg-gray-50 border border-gray-200 text-gray-800 rounded px-2 py-1 text-sm">
                                    <option>Last 7 Days</option>
                                    <option>Last 30 Days</option>
                                    <option>This Year</option>
                                </select>
                            </div>
                            <canvas id="revenueChart" class="w-full h-64"></canvas>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js">

            // Orders Chart
           <script>
document.addEventListener('DOMContentLoaded', function () {
    axios.get("{{ route('retailer_wholesaler_orders.chartsData') }}")
        .then(response => {
            const { orders, revenue } = response.data;

            // Orders Chart
            const ordersCtx = document.getElementById('ordersChart').getContext('2d');
            new Chart(ordersCtx, {
                type: 'bar',
                data: {
                    labels: orders.labels,
                    datasets: [{
                        label: 'Orders',
                        data: orders.data,
                        backgroundColor: 'rgba(255, 215, 0, 0.7)',
                        borderColor: 'rgba(0, 100, 0, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0, 100, 0, 0.1)' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: revenue.labels,
                    datasets: [{
                        label: 'Revenue (UGX)',
                        data: revenue.data,
                        fill: false,
                        backgroundColor: 'rgba(0, 100, 0, 1)',
                        borderColor: 'rgba(255, 215, 0, 1)',
                        borderWidth: 3,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: false,
                            grid: { color: 'rgba(0, 100, 0, 0.1)' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        })
        .catch(error => {
            console.error("Chart data fetch failed:", error);
        });
});
</script>

            
    </div>
</body>
</html>