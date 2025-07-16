<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Retailer Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
</head>
<body class="bg-gray-100 py-10 px-4">

<div class="max-w-6xl mx-auto bg-white shadow rounded-lg p-6">

    <div class="mb-6">
         <a href="{{ route('retailer.orders') }}" class="flex items-center text-primary-600 hover:text-primary-700 mb-5">
                        <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                    </a>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">
            <i class="fas fa-receipt text-primary-600 mr-2"></i> Order Details
        </h2>
        <p class="text-sm text-gray-500">Transaction ID:
            <span class="font-medium text-blue-700">
                #{{ $transactionId }}
            </span>
        </p>
        <p class="text-sm text-gray-500">
            Order Date: {{ $orderItems->first()->created_at->format('M d, Y h:i A') }}
        </p>
    </div>

    <div class="mb-8">
        <h3 class="text-md font-semibold text-gray-700 mb-3">Customer Information</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600">
            <div><strong>Name:</strong> {{ $orderItems->first()->customer->name ?? 'N/A' }}</div>
            <div><strong>Email:</strong> {{ $orderItems->first()->customer->email ?? 'N/A' }}</div>
            @if(!empty($orderItems->first()->customer->phone))
                <div><strong>Phone:</strong> {{ $orderItems->first()->customer->phone }}</div>
            @endif
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Product Image</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Product ID</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($orderItems as $item)
                <tr>
                    <td class="px-4 py-3">
                        <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_name }}" class="w-12 h-12 rounded object-cover">
                    </td>
                    <td class="px-4 py-3 text-gray-700">#{{ $item->product_id }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $item->product_name }}</td>
                    <td class="px-4 py-3">{{ $item->quantity }}</td>
                    <td class="px-4 py-3">UGX {{ number_format($item->price) }}</td>
                    <td class="px-4 py-3 font-semibold">UGX {{ number_format($item->total) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end text-sm text-gray-600">
        <div class="bg-gray-50 p-4 rounded shadow-sm w-full sm:w-1/3">
            <div class="flex justify-between mb-2">
                <span>Subtotal:</span>
                <span>UGX {{ number_format($orderItems->sum('total')) }}</span>
            </div>
            <div class="flex justify-between font-semibold text-blue-700">
                <span>Total:</span>
                <span>UGX {{ number_format($orderItems->sum('total')) }}</span>
            </div>
        </div>
    </div>
  @if($orderItems->first()->status === 'pending')
    <form action="{{ route('retailer.orders.complete', $transactionId) }}" method="POST" class="mt-4">
    @csrf
    <button type="submit"
        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
        Complete to Delivery
    </button>
</form>
@endif

</div>

</body>
</html>
