<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supplier Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 text-black">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-sky-700 text-white p-6 space-y-6">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <div class="text-2xl font-bold">SUCHAM</div>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('supplier.dashboard') }}" class="flex items-center space-x-3 px-3 py-3 rounded bg-white text-sky-700 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('supplier.orders') }}" class="flex items-center space-x-3 px-3 py-3 rounded hover:bg-sky-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>Orders</span>
                    <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full ml-auto">3 new</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-3 py-3 rounded hover:bg-sky-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Products</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-3 py-3 rounded hover:bg-sky-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Settings</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-3 py-3 rounded hover:bg-sky-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span>Chat</span>
                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-auto">2 unread</span>
                </a>
                <a href="{{ route('supplier.profile') }}"  class="flex items-center space-x-3 px-3 py-3 rounded hover:bg-sky-600">
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
                    <h1 class="text-3xl font-bold text-sky-700">Welcome, {{ Auth::guard('supplier')->user()->name }}!</h1>
                    <p class="text-gray-600">Here's what's happening with your business today</p>
                </div>
                <div class="relative">
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Active Orders</h2>
                            <p class="text-3xl font-bold text-sky-700">5</p>
                        </div>
                        <div class="p-3 rounded-full bg-sky-100 text-sky-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-green-600 mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        12% from last month
                    </p>
                </div>

                <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Total Sales</h2>
                            <p class="text-3xl font-bold text-sky-700">UGX 3,500,000</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-green-600 mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        24% from last month
                    </p>
                </div>

                <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Messages</h2>
                            <p class="text-3xl font-bold text-sky-700">2</p>
                        </div>
                        <div class="p-3 rounded-full bg-purple-100 text-purple-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-red-600 mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        1 new since yesterday
                    </p>
                </div>

                <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Inventory</h2>
                            <p class="text-3xl font-bold text-sky-700">87 items</p>
                        </div>
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-red-600 mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        5 items low stock
                    </p>
                </div>
            </div>

            <!-- Charts and Additional Info -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Sales Chart -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 lg:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-sky-700">Sales Overview</h2>
                        <select class="border rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                            <option>Last 7 Days</option>
                            <option selected>Last 30 Days</option>
                            <option>Last 90 Days</option>
                        </select>
                    </div>
                    <canvas id="salesChart" height="250"></canvas>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <h2 class="text-xl font-semibold text-sky-700 mb-4">Recent Activity</h2>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="p-2 bg-green-100 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Order #4567 completed</p>
                                <p class="text-sm text-gray-500">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="p-2 bg-blue-100 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">New order received</p>
                                <p class="text-sm text-gray-500">5 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="p-2 bg-purple-100 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Your product received a 5-star review</p>
                                <p class="text-sm text-gray-500">Yesterday</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="p-2 bg-yellow-100 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Inventory alert: 3 products low in stock</p>
                                <p class="text-sm text-gray-500">2 days ago</p>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="block text-center mt-4 text-sky-600 hover:text-sky-800 font-medium">View All Activity</a>
                </div>
            </div>

            <!-- Recent Orders and Top Products -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Orders -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-sky-700">Recent Orders</h2>
                        <a href="#" class="text-sm text-sky-600 hover:text-sky-800 font-medium">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-sky-600">#4567</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 10:45 AM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 450,000</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-sky-600">#4566</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 9:30 AM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 320,000</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-sky-600">#4565</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yesterday, 2:15 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Shipped</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 780,000</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-sky-600">#4564</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yesterday, 11:20 AM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 150,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Top Products -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-sky-700">Top Selling Products</h2>
                        <a href="#" class="text-sm text-sky-600 hover:text-sky-800 font-medium">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-gray-200 overflow-hidden mr-4">
                                <img src="https://via.placeholder.com/50" alt="Product" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium">Sugar cane</h3>
                                <p class="text-sm text-gray-500">12trucks</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">UGX 725,000</p>
                                <p class="text-sm text-green-600">4 sold</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-gray-200 overflow-hidden mr-4">
                                <img src="https://via.placeholder.com/50" alt="Product" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium">Sugar Beets</h3>
                                <p class="text-sm text-gray-500">Box of 12</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">UGX 85,000</p>
                                <p class="text-sm text-green-600">18 sold</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-gray-200 overflow-hidden mr-4">
                                <img src="https://via.placeholder.com/50" alt="Product" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium">Pure Honey</h3>
                                <p class="text-sm text-gray-500">500ml jar</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">UGX 65,000</p>
                                <p class="text-sm text-green-600">15 sold</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-gray-200 overflow-hidden mr-4">
                                <img src="https://via.placeholder.com/50" alt="Product" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium">Coffee Beans</h3>
                                <p class="text-sm text-gray-500">1kg package</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">UGX 45,000</p>
                                <p class="text-sm text-green-600">12 sold</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly Sales (UGX)',
                    data: [1500000, 1800000, 2100000, 2400000, 2800000, 3200000, 3500000, 3300000, 3000000, 2700000, 2500000, 2900000],
                    backgroundColor: 'rgba(56, 182, 255, 0.1)',
                    borderColor: 'rgba(56, 182, 255, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'UGX ' + context.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'UGX ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>