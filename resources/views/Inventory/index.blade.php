@extends('layouts.app')

@section('content')
<div class="py-12 px-6">
    <h2 class="text-2xl font-bold text-sky-600 mb-4">Inventory List</h2>

    @if(session('success'))
        <p class="text-green-600">{{ session('success') }}</p>
    @endif

    <a href="{{ route('inventory.create') }}" class="bg-sky-600 hover:bg-sky-700 text-white py-2 px-4 rounded mb-4 inline-block">+ Add Item</a>
    <a href="{{ route('inventory.export.pdf') }}" class="bg-black text-white px-4 py-2 rounded">Export PDF</a>

    @if($lowStock->count())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <strong>⚠ Low Stock:</strong>
            <ul>
                @foreach($lowStock as $item)
                    <li>{{ $item->item_name }} - {{ $item->quantity }} {{ $item->unit }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="w-full table-auto bg-white shadow-md rounded">
        <thead>
            <tr class="bg-sky-200 text-black">
                <th class="p-2">Item</th>
                <th class="p-2">Quantity</th>
                <th class="p-2">Category</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr class="border-b hover:bg-gray-100">
                <td class="p-2">{{ $item->item_name }}</td>
                <td class="p-2">{{ $item->quantity }}
                    @if($item->quantity < 10)
                        <span class="text-red-600 font-semibold">(Low!)</span>
                    @endif
                </td>
                <td class="p-2">{{ $item->category }}</td>
                <td class="p-2">
                    <a href="{{ route('inventory.edit', $item->id) }}" class="text-sky-700">Edit</a>
                    <form method="POST" action="{{ route('inventory.destroy', $item->id) }}" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 ml-2">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<canvas id="inventoryChart" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('inventoryChart').getContext('2d');
    const inventoryChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($items->pluck('item_name')) !!},
            datasets: [{
                label: 'Stock Quantity',
                data: {!! json_encode($items->pluck('quantity')) !!},
                backgroundColor: 'skyblue',
                borderColor: 'black',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

@endsection
