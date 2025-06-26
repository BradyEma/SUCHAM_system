<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supplier Dashboard | GoldenFields Industries Ltd.</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .bg-pattern {
            background-image: radial-gradient(circle at 25% 25%, rgba(34, 197, 94, 0.1) 0%, transparent 50%), 
                            radial-gradient(circle at 75% 75%, rgba(234, 179, 8, 0.1) 0%, transparent 50%);
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
        .stat-card {
            transition: all 0.3s ease;
            border-left: 4px solid;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
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
            <nav class="space-y-1">
                <a href="{{ route('supplier.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('supplier.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-clipboard-list w-5 text-center"></i>
                    <span>Orders</span>
                    <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full ml-auto">3 new</span>
                </a>
                <a href="{{ route('supplier.products') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-boxes w-5 text-center"></i>
                    <span>Products</span>
                </a>
               
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-comment-dots w-5 text-center"></i>
                    <span>Chat</span>
                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-auto">2 unread</span>
                </a>
                <a href="{{ route('supplier.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-user w-5 text-center"></i>
                    <span>Profile</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-auto">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-green-800">Welcome, {{ Auth::user()->name }}!</h1>
                    <p class="text-gray-600">Here's your GoldenFields supplier dashboard overview</p>
                </div>
                <div class="relative">
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-green-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Active Orders</h2>
                            <p class="text-3xl font-bold text-green-700">5</p>
                        </div>
                        <div class="p-3 rounded-full text-yellow-700 bg-yellow-200">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                    <p class="text-sm text-green-600 mt-2 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        12% from last month
                    </p>
                </div>

                <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-green-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Total Sales</h2>
                            <p class="text-3xl font-bold text-green-700">UGX 3,500,000</p>
                        </div>
                        <div class="p-3 rounded-full text-yellow-700 bg-yellow-200">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                    <p class="text-sm text-green-600 mt-2 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        24% from last month
                    </p>
                </div>

                <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-green-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Messages</h2>
                            <p class="text-3xl font-bold text-green-700">2</p>
                        </div>
                        <div class="p-3 rounded-full  text-yellow-700 bg-yellow-200">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <p class="text-sm text-red-600 mt-2 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        1 new since yesterday
                    </p>
                </div>

                <div class="stat-card bg-white shadow-lg rounded-xl p-6 border-l-green-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold mb-2 text-gray-500">Inventory</h2>
                            <p class="text-3xl font-bold text-green-700">87 items</p>
                        </div>
                        <div class="p-3 rounded-full text-yellow-700 bg-yellow-200">
                            <i class="fas fa-boxes "></i>
                        </div>
                    </div>
                    <p class="text-sm text-red-600 mt-2 flex items-center">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        5 items low stock
                    </p>
                </div>
            </div>

            <!-- Charts and Additional Info -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Sales Chart -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 lg:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-green-800">Sales Overview</h2>
                        <select class="border rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <option>Last 7 Days</option>
                            <option selected>Last 30 Days</option>
                            <option>Last 90 Days</option>
                        </select>
                    </div>
                    <canvas id="salesChart" height="250"></canvas>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <h2 class="text-xl font-semibold text-green-800 mb-4">Recent Activity</h2>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="p-2 bg-green-100 rounded-full mr-3 text-green-700">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <p class="font-medium">Order #4567 completed</p>
                                <p class="text-sm text-gray-500">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="p-2 bg-blue-100 rounded-full mr-3 text-blue-700">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="font-medium">New order received</p>
                                <p class="text-sm text-gray-500">5 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="p-2 bg-yellow-100 rounded-full mr-3 text-yellow-700">
                                <i class="fas fa-star"></i>
                            </div>
                            <div>
                                <p class="font-medium">Your product received a 5-star review</p>
                                <p class="text-sm text-gray-500">Yesterday</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="p-2 bg-red-100 rounded-full mr-3 text-red-700">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <p class="font-medium">Inventory alert: 3 products low in stock</p>
                                <p class="text-sm text-gray-500">2 days ago</p>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="block text-center mt-4 text-green-600 hover:text-green-800 font-medium">View All Activity</a>
                </div>
            </div>

            <!-- Recent Orders and Top Products -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Orders -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-green-800">Recent Orders</h2>
                        <a href="#" class="text-sm text-green-600 hover:text-green-800 font-medium">View All</a>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">#4567</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 10:45 AM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 450,000</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">#4566</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 9:30 AM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 320,000</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">#4565</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yesterday, 2:15 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Shipped</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">UGX 780,000</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">#4564</td>
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
                        <h2 class="text-xl font-semibold text-green-800">Top Selling Products</h2>
                        <a href="#" class="text-sm text-green-600 hover:text-green-800 font-medium">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-gray-200 overflow-hidden mr-4">
                                <img src="{{ asset('sugarcane.jpg') }}" alt="Product" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium">Sugar cane</h3>
                                <p class="text-sm text-gray-500">12 trucks</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">UGX 725,000</p>
                                <p class="text-sm text-green-600">4 sold</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-gray-200 overflow-hidden mr-4">
                                <img src="{{ asset('sugar-beets.jpg') }}" alt="Product" class="w-full h-full object-cover">
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
                                <img src="{{ asset('honey.jpg') }}" alt="Product" class="w-full h-full object-cover">
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
                                <img src="{{ asset('coffee-beans.jpg') }}" alt="Product" class="w-full h-full object-cover">
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
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-gray-200 overflow-hidden mr-4">
                                <img src="{{ asset('molasses.jpg') }}" alt="Product" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium">Molasses</h3>
                                <p class="text-sm text-gray-500">1kg package</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">UGX 25,000</p>
                                <p class="text-sm text-green-600">11 sold</p>
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
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    borderColor: 'rgba(34, 197, 94, 1)',
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