<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldenFields - Wholesaler Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            background: #166534;
        }
        .card-gradient {
            background: linear-gradient(135deg, #f5f5f4 0%, #e7e5e4 100%);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #b45309 0%, #92400e 100%);
        }
        .status-badge {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
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
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
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
                    <a href="#"  class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-boxes mr-3"></i>
                        Inventory
                    </a>
                    <a href="{{ route('wholesaler.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
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
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-3">
                    <div class="flex items-center md:hidden">
                        <button class="text-gray-500 focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                    <div class="flex-1 max-w-md mx-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" placeholder="Search..." type="search">
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button class="p-1 text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                        </button>
                        <div class="ml-3 relative">
                            <div class="flex items-center">
                                <button class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                    <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User profile">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Welcome Banner -->
                <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-xl shadow-lg p-6 mb-6 text-white">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                       <div>
                           <h1 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}!</h1>
                           <p class="mt-1 opacity-90">Here's what's happening with your business today</p>
                       </div>

                        <button class="btn-primary text-black px-6 py-2 bg-yellow-500 rounded-lg font-medium mt-4 md:mt-0 shadow-md hover:shadow-lg transition-all">
                            <i class="fas fa-plus mr-2"></i> New Order
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-100 p-3 rounded-full">
                                    <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Today's Orders</dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">12</div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-xs font-medium text-green-600">+2.5% from yesterday</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-full">
                                    <i class="fas fa-dollar-sign text-yellow-600 text-xl"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Today's Revenue</dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">$3,450</div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-xs font-medium text-green-600">+15% from yesterday</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                                    <i class="fas fa-box-open text-blue-600 text-xl"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Inventory Items</dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">1,245</div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-xs font-medium text-red-600">5 items low stock</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-100 p-3 rounded-full">
                                    <i class="fas fa-truck text-purple-600 text-xl"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Pending Deliveries</dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">8</div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-xs font-medium text-yellow-600">2 delayed shipments</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <!-- Demand Forecast Chart for Wholesaler -->
                
                <div class="bg-white rounded-xl shadow-lg p-6 mt-8">

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">📈 Demand Forecast (Last 2 Years)</h2>
                        <div class="flex gap-4">
                            <select id="wh-productFilter" class="border border-gray-300 rounded px-3 py-1 text-sm">
                                <option value="all">All Products</option>
                            </select>
                            <select id="wh-granularityFilter" class="border border-gray-300 rounded px-3 py-1 text-sm">
                                <option value="month" selected>Monthly</option>
                                <option value="year">Yearly</option>
                            </select>
                        </div>
                    </div>
                    <div class="h-96">
                        <canvas id="wh-forecastChart"></canvas>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                let whChart;

                async function loadWhForecast(product = 'all', granularity = 'month') {
                    const res = await fetch(`/admin/demand-predictions?group=${granularity}`);
                    const data = await res.json();

                    // Filter to only last 24 months
                    const twoYearsAgo = new Date();
                    twoYearsAgo.setMonth(twoYearsAgo.getMonth() - 24);
                    const filtered = data.filter(row => {
                        const date = new Date(row.period + "-01");
                        return date >= twoYearsAgo && (product === 'all' || row.product === product);
                    });

                    const labels = [...new Set(filtered.map(row => row.period))].sort();

                    const historical = labels.map(label => {
                        const row = filtered.find(r => r.period === label && r.type === 'historical');
                        return row ? +row.quantity : null;
                    });

                    const forecast = labels.map(label => {
                        const row = filtered.find(r => r.period === label && r.type === 'forecast');
                        return row ? +row.quantity : null;
                    });

                    const ctx = document.getElementById('wh-forecastChart').getContext('2d');
                    if (whChart) whChart.destroy();

                    whChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [
                                {
                                    label: 'Historical Demand',
                                    data: historical,
                                    borderColor: '#3B82F6',
                                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                    fill: true,
                                    tension: 0.3
                                },
                                {
                                    label: 'Forecasted Demand',
                                    data: forecast,
                                    borderColor: '#F59E0B',
                                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                    fill: true,
                                    tension: 0.3,
                                    borderDash: [6, 4]
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'bottom' }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Quantity (Units)'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: granularity.charAt(0).toUpperCase() + granularity.slice(1)
                                    }
                                }
                            }
                        }
                    });
                }

                async function loadWhProductOptions() {
                    const res = await fetch('/admin/demand-predictions');
                    const data = await res.json();
                    const products = [...new Set(data.map(r => r.product))];

                    const select = document.getElementById('wh-productFilter');
                    select.innerHTML = '<option value="all">All Products</option>';
                    products.forEach(p => {
                        const option = document.createElement('option');
                        option.value = p;
                        option.textContent = p;
                        select.appendChild(option);
                    });
                }

                document.addEventListener('DOMContentLoaded', () => {
                    loadWhProductOptions().then(() => loadWhForecast());

                    document.getElementById('wh-productFilter').addEventListener('change', () => {
                        loadWhForecast(
                            document.getElementById('wh-productFilter').value,
                            document.getElementById('wh-granularityFilter').value
                        );
                    });

                    document.getElementById('wh-granularityFilter').addEventListener('change', () => {
                        loadWhForecast(
                            document.getElementById('wh-productFilter').value,
                            document.getElementById('wh-granularityFilter').value
                        );
                    });
                });
                </script>


                <!-- Recent Orders -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Orders</h2>
                        <a href="#" class="text-sm font-medium text-green-600 hover:text-green-800">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-5879</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">FreshMart Supermarket</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 items</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$1,245.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-green-600 hover:text-green-900">View</a>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-5878</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">City Grocers</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3 items</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$845.50</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Shipped</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-green-600 hover:text-green-900">Track</a>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-5877</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Village Market</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">7 items</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$2,120.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-green-600 hover:text-green-900">Prepare</a>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-5876</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Organic Foods Ltd</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2 items</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$450.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-green-600 hover:text-green-900">Confirm</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
                        <a href="#" class="text-sm font-medium text-green-600 hover:text-green-800">View All</a>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Order #GF-5879 completed</p>
                                    <p class="text-sm text-gray-500">Today, 10:45 AM</p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-truck text-blue-600"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Order #GF-5878 shipped</p>
                                    <p class="text-sm text-gray-500">Today, 9:30 AM</p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <i class="fas fa-money-bill-wave text-purple-600"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Payment received from FreshMart</p>
                                    <p class="text-sm text-gray-500">Yesterday, 2:15 PM</p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                        <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Low stock alert: Premium Maize Flour</p>
                                    <p class="text-sm text-gray-500">Yesterday, 11:20 AM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Sales (USD)',
                    data: [2150, 1890, 2450, 2810, 2270, 1950, 3100],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(214, 158, 46, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(214, 158, 46, 0.7)'
                    ],
                    borderColor: [
                        'rgba(16, 185, 129, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(214, 158, 46, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(214, 158, 46, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '$' + context.raw.toLocaleString();
                            }
                        }
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
    </script>
</body>
</html>