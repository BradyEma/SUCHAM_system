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
<body class="bg-amber-50">
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
                        <a href="#" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
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
        <main class="container mx-auto px-4 py-8">

        <!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md border-l-4 border-green-700 p-6">
        <div class="text-green-800 text-3xl font-bold">{{ $pendingOrders }}</div>
        <div class="text-amber-700">Pending Orders</div>
        <div class="mt-2 text-sm text-green-600">+2 from yesterday</div>
    </div>
    <div class="bg-white rounded-lg shadow-md border-l-4 border-amber-500 p-6">
        <div class="text-green-800 text-3xl font-bold">{{ $processedToday }}</div>
        <div class="text-amber-700">Processed Today</div>
        <div class="mt-2 text-sm text-green-600">80% completion</div>
    </div>
    <div class="bg-white rounded-lg shadow-md border-l-4 border-green-600 p-6">
        <div class="text-green-800 text-3xl font-bold">${{ number_format($todaysRevenue, 2) }}</div>
        <div class="text-amber-700">Today's Revenue</div>
        <div class="mt-2 text-sm text-green-600">15% from target</div>
    </div>
    <div class="bg-white rounded-lg shadow-md border-l-4 border-amber-600 p-6">
        <div class="text-green-800 text-3xl font-bold">{{ $lowStockItems }}</div>
        <div class="text-amber-700">Low Stock Items</div>
        <div class="mt-2 text-sm text-green-600">Need replenishment</div>
    </div>
</div>


            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-4 mb-8">
                <a href="{{ route('retailer_orders.create') }}" class="green-gradient hover:bg-green-800 text-amber-100 font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Place New Order
                </a>
               
                <button class="bg-white hover:bg-gray-100 text-green-800 border border-green-700 font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    Filter Orders
                </button>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <div class="gold-gradient px-6 py-4">
                    <h2 class="text-xl font-bold text-green-800">Recent Orders</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-amber-100">
                        <thead class="bg-green-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Order ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Amount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-amber-100">
                            <!-- Order 1 -->
                            <tr class="hover:bg-amber-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-800">GF-10024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">Jul 21, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">Fresh Market Co.</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">$245.50</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">Processing</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3">View</a>
                                    <a href="#" class="text-amber-600 hover:text-amber-900">Edit</a>
                                </td>
                            </tr>
                            <!-- Order 2 -->
                            <tr class="hover:bg-amber-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-800">GF-10023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">Jul 20, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">Organic Grocers</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">$189.75</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3">View</a>
                                    <a href="#" class="text-amber-600 hover:text-amber-900">Invoice</a>
                                </td>
                            </tr>
                            <!-- Order 3 -->
                            <tr class="hover:bg-amber-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-800">GF-10022</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">Jul 20, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">Golden Harvest</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-800">$320.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3">View</a>
                                    <a href="#" class="text-amber-600 hover:text-amber-900">Reorder</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-amber-50 px-6 py-4 flex items-center justify-between border-t border-amber-200">
                    <div class="text-sm text-amber-800">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">24</span> orders
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 rounded-md bg-amber-100 text-amber-800 hover:bg-amber-200">
                            Previous
                        </button>
                        <button class="px-3 py-1 rounded-md gold-gradient text-green-800 font-medium">
                            1
                        </button>
                        <button class="px-3 py-1 rounded-md bg-amber-100 text-amber-800 hover:bg-amber-200">
                            2
                        </button>
                        <button class="px-3 py-1 rounded-md bg-amber-100 text-amber-800 hover:bg-amber-200">
                            Next
                        </button>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Orders Chart -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-green-800">Weekly Orders</h3>
                        <select class="bg-amber-50 border border-amber-200 text-amber-800 rounded px-2 py-1 text-sm">
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
                        <select class="bg-amber-50 border border-amber-200 text-amber-800 rounded px-2 py-1 text-sm">
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

    <script>
        // Orders Chart
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Orders',
                    data: [12, 19, 15, 24, 18, 10, 8],
                    backgroundColor: 'rgba(255, 215, 0, 0.7)',
                    borderColor: 'rgba(0, 100, 0, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 100, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Revenue ($)',
                    data: [12500, 14200, 13800, 15600, 18200, 17500, 19200],
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
                        grid: {
                            color: 'rgba(0, 100, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>