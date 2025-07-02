<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $item->product_name }} | Goldenfields</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-5xl mx-auto">
        <!-- Header with golden accent -->
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">
                <span class="bg-gradient-to-r from-yellow-500 to-yellow-400 bg-clip-text text-transparent">Product Details</span>
            </h1>
            <a href="{{ route('admin.inventory.index') }}" class="flex items-center text-gray-600 hover:text-yellow-600 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Inventory
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Golden top border -->
            <div class="h-1 bg-gradient-to-r from-yellow-400 to-yellow-300"></div>
            
            <div class="md:flex">
                <!-- Product Image Section -->
                <div class="md:w-1/3 p-6 border-b md:border-b-0 md:border-r border-gray-100 flex items-center justify-center bg-gray-50">
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $item->product_image) }}" alt="{{ $item->product_name }}" 
                             class="w-full max-w-xs h-64 object-contain rounded-lg shadow-sm transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-yellow-500 opacity-0 group-hover:opacity-10 rounded-lg transition-opacity duration-300"></div>
                    </div>
                </div>

                <!-- Product Details Section -->
                <div class="md:w-2/3 p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $item->product_name }}</h2>
                        <p class="text-gray-600">{{ $item->product_description }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100">
                                <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1">SKU</p>
                                <p class="text-gray-900 font-medium">{{ $item->SKU }}</p>
                            </div>

                            <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100">
                                <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1">Current Stock</p>
                                <p class="text-gray-900 font-medium flex items-center">
                                    <span class="w-3 h-3 rounded-full mr-2 
                                        {{ $item->quantity > $item->minimum_stock_level ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                    {{ $item->quantity }}
                                </p>
                            </div>

                            <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100">
                                <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1">Unit Price</p>
                                <p class="text-gray-900 font-medium">UGX {{ number_format($item->unit_price) }}</p>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100">
                                <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1">Total Value</p>
                                <p class="text-gray-900 font-medium">UGX {{ number_format($item->unit_price * $item->quantity) }}</p>
                            </div>

                            <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100">
                                <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1">Reorder Level</p>
                                <p class="text-gray-900 font-medium">{{ $item->minimum_stock_level }}</p>
                            </div>

                            <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100">
                                <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1">Unit of Measurement</p>
                                <p class="text-gray-900 font-medium">{{ $item->unit_of_measurement }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Supplier Info -->
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Supplier Information</h3>
                        <div class="flex items-center">
                            <div class="bg-yellow-100 p-3 rounded-full mr-4">
                                <i class="fas fa-user-tie text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $item->supplier_email }}</p>
                                <p class="text-sm text-gray-500">Primary contact</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Golden bottom border -->
            <div class="h-1 bg-gradient-to-r from-yellow-300 to-yellow-400"></div>
        </div>
    </div>
</body>
</html>