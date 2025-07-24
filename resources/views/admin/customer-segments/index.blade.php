<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldenFields - Customer segments</title>
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
                    
                    <a href="{{ route('admin.raw_materials.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
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

                    <a href="{{ route('admin.customer.segments') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
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
                        <span class="inline-block mr-2">🧠</span> Customer Segments Analysis
                    </h1>
                    <p class="text-gray-600 max-w-2xl mx-auto">Visualize and manage your customer segments for targeted marketing</p>
                </div>

                <!-- Chart Card -->
                <div class="bg-white p-6 rounded-2xl shadow mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-left">Customer Segment Distribution</h3>
                    <div class="flex justify-center">
                        <div class="w-full max-w-2xl h-[28rem]">
                            <canvas id="segmentChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Action Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Refresh Button -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-5 rounded-xl border border-blue-100">
                        <form method="POST" action="{{ route('admin.refresh.segments') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-3 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition-all transform hover:scale-[1.02]">
                                <span class="text-lg">🔁</span>
                                <span>Refresh Segments</span>
                            </button>
                        </form>
                    </div>

                    <!-- Status Messages -->
                    <div class="flex items-center justify-center bg-gray-50 p-5 rounded-xl border border-gray-200">
                        @if(session('success'))
                            <div class="flex items-center gap-2 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="flex items-center gap-2 text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Export Button -->
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 p-5 rounded-xl border border-red-100">
                        <a href="{{ route('admin.export.segments') }}" class="w-full flex items-center justify-center gap-3 px-5 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg shadow-md transition-all transform hover:scale-[1.02]">
                            <span class="text-lg">📤</span>
                            <span>Export as PDF</span>
                        </a>
                    </div>
                </div>

                <!-- Promo Emails Section -->
                <div class="bg-white p-8 rounded-xl shadow-lg mb-8 border border-gray-100">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <span class="mr-2">📬</span> Send Targeted Promotions
                    </h3>
                    <p class="text-gray-600 mb-6">Select a customer segment to send personalized marketing campaigns</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @php
                            $labels = ['0' => '💸 High Spender', '1' => '🧺 Occasional Buyer', '2' => '🔍 Low Activity'];
                            $buttonColors = ['0' => 'from-purple-500 to-blue-500', '1' => 'from-green-500 to-teal-500', '2' => 'from-yellow-500 to-orange-500'];
                        @endphp
                        
                        @foreach($labels as $i => $label)
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = true" class="w-full bg-gradient-to-r {{ $buttonColors[$i] }} text-white font-medium px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all transform hover:scale-[1.02]">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-lg">{{ explode(' ', $label)[0] }}</span>
                                    <span>Send to {{ str_replace(explode(' ', $label)[0], '', $label) }}</span>
                                </div>
                            </button>

                            <!-- Modal with working form submission -->
                            <div x-show="open" x-cloak class="fixed inset-0 z-50 overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity" @click="open = false">
                                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                    </div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" @click.stop>
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                    <div class="flex justify-between items-center">
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                            Send Promotion to {{ $label }}
                                                        </h3>
                                                        <button @click="open = false" class="text-gray-400 hover:text-gray-500">
                                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500">
                                                            This will send a promotional email to all customers in the "{{ $label }}" segment.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <form action="{{ route('admin.send.promo') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="cluster" value="{{ $i }}">
                                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gradient-to-r {{ $buttonColors[$i] }} text-white font-medium hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Confirm & Send
                                                </button>
                                            </form>
                                            <button @click="open = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="bg-white p-6 rounded-xl shadow-lg mb-8 border border-gray-100">
                    <form method="GET" action="{{ route('admin.customer.segments') }}">
                        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4">
                            <div class="w-full sm:w-auto">
                                <label class="block text-gray-700 font-medium mb-2">Filter by Segment:</label>
                                <div class="flex items-center gap-3">
                                    <select name="label" onchange="this.form.submit()" class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-primary-500 focus:border-primary-500 border">
                                        <option value="">-- All Segments --</option>
                                        @foreach($allLabels as $label)
                                            <option value="{{ $label }}" {{ request('label') === $label ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if(request('label'))
                                        <a href="{{ route('admin.customer.segments') }}" class="whitespace-nowrap text-red-500 hover:text-red-700 text-sm font-medium flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Clear
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                Showing {{ $segments->count() }} of {{ $segments->total() }} customers
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Data Table Section -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                            <span class="mr-2">📄</span> Segment Details
                        </h2>
                        <div class="text-sm text-gray-500">
                            Last updated: {{ now()->format('M d, Y h:i A') }}
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Spent(UGX)</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orders</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Segment</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($segments as $s)
                                    @php
                                        $clusterLabels = [
                                            'Cluster 0' => '💸 High Spender',
                                            'Cluster 1' => '🧺 Occasional Buyer',
                                            'Cluster 2' => '🔍 Low Activity',
                                        ];
                                        $segmentColors = [
                                            'Cluster 0' => 'bg-purple-100 text-purple-800',
                                            'Cluster 1' => 'bg-green-100 text-green-800',
                                            'Cluster 2' => 'bg-yellow-100 text-yellow-800',
                                        ];
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $s->customers_email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($s->order_amount, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $s->order_count }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $segmentColors[$s->label] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ $clusterLabels[$s->label] ?? $s->label }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No data found for this segment.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Showing {{ $segments->firstItem() }} to {{ $segments->lastItem() }} of {{ $segments->total() }} entries
                        </div>
                        <div class="flex space-x-2">
                            {{ $segments->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('segmentChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($grouped->keys()) !!},
                datasets: [{
                    data: {!! json_encode($grouped->values()) !!},
                    backgroundColor: ['#60a5fa', '#34d399', '#fbbf24'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>
</body>
</html>