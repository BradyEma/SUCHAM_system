@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldenFields Agro - Logistics Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

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
        .logistics-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .logistics-badge.active {
            background-color: #dcfce7;
            color: #166534;
        }
        .logistics-badge.inactive {
            background-color: #fee2e2;
            color: #991b1b;
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
                
                <!-- Main Navigation -->
                <div class="flex-1 overflow-y-auto py-4">
                    <nav class="flex-1 p-4 space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
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
                        
                        <a href="{{ route('logistics') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item nav-link {{ request()->is('admin/logistics*') ? 'active' : '' }}  active">
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
    </nav>
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
                        <h1 class="ml-4 text-xl font-semibold text-gray-800">Logistics Management</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none relative">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                            </button>
                        </div>
                        <div class="relative">
                            <button class="flex items-center space-x-2 focus:outline-none" id="user-menu-button">
                                <span class="text-sm font-medium text-gray-700 hidden md:inline">{{ Auth::user()->name }}</span>
                                <img class="h-8 w-8 rounded-full" src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="User avatar">
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('logistics.updateStatus', $logistic->id) }}">
    @csrf
    <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1">
        @foreach(['pending', 'processing', 'shipped', 'completed', 'canceled'] as $status)
            <option value="{{ $status }}" {{ $logistic->status === $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</form>


                <!-- Welcome Banner -->
                <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-lg shadow-md p-6 text-white mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-2xl font-bold">Logistics Dashboard</h2>
                            <p class="opacity-90">Manage your transportation and delivery operations</p>
                        </div>
                        <a href="{{ route('logistics.shipments.create') }}" class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-primary-800 bg-white hover:bg-gray-100">
                            <i class="fas fa-plus mr-2"></i> Add New Entry
                        </a>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Total Entries -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-400">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 truncate">Total Entries</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">{{ count($logistics) }}</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-truck text-primary-600"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Active -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-400">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 truncate">Active</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $logistics->where('status', 'active')->count() }}</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-check-circle text-primary-600"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Inactive -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-400">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 truncate">Inactive</p>
                                <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $logistics->where('status', 'inactive')->count() }}</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-exclamation-circle text-primary-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Table -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900">Logistics Entries</h3>
                       
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($logistics as $logistic)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $logistic->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $logistic->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="logistics-badge {{ $logistic->status }}">
                                            {{ ucfirst($logistic->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $logistic->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $logistic->updated_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('admin.logistics.show', $logistic->id) }}" class="text-primary-600 hover:text-primary-900 mr-3">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.logistics.edit', $logistic->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.logistics.destroy', $logistic->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $logistics->links() }}
                    </div>
                </div>
                <div id="map" style="height: 400px; width: 100%;"></div>
                
            </main>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        document.getElementById('open-mobile-sidebar').addEventListener('click', function() {
            // You'll need to implement mobile sidebar functionality here
            console.log('Mobile sidebar toggle clicked');
        });

        // Initialize any logistics-specific functionality
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Logistics dashboard loaded');
        });

        document.addEventListener("DOMContentLoaded", function () {
        var map = L.map('map').setView([0.3476, 32.5825], 13); // Kampala coords

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Add a sample marker
        L.marker([0.3476, 32.5825]).addTo(map)
            .bindPopup('Kampala - Logistics Base')
            .openPopup();
    });

        // User menu toggle
        document.getElementById('user-menu-button').addEventListener('click', function() {
            // Toggle user menu visibility
            console.log('User menu clicked');
        }); 
    </script>
</body>
</html>