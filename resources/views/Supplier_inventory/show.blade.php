@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Product Details</h1>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Product Image Section -->
                <div class="flex items-center justify-center bg-gray-100 rounded-lg p-4">
                    <div class="h-48 w-48 bg-white rounded-lg shadow-md flex items-center justify-center">
                        <i class="fas fa-box text-5xl text-green-600"></i>
                    </div>
                </div>
                
                <!-- Product Details Section -->
                <div>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Product Name</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $product->product_name }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Product ID</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $product->product_id }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Quantity</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900">
                                {{ $product->quantity }} 
                                <span class="text-base font-normal">{{ $product->unit_of_measurement }}</span>
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Unit Price</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900">UGX {{ number_format($product->unit_price, 2) }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Status</h3>
                            <p class="mt-1">
                                @if($product->quantity > 20)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> In Stock
                                    </span>
                                @elseif($product->quantity > 0)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> Low Stock
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i> Out of Stock
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex space-x-3">
                        <a href="{{ route('supplier_inventory.edit', $product) }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <i class="fas fa-edit mr-2"></i> Edit Product
                        </a>
                        
                        <a href="{{ route('supplier_inventory.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Inventory
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection