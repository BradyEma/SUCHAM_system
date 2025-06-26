<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - GoldenFields Supplier Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        golden: {
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        },
                        greenfields: {
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    <style>
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
        canvas {
            display: block;
            width: 100% !important;
            height: 250px !important;
        }
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 text-black">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 sidebar text-white p-6 space-y-8">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md">
                    <img src="{{ asset('goldenfields.png') }}" alt="GoldenFields Logo" class="h-8 w-8 rounded-full">
                </div>
                <div>
                    <div class="text-xl font-bold">GoldenFields</div>
                    <div class="text-xs text-green-200">Industries Ltd.</div>
                </div>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('supplier.dashboard') }}" class="flex items-center space-x-3 px-3 py-3 rounded nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-3 py-3 rounded bg-white text-golden-700 font-semibold nav-item active">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>Orders</span>
                    <span class="bg-greenfields-500 text-white text-xs px-2 py-1 rounded-full ml-auto">3 new</span>
                </a>
                <a href="{{ route('supplier.products') }}" class="flex items-center space-x-3 px-3 py-3 rounded nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Products</span>
                </a>
               

                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-comment-dots w-5 text-center"></i>
                    <span>Chat</span>
                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-auto">2 unread</span>
                </a>
                <a href="{{ route('supplier.profile') }}" class="flex items-center space-x-3 px-3 py-3 rounded nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Profile</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-auto">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-green-800">Order Management</h1>
                    <p class="text-gray-600">Manage and track all your sugar raw material orders</p>
                </div>
                <div class="flex space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Search orders..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-golden-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Order Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stat-card bg-white p-6 rounded-xl shadow border border-gray-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-black">Total Orders</h2>
                            <p class="text-3xl font-bold text-yellow-400">24</p>
                        </div>
                        <div class="p-3 rounded-full bg-greenfields-100 text-greenfields-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-greenfields-600 mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        8% from last month
                    </p>
                </div>

                <div class="stat-card bg-white p-6 rounded-xl shadow border border-gray-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-black">Pending</h2>
                            <p class="text-3xl font-bold  text-yellow-400">5</p>
                        </div>
                        <div class="p-3 rounded-full bg-greenfields-100 text-greenfields-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-red-500 mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        2 awaiting confirmation
                    </p>
                </div>

                <div class="stat-card bg-white p-6 rounded-xl shadow border border-gray-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-black">Processing</h2>
                            <p class="text-3xl font-bold text-yellow-400">7</p>
                        </div>
                        <div class="p-3 rounded-full bg-greenfields-100 text-greenfields-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-greenfields-600 mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        3 ready for dispatch
                    </p>
                </div>

                <div class="stat-card bg-white p-6 rounded-xl shadow border border-gray-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-black">Completed</h2>
                            <p class="text-3xl font-bold text-yellow-400">12</p>
                        </div>
                        <div class="p-3 rounded-full bg-greenfields-100 text-greenfields-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-greenfields-600 mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        5 this week
                    </p>
                </div>
            </div>

            <!-- Order Distribution Chart -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow border border-gray-100 lg:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-golden-800">Order Distribution by Product</h2>
                        <select class="border rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-golden-500">
                            <option>Last 7 Days</option>
                            <option selected>Last 30 Days</option>
                            <option>Last 90 Days</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="productDistributionChart"></canvas>
                    </div>
                </div>

                <!-- Order Status Breakdown -->
                <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                    <h2 class="text-xl font-semibold text-golden-800 mb-4">Order Status</h2>
                    <div class="chart-container">
                        <canvas id="orderStatusChart"></canvas>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-2">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                            <span class="text-sm">Pending (20%)</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                            <span class="text-sm">Processing (30%)</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full bg-greenfields-500 mr-2"></div>
                            <span class="text-sm">Completed (50%)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-green-500">Recent Orders</h2>
                    <div class="flex space-x-2">
                        <select class="border rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-golden-500">
                            <option>All Products</option>
                            <option>Sugar Cane</option>
                            <option>Sugar Beets</option>
                            <option>Honey</option>
                            <option>Molasses</option>
                        </select>
                        <select class="border rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-golden-500">
                            <option>All Statuses</option>
                            <option>Pending</option>
                            <option>Processing</option>
                            <option>Shipped</option>
                            <option>Completed</option>
                        </select>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-yellow-400">#SC-7890</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1603569283847-aa295f0d016a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Sugar Cane">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Sugar Cane</div>
                                            <div class="text-sm text-gray-500">Premium Grade A</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 Tons</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Kampala Sugar Co.</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 10:45 AM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 2,450,000</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-golden-600 hover:text-golden-900 mr-3">View</button>
                                    <button class="text-greenfields-600 hover:text-greenfields-900">Confirm</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-yellow-400">#SB-4567</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1603569283847-aa295f0d016a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Sugar Beets">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Sugar Beets</div>
                                            <div class="text-sm text-gray-500">Organic</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3 Tons</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jinja Sweeteners</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yesterday, 2:15 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 1,780,000</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Processing</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-golden-600 hover:text-golden-900 mr-3">View</button>
                                    <button class="text-greenfields-600 hover:text-greenfields-900">Dispatch</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-yellow-400">#HN-1234</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1587049352851-8d4e89133924?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Honey">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Pure Honey</div>
                                            <div class="text-sm text-gray-500">Wildflower</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">200 Liters</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Natural Foods Ltd</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 12, 9:30 AM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 3,200,000</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-greenfields-100 text-greenfields-800">Completed</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-golden-600 hover:text-golden-900 mr-3">View</button>
                                    <button class="text-gray-600 hover:text-gray-900">Invoice</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-yellow-400">#ML-5678</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1603569283847-aa295f0d016a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Molasses">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Molasses</div>
                                            <div class="text-sm text-gray-500">Blackstrap</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1.5 Tons</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Bakers Delight</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 10, 11:20 AM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 950,000</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Shipped</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-golden-600 hover:text-golden-900 mr-3">View</button>
                                    <button class="text-greenfields-600 hover:text-greenfields-900">Track</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-yellow-400">#SC-3456</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1603569283847-aa295f0d016a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Sugar Cane">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Sugar Cane</div>
                                            <div class="text-sm text-gray-500">Industrial Grade</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10 Tons</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">National Distillers</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 8, 3:45 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 4,800,000</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-greenfields-100 text-greenfields-800">Completed</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-golden-600 hover:text-golden-900 mr-3">View</button>
                                    <button class="text-gray-600 hover:text-gray-900">Invoice</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">24</span> orders
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border rounded-lg text-sm bg-white text-gray-700 hover:bg-gray-50">Previous</button>
                        <button class="px-3 py-1 border rounded-lg text-sm bg-golden-600 text-white">1</button>
                        <button class="px-3 py-1 border rounded-lg text-sm bg-white text-gray-700 hover:bg-gray-50">2</button>
                        <button class="px-3 py-1 border rounded-lg text-sm bg-white text-gray-700 hover:bg-gray-50">3</button>
                        <button class="px-3 py-1 border rounded-lg text-sm bg-white text-gray-700 hover:bg-gray-50">Next</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Wait for DOM to load
        document.addEventListener('DOMContentLoaded', function() {
            // Product Distribution Chart
            const productCtx = document.getElementById('productDistributionChart').getContext('2d');
            const productChart = new Chart(productCtx, {
                type: 'bar',
                data: {
                    labels: ['Sugar Cane', 'Sugar Beets', 'Honey', 'Molasses', 'Other'],
                    datasets: [{
                        label: 'Orders by Product',
                        data: [12, 8, 5, 3, 2],
                        backgroundColor: [
                            'rgba(245, 158, 11, 0.7)',
                            'rgba(180, 83, 9, 0.7)',
                            'rgba(234, 179, 8, 0.7)',
                            'rgba(146, 64, 14, 0.7)',
                            'rgba(156, 163, 175, 0.7)'
                        ],
                        borderColor: [
                            'rgba(245, 158, 11, 1)',
                            'rgba(180, 83, 9, 1)',
                            'rgba(234, 179, 8, 1)',
                            'rgba(146, 64, 14, 1)',
                            'rgba(156, 163, 175, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.raw + ' orders';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 2
                            }
                        }
                    }
                }
            });

            // Order Status Chart
            const statusCtx = document.getElementById('orderStatusChart').getContext('2d');
            const statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Processing', 'Completed'],
                    datasets: [{
                        data: [5, 7, 12],
                        backgroundColor: [
                            'rgba(245, 158, 11, 0.7)',
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(34, 197, 94, 0.7)'
                        ],
                        borderColor: [
                            'rgba(245, 158, 11, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(34, 197, 94, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.raw + ' orders';
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
</body>
</html>