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
        /* Custom styles that extend Tailwind */
        .nav-item {
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
        }
        
        .nav-item:hover {
            background-color: rgba(255, 215, 0, 0.1);
        }
        .nav-item.active {
            background-color: #f0fdf4;
            color: #14532d;
            font-weight: 600;
        }
        
        .tile {
            transition: all 0.3s ease;
        }
        
        .tile:hover {
            transform: translateY(-5px);
            background-color: theme('colors.gold.500');
            color: theme('colors.green.800');
        }
        
        .tile:hover i {
            color: theme('colors.green.800');
        }
        
        tr:hover {
            background-color: theme('colors.gray.100');
        }
        
        .progress {
            background-color: theme('colors.gold.500');
        }
        
        .status-delivered {
            color: theme('colors.green.600');
        }
        
        .status-pending {
            color: theme('colors.orange.500');
        }
        
        .status-intransit {
            color: theme('colors.gold.600');
        }
        
        .status-approved {
            background-color: theme('colors.green.500');
        }
        
        .status-rejected {
            background-color: theme('colors.red.500');
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Main flex container -->
    <div class="flex flex-row h-screen">
        <!-- Sidebar -->
       <!-- Admin Sidebar - Keep this consistent across all admin pages -->
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
                <!-- Activity - Active when on main dashboard -->
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span>Activity</span>
                </a>
                
                <!-- Inventory -->
                <a href="{{ route('admin.inventory.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item {{ request()->routeIs('admin.inventory.*') ? 'active' : '' }}">
                    <i class="fas fa-boxes w-5 text-center"></i>
                    <span>Inventory</span>
                </a>
                
                <!-- Order Management -->
               
                
                <!-- Procurement - Active when on any procurement page -->
                <a href="{{ route('admin.procurement.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item {{ request()->routeIs('admin.procurement.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart w-5 text-center"></i>
                    <span>Procurement</span>
                </a>
                
                <!-- Chat -->
                <a href="{{ route('chat.livewire') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item {{ request()->routeIs('chat.*') ? 'active' : '' }}">
                    <i class="fas fa-comment-dots w-5 text-center"></i>
                    <span>Chat</span>
                    <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full ml-auto">2 unread</span>
                </a>
                
                <!-- Logistics -->
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item {{ request()->routeIs('admin.logistics.*') ? 'active' : '' }}">
                    <i class="fas fa-truck w-5 text-center"></i>
                    <span>Logistics</span>
                </a>
                
                <!-- Customer Segments -->
                <a href="{{ route('admin.customer.segments') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item {{ request()->routeIs('admin.customer.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie w-5 text-center"></i>
                    <span>Customer Segments</span>
                </a>
                
                <!-- Profile -->
                <a href="{{ route('admin.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                    <i class="fas fa-user w-5 text-center"></i>
                    <span>Profile</span>
                </a>
            </nav>
        </div>
    </div>
</div>

        <!-- Main content area -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-gray-800">Procurement Dashboard</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin"/>
                    </div>
                </div>
            </header>
            
            <!-- Main Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-green-700">Procurement Overview</h2>
                    <button class="bg-gold-500 text-green-700 px-4 py-2 rounded-md hover:bg-gold-600 transition-colors">
                        <i class="fas fa-download mr-2"></i> Export Report
                    </button>
                </div>
                
                <!-- Quick Access Tiles -->
                  

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white border-2 border-gold-500 rounded-lg p-6 text-center cursor-pointer hover:shadow-lg transition-all tile"
                         onclick="window.location.href='{{ route('goods-received.index') }}'">
                        <i class="fas fa-box-open text-green-600 text-3xl mb-3"></i>
                        <h3 class="text-lg font-semibold mb-1">Goods Received</h3>
                        <p class="text-gray-600">View received items</p>
                    </div>
                    
                    <div class="bg-white border-2 border-gold-500 rounded-lg p-6 text-center cursor-pointer hover:shadow-lg transition-all tile"
                         onclick="window.location.href='{{ route('procurement-requests.index') }}'">
                        <i class="fas fa-clipboard-list text-green-600 text-3xl mb-3"></i>
                        <h3 class="text-lg font-semibold mb-1">Procurement Request</h3>
                        <p class="text-gray-600">Track PR status</p>
                    </div>
                    
                    <div class="bg-white border-2 border-gold-500 rounded-lg p-6 text-center cursor-pointer hover:shadow-lg transition-all tile"
                         onclick="window.location.href='{{ route('purchase-orders.index') }}'">
                        <i class="fas fa-shopping-cart text-green-600 text-3xl mb-3"></i>
                        <h3 class="text-lg font-semibold mb-1">Purchase Order</h3>
                        <p class="text-gray-600">Active POs & history</p>
                    </div>
                    
                    <div class="bg-white border-2 border-gold-500 rounded-lg p-6 text-center cursor-pointer hover:shadow-lg transition-all tile"
                         onclick="window.location.href='#'">
                        <i class="fas fa-building text-green-600 text-3xl mb-3"></i>
                        <h3 class="text-lg font-semibold mb-1">Suppliers</h3>
                        <p class="text-gray-600">Supplier directory</p>
                    </div>
                </div>
                
                <!-- Key Metrics -->
             <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-green-600 text-gold-500 rounded-lg p-6 text-center shadow-md">
        <i class="fas fa-clock text-2xl mb-2"></i>
        <h3 class="text-lg mb-1">Pending PRs</h3>
        <div class="text-3xl font-bold" id="pending-prs">{{ $pendingPRs }}</div>
    </div>

    <div class="bg-green-600 text-gold-500 rounded-lg p-6 text-center shadow-md">
        <i class="fas fa-file-invoice text-2xl mb-2"></i>
        <h3 class="text-lg mb-1">Active POs</h3>
        <div class="text-3xl font-bold" id="active-pos">{{ $activePOs }}</div>
    </div>

    <div class="bg-green-600 text-gold-500 rounded-lg p-6 text-center shadow-md">
        <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
        <h3 class="text-lg mb-1">Late Deliveries</h3>
        <div class="text-3xl font-bold" id="late-deliveries">{{ $lateDeliveries }}</div>
    </div>

    <div class="bg-green-600 text-gold-500 rounded-lg p-6 text-center shadow-md">
        <i class="fas fa-user-plus text-2xl mb-2"></i>
        <h3 class="text-lg mb-1">New Suppliers</h3>
        <div class="text-3xl font-bold" id="new-suppliers">{{ $newSuppliers }}</div>
    </div>
</div>

                
                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-green-700">Procurement Request Status</h3>
                            <select class="border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-gold-500">
                                <option>Last 30 Days</option>
                                <option>Last 60 Days</option>
                                <option>Last 90 Days</option>
                            </select>
                        </div>
                        <div class="h-64 bg-gray-50 rounded flex items-center justify-center text-gray-500">
                            [Bar chart would be rendered here with Chart.js]
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-green-700">Spend by Category</h3>
                            <select class="border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-gold-500">
                                <option>Q2 2024</option>
                                <option>Q1 2024</option>
                                <option>2023</option>
                            </select>
                        </div>
                        <div class="h-64 bg-gray-50 rounded flex items-center justify-center text-gray-500">
                            [Pie chart would be rendered here with Chart.js]
                        </div>
                    </div>
                </div>
                
                <!-- Purchase Order Tracking -->
                <div class="bg-white rounded-lg p-6 shadow-sm mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-green-700">Purchase Order Tracking</h3>
                        <div class="flex gap-3">
                            <input type="text" placeholder="Search POs..." 
                                   class="border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-gold-500">
                            <select class="border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-gold-500">
                                <option>All Status</option>
                                <option>Delivered</option>
                                <option>In Transit</option>
                                <option>Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-green-600 text-gold-500">
                                    <th class="px-4 py-3 text-left">PO #</th>
                                    <th class="px-4 py-3 text-left">Supplier</th>
                                    <th class="px-4 py-3 text-left">Amount ($)</th>
                                    <th class="px-4 py-3 text-left">Status</th>
                                    <th class="px-4 py-3 text-left">Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
    @foreach($orders as $order)
        <tr class="border-b border-gray-200 hover:bg-gray-100 cursor-pointer" onclick="window.location.href='{{ route('purchase-orders.show', $order->id) }}'">
            <td class="px-4 py-3">PO-{{ $order->id }}</td>
            <td class="px-4 py-3">{{ $order->supplier_name }}</td>
            <td class="px-4 py-3">UG shs{{ number_format($order->total_amount, 2) }}</td>
            <td class="px-4 py-3 
                @if($order->status == 'delivered') status-delivered
                @elseif($order->status == 'in transit') status-intransit
                @elseif($order->status == 'pending') status-pending
                @endif">
                @if($order->status == 'delivered') ✅ Delivered
                @elseif($order->status == 'in transit') 🚛 In Transit
                @elseif($order->status == 'pending') ⏳ Pending
                @else ❓ Unknown
                @endif
            </td>
            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($order->expected_delivery_date)->format('d-M-Y') }}</td>
        </tr>
    @endforeach

    @forelse($orders as $order)
    
@empty
    <tr>
        <td colspan="5" class="text-center py-4 text-gray-500">No purchase orders found.</td>
    </tr>
@endforelse

</tbody>

                        </table>
                    </div>
                </div>

                <!-- Recent Goods Received -->
                <div class="space-y-4 max-h-96 overflow-y-auto">
    @foreach($recentGoodsReceived as $goods)
        <div class="flex items-center gap-4 py-3 border-b border-gray-200">
            <div class="w-12 h-12 rounded bg-gray-100 flex items-center justify-center text-green-600">
                <i class="fas fa-seedling"></i> {{-- You can customize icon based on product type --}}
            </div>
            <div class="flex-1">
                <h4 class="font-medium">{{ $goods->product_name ?? 'N/A' }}</h4>
                <p class="text-sm text-gray-600">
                    Supplier: {{ $goods->supplier->name ?? 'Unknown' }} | Qty: {{ $goods->quantity }} {{ $goods->unit ?? '' }}
                </p>
                <p class="text-xs text-gray-500">Received: {{ $goods->received_at->format('d-M-Y') }}</p>
            </div>
            <div class="w-5 h-5 rounded-full {{ $goods->status == 'pending' ? 'bg-red-500' : 'bg-green-500' }}"></div>
        </div>
    @endforeach
</div>

            </main>
        </div>
    </div>
    
    <script>
        // Animate metric numbers
        function animateValue(id, start, end, duration) {
            const obj = document.getElementById(id);
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }
        
        // Animate metrics on page load
        document.addEventListener('DOMContentLoaded', function() {
            animateValue("pending-prs", 0, 12, 1000);
            animateValue("active-pos", 0, 8, 1000);
            animateValue("late-deliveries", 0, 3, 1000);
            animateValue("new-suppliers", 0, 5, 1000);
        });
    </script>
</body>
</html>