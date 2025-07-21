<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retailer Orders | GoldenFields</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
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
        .sidebar-collapse {
            transition: all 0.3s ease;
        }
        .sidebar-collapse.collapsed {
            width: 5rem;
        }
        .sidebar-collapse.collapsed .nav-text {
            display: none;
        }
        .sidebar-collapse.collapsed .badge {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="sidebar-collapse bg-primary-800 text-white w-64 flex-shrink-0 flex flex-col transition-all duration-300">
            <!-- Brand Logo -->
            <div class="flex items-center justify-between p-4 border-b border-primary-700">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-leaf text-yellow-400 text-xl"></i>
                    <span class="font-bold text-lg nav-text">GoldenFields</span>
                </div>
                <button id="toggleSidebar" class="text-gray-300 hover:text-white">
                    <i class="fas fa-bars"></i>
                </button>
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
            
            <!-- Navigation -->
            <div class="flex-1 overflow-y-auto py-4">
                <nav class="px-2 space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('retailer.dashboard') }}" class="text-primary-200 group flex items-center hover:bg-primary-700 px-4 py-3 text-sm font-medium rounded-md">
                        <i class="fas fa-tachometer-alt mr-3 "></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    
                    <!-- Inventory -->
                    <a href="{{ route('retailer.inventory.index') }}" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                        <i class="fas fa-boxes mr-3"></i>
                        <span class="nav-text">Inventory</span>
                            <span class="bg-yellow-400 text-black text-xs font-bold px-2 py-0.5 rounded-full ml-auto">{{ number_format($lowStockCount) }}</span>
                    </a>
                    
                    <!-- Orders -->
                    <a href="{{ route('retailer.orders') }}" class="bg-white text-black group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                        <i class="fas fa-shopping-cart mr-3 text-black"></i>
                        <span class="nav-text">My Orders</span>
                        <span class="bg-black text-white text-xs font-bold px-2 py-0.5 rounded-full ml-auto badge">{{ $pendingOrders }}</span>
                    </a>
                    
                    <!-- Messages -->
                    <a href="{{ route('chat.livewire') }}" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                        <i class="fas fa-comment-dots mr-3"></i>
                        <span class="nav-text">Messages</span>
                    </a>
                    
                    <!-- Support -->
                    <a href="{{ route('support.index') }}" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                        <i class="fas fa-headset mr-3"></i>
                        <span class="nav-text">Support Center</span>
                    </a>
                    
                    <!-- Profile -->
                    <a href="{{ route('retailer.profile') }}" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                        <i class="fas fa-user-circle mr-3"></i>
                        <span class="nav-text">Profile</span>
                    </a>
                </nav>
            </div>
            
            <!-- Collapse Button -->
            <div class="p-4 border-t border-primary-700">
                <button id="collapseSidebar" class="w-full flex items-center justify-center text-primary-200 hover:text-white">
                    <i class="fas fa-chevron-left mr-2"></i>
                    <span class="nav-text">Collapse</span>
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-xl font-bold text-gray-800">Incoming Customer Orders</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <i class="fas fa-bell text-gray-500 hover:text-primary-600 cursor-pointer"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name=Retailer&background=22c55e&color=fff" alt="User" class="w-8 h-8 rounded-full">
                            <span class="text-sm font-medium">Retailer</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Stats Cards -->
                 <p class="text-2x1 font-semibold text-primary-700 bg-primary-100 px-4 py-1 rounded-lg shadow-sm inline-block mb-5">
    Total Orders: {{ $totalOrders }}
</p>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    
                  <div class="bg-white p-4 rounded-lg shadow border-l-4 border-blue-500">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500">On Delivery</p>
            <p class="text-2xl font-bold">{{ $deliveryOrders }}</p>
        </div>
        <div class="bg-blue-100 p-3 rounded-full">
            <i class="fas fa-truck text-blue-600"></i>
        </div>
    </div>
</div>


                   <div class="bg-white p-4 rounded-lg shadow border-l-4 border-yellow-500">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500">Pending</p>
            <p class="text-2xl font-bold">{{ $pendingOrders }}</p>
        </div>
        <div class="bg-yellow-100 p-3 rounded-full">
            <i class="fas fa-clock text-yellow-600"></i>
        </div>
    </div>
</div>

                    <div class="bg-white p-4 rounded-lg shadow border-l-4 border-green-500">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500">Completed</p>
            <p class="text-2xl font-bold">{{ $completedOrders }}</p>
        </div>
        <div class="bg-green-100 p-3 rounded-full">
            <i class="fas fa-check-circle text-green-600"></i>
        </div>
    </div>
</div>

                   <div class="bg-white p-4 rounded-lg shadow border-l-4 border-red-500">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500">Cancelled</p>
            <p class="text-2xl font-bold">{{ $cancelledOrders }}</p>
        </div>
        <div class="bg-red-100 p-3 rounded-full">
            <i class="fas fa-times-circle text-red-600"></i>
        </div>
    </div>
</div>

                </div>

                <!-- Orders Table -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-800">Recent Orders</h3>
                        <div class="relative">
                            <input type="text" placeholder="Search orders..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach($orders as $transactionId => $orderGroup)
            <tr>
                {{-- Order ID + Date --}}
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-primary-600">
                        {{ $transactionId ?? 'No ID' }}
                    </div>
                    <div class="text-xs text-gray-500">
                        {{ $orderGroup->first()->created_at->format('M d, Y h:i A') }}
                    </div>
                </td>

                {{-- Customer Info --}}
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                        {{ $orderGroup->first()->customer->name ?? 'N/A' }}
                    </div>
                    <div class="text-xs text-gray-500">
                        {{ $orderGroup->first()->customer->email ?? '' }}
                    </div>
                </td>

                {{-- Products --}}
                <td class="px-6 py-4 whitespace-nowrap">
                    @foreach ($orderGroup as $item)
                        <div class="text-xs">
                            {{ $item->product_name }} ×{{ $item->quantity }}
                        </div>
                    @endforeach
                </td>

                {{-- Total Amount --}}
                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                    UGX {{ number_format($orderGroup->sum('total')) }}
                </td>

                {{-- Status --}}
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                        {{ ucfirst($orderGroup->first()->status) }}
                    </span>
                </td>

                {{-- Actions --}}
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    @if($transactionId)
                        <a href="{{ route('retailer.orders.show', ['transactionId' => $transactionId]) }}" class="text-primary-600 hover:text-primary-900">
                            <i class="fas fa-eye"></i> View
                        </a>
                    @else
                        <span class="text-gray-400">No transaction ID</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">24</span> results
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                Previous
                            </button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Toggle sidebar collapse
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.querySelector('.sidebar-collapse').classList.toggle('collapsed');
        });
        
        // Collapse sidebar button
        document.getElementById('collapseSidebar').addEventListener('click', function() {
            document.querySelector('.sidebar-collapse').classList.toggle('collapsed');
        });
    </script>
</body>
</html>