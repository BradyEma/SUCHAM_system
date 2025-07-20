@php use Illuminate\Support\Facades\Auth; @endphp

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
                        <i class="fas fa-leaf text-yellow-500 text-xl"></i>
                        <span class="text-xl font-bold">GoldenFields</span>
                        <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full ml-2">ADMIN</span>
                    </div>
                </div>
                
                <!-- User Profile -->
               
                
                <!-- Main Navigation -->
                <div class="flex-1 overflow-y-auto py-4">

                    <nav class="flex-1 p-4 space-y-2">
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
                            <i class="fas fa-tachometer-alt w-5 text-center"></i>
                            <span>Activity</span>
                        
                        </a>
                        
                        <a href="{{ route('admin.inventory.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
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
                        
                       <a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                            <i class="fas fa-comment-dots w-5 text-center"></i>
                            <span>Chat</span>
                            <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full ml-auto">2 unread</span>
                        </a>
                        
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                            <i class="fas fa-truck w-5 text-center"></i>
                            <span>Logistics</span>
                        </a>

                        {{-- Customer Segments for machine learning --}}
                        <a href="{{ route('admin.customer.segments') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                            <i class="fas fa-chart-pie w-5 text-center"></i>
                            <span>Customer Segments</span>
                        </a>
                        <a href="{{ route('support.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                            <i class="fas fa-question-circle w-5 text-center"></i>
                            <span>Support Center</span>
                        </a>


                        <a href="{{ route('admin.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                            <i class="fas fa-user w-5 text-center"></i>

                            <span>Profile</span>
                        </a>

                       
               
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
                                <span class="text-sm font-medium text-gray-700 hidden md:inline">Admin</span>
<img class="h-8 w-8 rounded-full -ml-4" src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="User avatar">
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
                            <h2 class="text-3xl font-bold text-white-800">Welcome Admin, {{ Auth::user()->name }}!</h2>
                            <p class="opacity-90">Here's what's happening with your agro business today.</p>
                        </div>
                        <button class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-primary-800 bg-white hover:bg-gray-100">
                            <i class="fas fa-download mr-2"></i> Generate Report
                        </button>
                    </div>
                </div>

                <section class="mb-8">
                    <div class="bg-gradient-to-r from-green-700 to-green-800 rounded-lg shadow-lg p-4 mb-4">
                        <h2 class="text-xl font-semibold text-white">Supplier Management</h2>
                    </div>
                    
                    <div class="overflow-x-auto rounded-lg shadow-md border border-green-100">
                        <table class="min-w-full divide-y divide-green-200">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Business</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Location</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Certificate</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Profile</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-green-100">
                                @foreach ($suppliers as $supplier)
                                <tr class="hover:bg-green-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $supplier->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $supplier->user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $supplier->business_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $supplier->location }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <a href="{{ asset('storage/' . $supplier->document_path) }}" target="_blank" class="text-green-600 hover:text-green-800 font-medium flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            View PDF
                        </a>


                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            @if ($supplier->status === 'active')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        @elseif ($supplier->status === 'pending')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        @elseif ($supplier->status === 'suspended')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Suspended</span>
                        @elseif ($supplier->status === 'deactivated')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Deactivated</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Unknown</span>
                        @endif

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.suppliers.show', ['id' => $supplier->user_id]) }}" class="inline-flex items-center justify-center group">
                        <span class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-yellow-400 text-blacke font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform group-hover:-translate-y-0.5">
                            View
                        </span>
                                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200 mb-10">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-primary-500">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                        Vendor Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                        Validation Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                        Details
                    </th>
                    <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($suppliers as $supplier)
               @php
    $supplierUserId = $supplier->user_id;
    $validation = $validations[$supplierUserId] ?? null;
    $response = $validation && $validation->validation_result 
        ? json_decode($validation->validation_result, true) 
        : null;

    if (is_string($response)) {
        $response = json_decode($response, true); // double-decoding safeguard
    }
@endphp



                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center">
                                <span class="text-primary-600 font-medium">{{ strtoupper(substr($supplier->user->name, 0, 1)) }}</span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $supplier->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $supplier->user->email }}</div>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($response)
                            @if ($response['success'])
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Approved
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Rejected
                                </span>
                            @endif
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                <i class="fas fa-clock mr-1"></i> Pending
                            </span>
                        @endif
                    </td>

   

<td class="px-6 py-4">
   

   
    @if ($validation)
        @if (is_array($response) && isset($response['success']) && $response['success'] === true)
            <div class="text-sm text-green-600">
                <i class="fas fa-calendar-check mr-2"></i>
                Visit scheduled:
                <span class="font-medium">
                    {{ $validation->visit_date ? \Carbon\Carbon::parse($validation->visit_date)->format('F j, Y') : 'Pending date confirmation' }}
                </span>
            </div>
        @elseif (is_array($response) && isset($response['success']) && $response['success'] === false)
            <div class="text-sm font-medium text-red-600">
                Insufficient requirements
            </div>
        @else
            <div class="text-sm font-medium text-red-600">
                Malformed or missing validation response
            </div>
        @endif
    @else
        <div class="text-sm text-gray-500 italic">
            No validation data submitted yet.
        </div>
    @endif
</td>

                    <td class="px-8 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.suppliers.show', $supplier->user_id) }}" class="text-primary-600 hover:text-primary-900 mr-3">
                            <i class="fas fa-eye mr-1"></i> View
                        </a>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
                <div class="w-full mb-8">
                <!-- Forecast Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <!-- Card Header -->
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Demand Forecast Analysis
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">Historical vs. predicted demand patterns</p>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="relative">
                                    <select id="productFilter" class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="all">All Products</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="relative">
                                    <select id="granularityFilter" class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="month" selected>Monthly</option>
                                        <option value="year">Yearly</option>
                                        <option value="week">Weekly</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Enhanced Chart Container -->
                    <div class="p-1 sm:p-4">
                        <div class="h-[32rem] w-full"> <!-- Increased height -->
                            <canvas id="forecastChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                    
                    <!-- Card Footer -->
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                                <span class="text-sm text-gray-600">Historical</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-amber-500 mr-2"></div>
                                <span class="text-sm text-gray-600">Forecasted</span>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <form method="POST" action="{{ route('generate.forecast') }}" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm transition-all duration-200 hover:shadow-md">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Generate Forecast
                                </button>
                            </form>
                            
                            <a href="{{ route('forecast.pdf') }}" target="_blank" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow-sm transition-all duration-200 hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                </svg>
                                Export PDF
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Status Messages -->
                @if(session('success'))
                    <div class="mt-4 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 text-green-500 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{!! session('success') !!}</p>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mt-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 text-red-500 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">{!! session('error') !!}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
            // Enhanced Chart Configuration with Same Logic
            let chart;

            async function loadChart(product = 'all', granularity = 'month') {
                const res = await fetch(`/admin/demand-predictions?group=${granularity}`);
                const data = await res.json();

                const filtered = product === 'all'
                    ? data
                    : data.filter(row => row.product === product);

                const labels = [...new Set(filtered.map(row => row.period))].sort();

                const historical = labels.map(label => {
                    const row = filtered.find(r => r.period === label && r.type === 'historical');
                    return row ? +row.quantity : null;
                });

                const forecast = labels.map(label => {
                    const row = filtered.find(r => r.period === label && r.type === 'forecast');
                    return row ? +row.quantity : null;
                });

                const ctx = document.getElementById('forecastChart').getContext('2d');
                if (chart) chart.destroy();

                chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels,
                        datasets: [
                            {
                                label: 'Historical Demand',
                                data: historical,
                                borderColor: '#3B82F6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                borderWidth: 3,
                                pointBackgroundColor: '#3B82F6',
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                tension: 0.3,
                                fill: true
                            },
                            {
                                label: 'Forecasted Demand',
                                data: forecast,
                                borderColor: '#F59E0B',
                                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                borderWidth: 3,
                                borderDash: [6, 4],
                                pointBackgroundColor: '#F59E0B',
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                tension: 0.3,
                                fill: true
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: {
                                        size: 13,
                                        weight: '600'
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: '#1F2937',
                                titleFont: {
                                    size: 14,
                                    weight: '600'
                                },
                                bodyFont: {
                                    size: 13
                                },
                                padding: 12,
                                usePointStyle: true,
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + context.parsed.y.toLocaleString() + ' units';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false,
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                title: { 
                                    display: true, 
                                    text: 'Quantity (Units)', 
                                    font: {
                                        weight: '600',
                                        size: 13
                                    },
                                    padding: {top: 10, bottom: 10}
                                },
                                ticks: {
                                    padding: 8
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                title: { 
                                    display: true, 
                                    text: granularity.charAt(0).toUpperCase() + granularity.slice(1) + ' Period',
                                    font: {
                                        weight: '600',
                                        size: 13
                                    },
                                    padding: {top: 10, bottom: 10}
                                },
                                ticks: {
                                    padding: 8
                                }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        }
                    }
                });
            }

            // Rest of the original logic remains exactly the same
            async function loadProductFilter() {
                const res = await fetch(`/admin/demand-predictions`);
                const data = await res.json();
                const products = [...new Set(data.map(r => r.product))];

                const select = document.getElementById('productFilter');
                select.innerHTML = '<option value="all">All Products</option>';
                products.forEach(p => {
                    const option = document.createElement('option');
                    option.value = p;
                    option.textContent = p;
                    select.appendChild(option);
                });
            }

            document.addEventListener('DOMContentLoaded', () => {
                loadProductFilter().then(() => loadChart());

                document.getElementById('productFilter').addEventListener('change', e => {
                    loadChart(e.target.value, document.getElementById('granularityFilter').value);
                });

                document.getElementById('granularityFilter').addEventListener('change', e => {
                    loadChart(document.getElementById('productFilter').value, e.target.value);
                });
            });
            </script>
            @endpush


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

            
    </script>
    @stack('scripts') 

</body>
</html>