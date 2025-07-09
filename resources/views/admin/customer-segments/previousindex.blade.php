@extends('layouts.app') {{-- assuming your main layout is layouts/app --}}

@section('content')
<div class="p-6 bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-lg shadow-md p-6 text-white mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold">Customer Segments</h2>
                <p class="opacity-80 text-sm">Analyzed by our ML model – see performance and take action.</p>
            </div>
        </div>
    </div>

    <!-- Segment Averages -->
    <div class="mb-6 bg-white shadow rounded p-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">📊 Avg Spend per Cluster</h3>
        <ul class="list-disc ml-6 text-sm text-gray-700 space-y-1">
            <li>Cluster 0 ({{ $segmentLabels[0] ?? '' }}): $ {{ number_format($avgSpend[0] ?? 0) }}</li>
            <li>Cluster 1 ({{ $segmentLabels[1] ?? '' }}): $ {{ number_format($avgSpend[1] ?? 0) }}</li>
            <li>Cluster 2 ({{ $segmentLabels[2] ?? '' }}): $ {{ number_format($avgSpend[2] ?? 0) }}</li>
        </ul>
    </div>

    <!-- Pie Chart -->
    <div class="bg-white p-6 rounded shadow mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Customer Segment Distribution</h3>
        <canvas id="segmentChart" height="120"></canvas>
    </div>

    <!-- Filter + Table -->
    <div class="bg-white p-6 rounded shadow mb-6">
        <div class="flex justify-between items-center mb-4">
            <form method="GET">
                <label for="cluster" class="mr-2 text-sm text-gray-700">Filter by Cluster:</label>
                <select name="cluster" id="cluster" onchange="this.form.submit()" class="border rounded p-1 text-sm">
                    <option value="">All</option>
                    <option value="0" {{ $cluster === "0" ? 'selected' : '' }}>Cluster 0</option>
                    <option value="1" {{ $cluster === "1" ? 'selected' : '' }}>Cluster 1</option>
                    <option value="2" {{ $cluster === "2" ? 'selected' : '' }}>Cluster 2</option>
                </select>
            </form>
            @if (session('success'))
                <span class="text-green-600 text-sm">{{ session('success') }}</span>
            @endif
        </div>

        <table class="min-w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2 text-left">Customer ID</th>
                    <th class="border px-3 py-2 text-left">Order Amount</th>
                    <th class="border px-3 py-2 text-left">Order Count</th>
                    <th class="border px-3 py-2 text-left">Cluster & Recommendation</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $actions = [
                        0 => 'Offer low-budget bundles',
                        1 => 'Send loyalty rewards',
                        2 => 'Promote premium packages'
                    ];
                @endphp
                @foreach ($segments as $segment)
                <tr class="hover:bg-gray-50">
                    <td class="border px-3 py-2">{{ $segment->customer_id }}</td>
                    <td class="border px-3 py-2">{{ $segment->order_amount }}</td>
                    <td class="border px-3 py-2">{{ $segment->order_count }}</td>
                    <td class="border px-3 py-2">
                        Cluster {{ $segment->cluster }} ({{ $segmentLabels[$segment->cluster] ?? 'Unknown' }})
                        <br>
                        <span class="text-gray-500 italic">Action: {{ $actions[$segment->cluster] ?? 'N/A' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $segments->links() }}
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="bg-white p-4 rounded shadow flex justify-between items-center gap-4">
        <form method="POST" action="{{ route('admin.send.promo', 2) }}">
            @csrf
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                ✉️ Email Promo to High Spenders (Cluster 2)
            </button>
        </form>

        <form method="POST" action="{{ route('admin.refresh.segments') }}">
            @csrf
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                🔁 Refresh Segments (Run ML)
            </button>
        </form>
    </div>
</div>

<!-- Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('segmentChart');
new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Cluster 0', 'Cluster 1', 'Cluster 2'],
        datasets: [{
            label: 'Customers per Segment',
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
            title: {
                display: true,
                text: 'Customer Segments by Cluster'
            }
        }
    }
});
</script>
@endsection
