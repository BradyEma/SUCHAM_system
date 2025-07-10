<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retailer Dashboard | GoldenFields Agro</title>
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
</head>
<body class="bg-gray-50 font-sans">
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
                        
                        <a href="#" class="text-primary-200 hover:bg-primary-700 hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-md">
                                <i class="fas fa-bell mr-3"></i>
                                Messages
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
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button type="button" class="md:hidden text-gray-500 focus:outline-none" id="open-mobile-sidebar">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="ml-4 text-xl font-semibold text-gray-800">Retailer Dashboard</h1>
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
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-secondary-500"></span>
                            </button>
                        </div>
                        <div class="relative">
                            <button class="flex items-center space-x-2 focus:outline-none" id="user-menu-button">
                                
                               <img 
        src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-avatar.png') }}" 
        alt="{{ $user->name }}" 
        class="h-10 w-10 rounded-full border-2 border-yellow-400"
    >
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
             @if(!$profileIsComplete)
    <div id="profileAlert" class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4 rounded-lg shadow-sm flex items-start justify-between">
        <div class="flex items-start">
            <div class="flex-shrink-0 pt-0.5">
                <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-base font-medium text-yellow-800">
                    <strong>Action Required:</strong> Please complete your business profile in 
                    <a href="{{ route('retailer.profile') }}" class="underline font-medium"><strong>Profile</strong></a> to personalize your experience.
                </p>
            </div>
        </div>
        <button type="button" onclick="document.getElementById('profileAlert').remove()" class="ml-4 -my-1.5 -mr-1.5 rounded-md p-1.5 text-yellow-500 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            <span class="sr-only">Dismiss</span>
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
@endif

              @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg shadow-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    </div>
@endif

@if($retailer && $retailer->status == 'pending')
    <div id="successAlert" class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-lg shadow-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                    Profile updated successfully. Thanks for your collaboration.
                </p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button 
                        type="button" 
                        onclick="document.getElementById('successAlert').remove()" 
                        class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    >
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif


                <!-- Welcome Banner -->
                <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-lg shadow-md p-6 text-white mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-2xl font-bold mb-2">Welcome back, {{ $user->name }}!</h2>
                            <p class="opacity-90">Here's your retail performance overview and quick actions.</p>
                        </div>
                        <button class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-primary-800 bg-white hover:bg-gray-100">
                            <i class="fas fa-download mr-2"></i> Download Reports
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Monthly Sales -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-secondary-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 truncate">Monthly Sales</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">$24,580</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-dollar-sign text-primary-600"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-green-600 text-sm font-semibold">
                                <i class="fas fa-arrow-up mr-1"></i> 18.5%
                            </span>
                            <span class="text-gray-500 text-sm ml-2">vs last month</span>
                        </div>
                    </div>
                    
                    <!-- Inventory Items -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-secondary-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 truncate">Inventory Items</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">127</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-boxes text-primary-600"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-red-600 text-sm font-semibold">
                                <i class="fas fa-arrow-down mr-1"></i> 5.2%
                            </span>
                            <span class="text-gray-500 text-sm ml-2">5 low stock</span>
                        </div>
                    </div>
                    
                    <!-- Pending Orders -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-secondary-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 truncate">Pending Orders</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">3</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-shopping-cart text-primary-600"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-gray-600 text-sm font-semibold">
                                <i class="fas fa-equals mr-1"></i> 0%
                            </span>
                            <span class="text-gray-500 text-sm ml-2">vs last month</span>
                        </div>
                    </div>
                    
                    <!-- Customer Rating -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-secondary-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 truncate">Customer Rating</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">4.8</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-star text-primary-600"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-green-600 text-sm font-semibold">
                                <i class="fas fa-arrow-up mr-1"></i> 0.2
                            </span>
                            <span class="text-gray-500 text-sm ml-2">vs last month</span>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Sales Chart -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Sales Performance</h3>
                            <select class="bg-gray-50 border border-gray-300 text-gray-700 py-1 px-3 rounded-md text-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                <option>Last 7 days</option>
                                <option selected>Last 30 days</option>
                                <option>Last 90 days</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Top Products -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Top Selling Products</h3>
                            <select class="bg-gray-50 border border-gray-300 text-gray-700 py-1 px-3 rounded-md text-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                <option>This Week</option>
                                <option selected>This Month</option>
                                <option>This Year</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="productsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Recent Orders -->
                    <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Recent Orders</h3>
                            <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-500">View all orders</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-2107</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jun 15, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">8</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$1,245</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Delivered</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-primary-600 hover:text-primary-900">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-2106</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jun 12, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$845</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Shipped</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-primary-600 hover:text-primary-900">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-2105</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jun 10, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$1,980</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-primary-600 hover:text-primary-900">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#GF-2104</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jun 8, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$420</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
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
                                    <p class="text-sm font-medium text-gray-900">Place New Order</p>
                                    <p class="text-xs text-gray-500">Order from GoldenFields</p>
                                </div>
                            </a>
                            <a href="#" class="group flex items-center p-3 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition">
                                <div class="bg-primary-100 p-2 rounded-full text-primary-600 group-hover:bg-primary-200 transition">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Request Return</p>
                                    <p class="text-xs text-gray-500">Initiate product return</p>
                                </div>
                            </a>
                            <a href="#" class="group flex items-center p-3 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition">
                                <div class="bg-primary-100 p-2 rounded-full text-primary-600 group-hover:bg-primary-200 transition">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Generate Invoice</p>
                                    <p class="text-xs text-gray-500">Create customer invoice</p>
                                </div>
                            </a>
                            <a href="#" class="group flex items-center p-3 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition">
                                <div class="bg-primary-100 p-2 rounded-full text-primary-600 group-hover:bg-primary-200 transition">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Contact Support</p>
                                    <p class="text-xs text-gray-500">Get help from GoldenFields</p>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Inventory Alerts -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Inventory Alerts</h4>
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-700">Golden Sugar 5kg - <span class="font-medium">Low stock (3 left)</span></p>
                                        <p class="text-xs text-gray-500">Reorder now to avoid stockout</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <span class="h-2 w-2 rounded-full bg-yellow-500"></span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-700">Organic Molasses 1L - <span class="font-medium">Running low (7 left)</span></p>
                                        <p class="text-xs text-gray-500">Consider reordering soon</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <span class="h-2 w-2 rounded-full bg-yellow-500"></span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-700">Brown Sugar 2kg - <span class="font-medium">Running low (5 left)</span></p>
                                        <p class="text-xs text-gray-500">Consider reordering soon</p>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-4 w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-secondary-600 hover:bg-secondary-700">
                                <i class="fas fa-box-open mr-2"></i> Manage Inventory
                            </button>
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
            // Sales Chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Sales ($)',
                        data: [4500, 5200, 4800, 6200, 7500, 8200, 9500],
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

            // Products Chart
            const productsCtx = document.getElementById('productsChart').getContext('2d');
            const productsChart = new Chart(productsCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Golden Sugar 5kg', 'Organic Molasses 1L', 'Brown Sugar 2kg', 'White Sugar 1kg', 'Premium Syrup'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: [
                            'rgba(249, 115, 22, 0.7)',
                            'rgba(34, 197, 94, 0.7)',
                            'rgba(234, 88, 12, 0.7)',
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(139, 92, 246, 0.7)'
                        ],
                        borderColor: [
                            'rgba(249, 115, 22, 1)',
                            'rgba(34, 197, 94, 1)',
                            'rgba(234, 88, 12, 1)',
                            'rgba(59, 130, 246, 1)',
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
                            position: 'right',
                        }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
</body>
</html>