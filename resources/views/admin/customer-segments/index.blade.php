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
            <div class="flex items-center justify-center h-16 px-4 border-b border-primary-700">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-leaf text-accent-400 text-xl"></i>
                    <span class="text-xl font-bold">GoldenFields</span>
                    <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full ml-2">ADMIN</span>
                </div>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span>Activity</span>
                
                </a>
                
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
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
                
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-comment-dots w-5 text-center"></i>
                    <span>Chat</span>
                    <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full ml-auto">2 unread</span>
                </a>
                
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-truck w-5 text-center"></i>
                    <span>Logistics</span>
                </a>

                {{-- Customer Segments for machine learning --}}
                <a href="{{ route('admin.customer.segments') }}" class="flex items-center space-x-3 px-4 py-3 rounded nav-item active">
                    <i class="fas fa-chart-pie w-5 text-center"></i>
                    <span>View Customer Segments</span>
                </a>

                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded nav-item">
                    <i class="fas fa-cog w-5 text-center"></i>
                    <span>Settings</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Main content -->
    <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-800">Customer Segments</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin"/>
                </div>
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-sm font-medium text-gray-500">Cluster 0 (Budget Buyers)</h3>
                    <p class="text-xl font-semibold"> $ {{ number_format($avgSpend[0] ?? 0) }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-sm font-medium text-gray-500">Cluster 1 (Frequent Buyers)</h3>
                    <p class="text-xl font-semibold"> $ {{ number_format($avgSpend[1] ?? 0) }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-sm font-medium text-gray-500">Cluster 2 (High Spenders)</h3>
                    <p class="text-xl font-semibold"> $ {{ number_format($avgSpend[2] ?? 0) }}</p>
                </div>
            </div>

            <!-- Chart -->
            <div class="bg-white p-6 rounded shadow mb-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Customer Segment Distribution</h3>
                <div class="w-full max-w-xs mx-auto">
                    <canvas id="segmentChart" height="120"></canvas>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white p-4 rounded shadow mb-6 flex gap-4">
                <form method="POST" action="{{ route('admin.send.promo', 2) }}">
                    @csrf
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        ✉️ Email Promo to High Spenders (Cluster 2)
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.refresh.segments') }}">
                    @csrf
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        🔁 Refresh Segments (Run ML)
                    </button>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white p-4 rounded shadow">
                <form method="GET" class="mb-4">
                    <label for="cluster" class="mr-2 text-sm">Filter:</label>
                    <select name="cluster" id="cluster" onchange="this.form.submit()" class="border rounded p-1 text-sm">
                        <option value="">All</option>
                        <option value="0" {{ $cluster === "0" ? 'selected' : '' }}>Cluster 0</option>
                        <option value="1" {{ $cluster === "1" ? 'selected' : '' }}>Cluster 1</option>
                        <option value="2" {{ $cluster === "2" ? 'selected' : '' }}>Cluster 2</option>
                    </select>
                </form>
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Customer ID</th>
                            <th class="px-4 py-2 border">Order Amount</th>
                            <th class="px-4 py-2 border">Order Count</th>
                            <th class="px-4 py-2 border">Cluster</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $actions = [0=>'Offer budget bundles',1=>'Send loyalty rewards',2=>'Promote premium']; @endphp
                        @foreach ($segments as $segment)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $segment->customer_id }}</td>
                            <td class="border px-4 py-2">{{ $segment->order_amount }}</td>
                            <td class="border px-4 py-2">{{ $segment->order_count }}</td>
                            <td class="border px-4 py-2">
                                Cluster {{ $segment->cluster }} ({{ $segmentLabels[$segment->cluster] ?? 'Unknown' }})<br>
                                <span class="text-gray-500 text-xs italic">{{ $actions[$segment->cluster] ?? '' }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $segments->links() }}</div>
            </div>
        </main>
    </div>
</div>

<script>
const ctx = document.getElementById('segmentChart');
new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Cluster 0', 'Cluster 1', 'Cluster 2'],
        datasets: [{
            data: [
                {{ $clusterCounts[0] ?? 0 }},
                {{ $clusterCounts[1] ?? 0 }},
                {{ $clusterCounts[2] ?? 0 }}
            ],
            backgroundColor: ['#60A5FA', '#34D399', '#FBBF24']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' },
            title: { display: true, text: 'Customer Segments by Cluster' }
        }
    }
});
</script>
</body>
</html>
