<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supplier Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-white text-gray-800">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-green-700 mb-6">Supplier Inventory Overview</h1>

        <a href="{{ route('supplier_inventory.create') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
            + Add Inventory
        </a>

        <div class="overflow-x-auto mt-6">
            <table class="min-w-full bg-white border border-green-300 shadow-md">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Supplier</th>
                        <th class="py-3 px-4 text-left">Product</th>
                        <th class="py-3 px-4 text-left">Quantity</th>
                        <th class="py-3 px-4 text-left">Unit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $item)
                        <tr class="border-b hover:bg-green-50">
                            <td class="py-2 px-4">{{ $item->supplier->business_name ?? 'N/A' }}</td>
                            <td class="py-2 px-4">{{ $item->product_name }}</td>
                            <td class="py-2 px-4">{{ $item->quantity }}</td>
                            <td class="py-2 px-4">{{ $item->unit }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-10">
            <canvas id="inventoryChart" class="w-full h-96"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('inventoryChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($inventories->pluck('product_name')),
                datasets: [{
                    label: 'Inventory Quantities',
                    data: @json($inventories->pluck('quantity')),
                    backgroundColor: 'rgba(255, 215, 0, 0.8)',
                    borderColor: 'rgba(34, 139, 34, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
