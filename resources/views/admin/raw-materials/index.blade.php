<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldenFields - Raw materials Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

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
        [x-cloak] { display: none !important; }
        @keyframes pop-in {
            0% { opacity: 0; transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }
        .animate-pop-in {
            animation: pop-in 0.2s ease-out forwards;
        }
        /* Fixed sidebar and scrollable main content */
        html, body {
            height: 100%;
            overflow: hidden; /* Prevent double scrollbars */
        }
        .sidebar-container {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 16rem; /* Match your sidebar width */
            overflow-y: auto; /* Allow sidebar to scroll if content is taller than viewport */
        }
        .main-content {
            margin-left: 16rem; /* Match sidebar width */
            height: 100vh;
            overflow-y: auto; /* Allow main content to scroll */
        }
        /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal-content {
            max-height: calc(100vh - 40px);
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex h-full">
        <!-- Fixed Sidebar -->
        <div class="sidebar-container hidden md:block">
            <div class="flex flex-col w-64 h-full bg-primary-800 text-white">
                <div class="flex items-center justify-center h-16 px-4 border-b border-primary-700">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-leaf text-accent-400 text-xl"></i>
                        <span class="text-xl font-bold">GoldenFields</span>
                        <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full ml-2">ADMIN</span>
                    </div>
                </div>
                <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
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
                    
                    <a href="{{ route('admin.raw_materials.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
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

                    <a href="{{ route('admin.customer.segments') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-chart-pie w-5 text-center"></i>
                        <span>Customer Segments</span>
                    </a>
                    <a href="{{ route('support.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item ">
                        <i class="fas fa-question-circle w-5 text-center"></i>
                        <span>Support Center</span>
                    </a>

                    <a href="{{ route('admin.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                        <i class="fas fa-truck w-5 text-center"></i>
                        <span>Profile</span>
                    </a>
                </nav>
            </div>
        </div>
        
        <!-- Scrollable Main Content -->
        <div class="main-content flex-1">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Header Section -->
                <div class="text-center mb-10">
                    <h1 class="text-4xl font-bold text-primary-800 mb-3 tracking-tight">
                        <span class="inline-block mr-2">📦</span>  Raw Materials Management
                    <p class="text-gray-600 max-w-2xl mx-auto">Manage your raw materials efficiently</p>
                </div>
                <!-- Content Section -->
                <div class="max-w-5xl mx-auto mt-8">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{-- report details button --}}
                    <div class="flex justify-between items-center mb-4">
                        {{-- Check Reports link (left) --}}
                        <a href="{{ route('admin.reorders.index') }}"
                        class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                            📃 Check Reports of Reorders
                        </a>

                        {{-- Run Auto Conversion button (right) --}}
                        <form method="POST" action="{{ route('admin.raw.convert') }}">
                            @csrf
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow text-sm">
                                🔄 Run Auto Conversion
                            </button>
                        </form>
                    </div>


                    {{-- Add Raw Material Form --}}

                    <div class="bg-white p-6 rounded-lg shadow mb-8">
                        <h2 class="text-lg font-semibold mb-4">➕ Add Raw Material</h2>
                        <form action="{{ route('admin.raw_materials.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-gray-700 font-medium">Material Name</label>
                                <input type="text" name="material_name" class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g., Sugarcane">
                                @error('material_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-medium">Quantity (kg)</label>
                                    <input type="number" name="quantity" class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    @error('quantity') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 font-medium">Reorder Threshold</label>
                                    <input type="number" name="reorder_threshold" class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    @error('reorder_threshold') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700 transition">
                                ➕ Add Material
                            </button>
                        </form>
                    </div>

                    {{-- List of Existing Materials --}}
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-lg font-semibold mb-4">📋 Existing Materials</h2>
                        <table class="min-w-full table-auto border">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="px-4 py-2 border">Material</th>
                                    <th class="px-4 py-2 border">Quantity (kg)</th>
                                    <th class="px-4 py-2 border">Reorder Threshold</th>
                                    <th class="px-4 py-2 border">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($materials as $material)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-4 py-2 border">{{ $material->material_name }}</td>
                                        <td class="px-4 py-2 border">{{ $material->quantity }}</td>
                                        <td class="px-4 py-2 border">{{ $material->reorder_threshold }}</td>
                                        <td class="px-4 py-2 border">
                                            @if($material->quantity < $material->reorder_threshold)
                                                <span class="text-sm text-red-600 font-semibold">⚠️ Needs Reorder</span>
                                            @else
                                                <span class="text-sm text-green-600">✔️ OK</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-gray-500 py-4">No raw materials available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Conversion Form -->
                    <form method="GET" class="mb-6 flex flex-wrap items-end gap-4">
                        <div>
                            <label for="product" class="block text-sm font-medium text-gray-700">Filter by Product</label>
                            <select name="product" id="product" class="mt-1 block w-48 rounded-md border-gray-300 shadow-sm">
                                <option value="">All</option>
                                <option value="White Sugar" {{ request('product') === 'White Sugar' ? 'selected' : '' }}>White Sugar</option>
                                <option value="Brown Sugar" {{ request('product') === 'Brown Sugar' ? 'selected' : '' }}>Brown Sugar</option>
                                <option value="Raw Sugar" {{ request('product') === 'Raw Sugar' ? 'selected' : '' }}>Raw Sugar</option>
                                <option value="Sugar Cubes" {{ request('product') === 'Sugar Cubes' ? 'selected' : '' }}>Sugar Cubes</option>
                                <option value="Mollases" {{ request('product') === 'Mollases' ? 'selected' : '' }}>Mollases</option>
                                <option value="Honey" {{ request('product') === 'Honey' ? 'selected' : '' }}>Honey</option>
                            </select>
                        </div>

                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Filter by Date</label>
                            <input type="date" name="date" id="date" value="{{ request('date') }}"
                                class="mt-1 block w-48 rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <button type="submit"
                                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 mt-5">
                                Apply Filters
                            </button>
                            <a href="{{ route('admin.raw_materials.index') }}"
                            class="ml-2 text-sm text-red-600 underline mt-5 inline-block">Reset</a>
                        </div>
                    </form>

                    <!-- Conversion Logs Table -->
                    <div class="mt-10 bg-white p-6 rounded-lg shadow">
                        <h2 class="text-lg font-semibold mb-4">⚙️ Conversion History</h2>

                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 text-left text-sm text-gray-700">
                                    <th class="px-4 py-2">Raw Material</th>
                                    <th class="px-4 py-2">Quantity Used</th>
                                    <th class="px-4 py-2">Final Product</th>
                                    <th class="px-4 py-2">Quantity Produced</th>
                                    <th class="px-4 py-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($conversionLogs as $log)
                                    <tr class="border-t hover:bg-gray-50 text-sm">
                                        <td class="px-4 py-2">{{ $log->raw_material }}</td>
                                        <td class="px-4 py-2">{{ $log->amount_used }}</td> <!-- ✅ FIX -->
                                        <td class="px-4 py-2">{{ $log->converted_product }}</td> <!-- ✅ FIX -->
                                        <td class="px-4 py-2">{{ $log->amount_produced }}</td> <!-- ✅ FIX -->
                                        <td class="px-4 py-2">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-gray-500">No conversions recorded yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>                                                      
            </div>
        </div>
</body>
</html>