<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('goldenfields.ico') }}" type="image/x-icon">
</head>
<body class="bg-gray-100 py-10 px-4">

<div class="max-w-6xl mx-auto bg-white shadow rounded-lg p-6">

    <div class="mb-6">
         <a href="{{ route('customer.orders') }}" class="flex items-center text-primary-600 hover:text-primary-700 mb-5">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Orders
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
        <h3 class="text-2xl font-bold mb-0 text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-emerald-600 flex items-center">My Information</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600">
            <div><strong>Name:</strong> {{ $orderItems->first()->customer->name ?? 'N/A' }}</div>
            <div><strong>Email:</strong> {{ $orderItems->first()->customer->email ?? 'N/A' }}</div>
            @if(!empty($orderItems->first()->customer->phone))
                <div><strong>Phone:</strong> {{ $orderItems->first()->customer->phone }}</div>
            @endif
        </div>
    </div>

    <div class="mb-8">
    <h3 class="text-2xl font-bold mb-0 text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-emerald-600 flex items-center -ml-8">
    <span class="mr-3">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
    </span>
    Retailer Information
    <span class="ml-3 text-green-400 animate-pulse">✦</span>
</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600">
        <div><strong>Business Name:</strong> {{ $retailer->business_name ?? 'N/A' }}</div>
        <div><strong>Location:</strong> {{ $retailer->location ?? 'N/A' }}</div>
        <div><strong>Contact Number:</strong> {{ $retailer->contact_number ?? 'N/A' }}</div>
        <div><strong>Email:</strong> {{ $retailer->user->email ?? 'N/A' }}</div>
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
  

</div>

</body>
</html>
