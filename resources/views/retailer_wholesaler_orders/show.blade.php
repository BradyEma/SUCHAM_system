<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - GoldenFields</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gold-gradient {
            background: linear-gradient(135deg, #FFD700 0%, #D4AF37 100%);
        }
        .green-gradient {
            background: linear-gradient(135deg, #006400 0%, #228B22 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-gradient-to-r from-yellow-400 to-yellow-500 shadow-md">
            <div class="container mx-auto px-4 py-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-green-800">
                        Order #{{ $order->id }}
                    </h1>
                    <a href="{{ route('retailer_orders.index') }}" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg flex items-center transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to Orders
                    </a>
                </div>
            </div>
        </header>

        <!-- Order Details -->
        <main class="container mx-auto px-4 py-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
                <!-- Order Status -->
                <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-white">Order Details</h2>
                    <span class="px-4 py-2 rounded-full text-sm font-bold 
                        {{ $order->order_status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $order->order_status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $order->order_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $order->order_status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>

                <!-- Order Summary -->
                <div class="p-6 border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <h3 class="text-green-800 font-medium mb-2">Retailer Information</h3>
                            <p class="text-gray-700">{{ $order->retailer->business_name }}</p>
                            <p class="text-gray-700">{{ $order->retailer->email }}</p>
                        </div>
                        <div>
                            <h3 class="text-green-800 font-medium mb-2">Wholesaler</h3>
                            <p class="text-gray-700">{{ $order->wholesaler->business_name }}</p>
                        </div>
                        <div>
                            <h3 class="text-green-800 font-medium mb-2">Order Dates</h3>
                            <p class="text-gray-700"><strong>Ordered:</strong> {{ $order->order_date->format('M d, Y') }}</p>
                            <p class="text-gray-700"><strong>Delivery:</strong> {{ $order->delivery_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-green-800 font-medium mb-4">Order Items</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Product</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Price</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Qty</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-green-800 uppercase">Total</th>
                                </tr>
                            </thead>
                            <!-- In your show.blade.php -->
<tbody class="divide-y divide-gray-200">
    @foreach($order->items as $item)
    <tr>
        <td class="px-4 py-3 whitespace-nowrap">{{ $item->name }}</td>
        <td class="px-4 py-3 whitespace-nowrap">Ugshs {{ number_format($item->price, 2) }}</td>
        <td class="px-4 py-3 whitespace-nowrap">
            {{ number_format($item->quantity, 2) }} {{ $item->unit }}
        </td>
        <td class="px-4 py-3 whitespace-nowrap">Ugshs {{ number_format($item->price * $item->quantity, 2) }}</td>
    </tr>
    @endforeach
</tbody>
                            <tfoot class="bg-green-50 font-bold">
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-right">Subtotal:</td>
                                    <td class="px-4 py-3">Ugshs {{ number_format($order->total_amount / 1.1, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-right">Tax (10%):</td>
                                    <td class="px-4 py-3">Ugshs {{ number_format($order->total_amount * 0.1, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-right text-green-800">Grand Total:</td>
                                    <td class="px-4 py-3 text-green-800">Ugshs {{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Delivery Information -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-green-800 font-medium mb-2">Delivery Address</h3>
                            <p class="text-gray-700">
                                @if($order->delivery_address === 'main_store')
                                    123 Farm Rd, Golden Valley
                                @else
                                    456 Harvest Ave, Greenfield
                                @endif
                            </p>
                        </div>
                        <div>
                            <h3 class="text-green-800 font-medium mb-2">Notes</h3>
                            <p class="text-gray-700">{{ $order->notes ?? 'No special instructions' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>