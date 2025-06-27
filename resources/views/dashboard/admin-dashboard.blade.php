<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldenFields Agro - Admin Dashboard</title>
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
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-primary-800 text-white">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 px-4 border-b border-primary-700">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-leaf text-accent-400 text-xl"></i>
                        <span class="text-xl font-bold">GoldenFields</span>
                        <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full ml-2">ADMIN</span>
                    </div>
                </div>
                
                <!-- User Profile -->
                <div class="p-4 border-b border-primary-700 flex items-center space-x-3">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin" class="h-10 w-10 rounded-full border-2 border-yellow-400">
                    <div>
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-primary-200">Super Admin</p>
                    </div>
                </div>
                
                <!-- Main Navigation -->
                <div class="flex-1 overflow-y-auto py-4">
    <nav class="flex-1 p-4 space-y-2">
        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span>Dashboard</span>
           
        </a>
        
        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
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
            <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full ml-auto">2 unread</span>
        </a>
        
        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
            <i class="fas fa-truck w-5 text-center"></i>
            <span>Logistics</span>
        </a>
        
        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
            <i class="fas fa-cog w-5 text-center"></i>
            <span>Settings</span>
        </a>
    </nav>
</div>
                    
                  
                
               
            </div>
        </div>

        <!-- Mobile sidebar -->
        <div class="md:hidden fixed inset-0 z-40 hidden" id="mobile-sidebar">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
            <div class="relative flex flex-col w-72 max-w-xs bg-primary-800 text-white">
                <div class="flex items-center justify-between h-16 px-4 border-b border-primary-700">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-leaf text-accent-400 text-xl"></i>
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
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button type="button" class="md:hidden text-gray-500 focus:outline-none" id="open-mobile-sidebar">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="ml-4 text-xl font-semibold text-gray-800">Dashboard Overview</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none relative">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                            </button>
                        </div>
                        <div class="relative">
                            <button class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none relative">
                                <i class="fas fa-envelope"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-accent-500"></span>
                            </button>
                        </div>
                        <div class="relative">
                            <button class="flex items-center space-x-2 focus:outline-none" id="user-menu-button">
                                <span class="text-sm font-medium text-gray-700 hidden md:inline">Admin User</span>
                                <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User avatar">
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Welcome Banner -->
                <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-lg shadow-md p-6 text-white mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-white-800">Welcome, {{ Auth::user()->name }}!</h2>
                            <p class="opacity-90">Here's what's happening with your agro business today.</p>
                        </div>
                        <button class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-primary-800 bg-white hover:bg-gray-100">
                            <i class="fas fa-download mr-2"></i> Generate Report
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Orders -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-400">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 truncate">Total Orders</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">1,287</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-shopping-cart text-primary-600"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-green-600 text-sm font-semibold">
                                <i class="fas fa-arrow-up mr-1"></i> 12.5%
                            </span>
                            <span class="text-gray-500 text-sm ml-2">vs last month</span>
                        </div>
                    </div>
                    
                    <!-- Active Suppliers -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-400">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 truncate">Active Suppliers</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">248</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-users text-primary-600"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-green-600 text-sm font-semibold">
                                <i class="fas fa-arrow-up mr-1"></i> 8.2%
                            </span>
                            <span class="text-gray-500 text-sm ml-2">vs last month</span>
                        </div>
                    </div>
                    
                    <!-- Pending Procurement -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-400">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 truncate">Pending Procurement</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">42</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-boxes text-primary-600"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-red-600 text-sm font-semibold">
                                <i class="fas fa-arrow-down mr-1"></i> 3.1%
                            </span>
                            <span class="text-gray-500 text-sm ml-2">vs last month</span>
                        </div>
                    </div>
                    
                    <!-- Revenue -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-400">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 truncate">Revenue (30d)</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">$287,459</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-dollar-sign text-primary-600"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-green-600 text-sm font-semibold">
                                <i class="fas fa-arrow-up mr-1"></i> 24.7%
                            </span>
                            <span class="text-gray-500 text-sm ml-2">vs last month</span>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Orders Chart -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Order Trends</h3>
                            <select class="bg-gray-50 border border-gray-300 text-gray-700 py-1 px-3 rounded-md text-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                <option>Last 7 days</option>
                                <option selected>Last 30 days</option>
                                <option>Last 90 days</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Revenue Chart -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Revenue Breakdown</h3>
                            <select class="bg-gray-50 border border-gray-300 text-gray-700 py-1 px-3 rounded-md text-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                <option>By Product</option>
                                <option selected>By Region</option>
                                <option>By Supplier</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Recent Orders -->
                    <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Recent Orders</h3>
                            <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-500">View all</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-1001</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">AgroHarvest Inc.</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$12,450</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-primary-600 hover:text-primary-900">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-1002</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">GoldenCane Ltd.</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$8,720</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-primary-600 hover:text-primary-900">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-1003</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">SugarFields Co.</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$15,300</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Shipped</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-primary-600 hover:text-primary-900">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-1004</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">FarmFresh Sugar</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$9,560</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Pending</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-primary-600 hover:text-primary-900">View</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-4">
                            <a href="#" class="group flex items-center p-3 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition">
                                <div class="bg-primary-100 p-2 rounded-full text-primary-600 group-hover:bg-primary-200 transition">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Create New Order</p>
                                    <p class="text-xs text-gray-500">Initiate a new procurement</p>
                                </div>
                            </a>
                            <a href="#" class="group flex items-center p-3 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition">
                                <div class="bg-primary-100 p-2 rounded-full text-primary-600 group-hover:bg-primary-200 transition">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Add New Supplier</p>
                                    <p class="text-xs text-gray-500">Onboard a supplier</p>
                                </div>
                            </a>
                            <a href="#" class="group flex items-center p-3 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition">
                                <div class="bg-primary-100 p-2 rounded-full text-primary-600 group-hover:bg-primary-200 transition">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Generate Report</p>
                                    <p class="text-xs text-gray-500">Create custom reports</p>
                                </div>
                            </a>
                            <a href="#" class="group flex items-center p-3 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition">
                                <div class="bg-primary-100 p-2 rounded-full text-primary-600 group-hover:bg-primary-200 transition">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Send Announcement</p>
                                    <p class="text-xs text-gray-500">Notify suppliers</p>
                                </div>
                            </a>
                        </div>
                        
                        <!-- System Status -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">System Status</h4>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Database</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Operational
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">API Services</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Operational
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Storage</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        78% Used
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        document.getElementById('open-mobile-sidebar').addEventListener('click', function() {
            document.getElementById('mobile-sidebar').classList.remove('hidden');
        });

        document.getElementById('close-mobile-sidebar').addEventListener('click', function() {
            document.getElementById('mobile-sidebar').classList.add('hidden');
        });

        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Orders Chart
            const ordersCtx = document.getElementById('ordersChart').getContext('2d');
            const ordersChart = new Chart(ordersCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Orders',
                        data: [65, 59, 80, 81, 56, 55, 90],
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(revenueCtx, {
                type: 'bar',
                data: {
                    labels: ['North', 'South', 'East', 'West', 'Central'],
                    datasets: [{
                        label: 'Revenue',
                        data: [125000, 98000, 75000, 110000, 85000],
                        backgroundColor: [
                            'rgba(249, 115, 22, 0.7)',
                            'rgba(34, 197, 94, 0.7)',
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(234, 88, 12, 0.7)',
                            'rgba(139, 92, 246, 0.7)'
                        ],
                        borderColor: [
                            'rgba(249, 115, 22, 1)',
                            'rgba(34, 197, 94, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(234, 88, 12, 1)',
                            'rgba(139, 92, 246, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>