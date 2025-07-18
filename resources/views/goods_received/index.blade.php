@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-700">Goods Received Details</h1>
            <a href="{{ route('goods-received.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center gap-2 transition-colors">
                <i class="fas fa-plus"></i>
                <span>Create goods received Note</span>
            </a>
        </div>

        <!-- Recent Goods Received Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <div class="flex justify-between items-center p-6 border-b">
                <h2 class="text-lg font-semibold text-green-700">Goods Received</h2>
                <div class="flex gap-3">
                    <div class="relative">
                        <input type="text" placeholder="Search..." class="pl-8 pr-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-500"></i>
                    </div>
                    <button class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-md transition-colors">
                        <i class="fas fa-filter text-gray-600"></i>
                    </button>
                </div>
            </div>
            
            <div class="divide-y divide-gray-200">
                <!-- Item 1 -->
                <div class="flex items-center gap-4 p-6 hover:bg-gray-50 transition-colors">
                    <div class="w-12 h-12 rounded bg-gray-100 flex items-center justify-center text-green-600">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h4 class="font-medium text-gray-700">Packing bags</h4>
                            <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">Completed</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">Supplier: AgroSupplies | Qty: 50 bags</p>
                        <div class="flex items-center gap-3 mt-2">
                            <p class="text-xs text-gray-500">GRN #GRN-2024-001</p>
                            <p class="text-xs text-gray-500">PO #PO-2024-045</p>
                            <p class="text-xs text-gray-500">Received: 15-Jul-2024</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button class="text-green-600 hover:text-green-800">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-print"></i>
                        </button>
                        <button class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Item 2 -->
                <div class="flex items-center gap-4 p-6 hover:bg-gray-50 transition-colors">
                    <div class="w-12 h-12 rounded bg-gray-100 flex items-center justify-center text-green-600">
                        <i class="fas fa-tractor"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h4 class="font-medium text-gray-700">Sugarcane</h4>
                            <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">Completed</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">Supplier: GreenHarvest | Qty: 12 items</p>
                        <div class="flex items-center gap-3 mt-2">
                            <p class="text-xs text-gray-500">GRN #GRN-2024-002</p>
                            <p class="text-xs text-gray-500">PO #PO-2024-046</p>
                            <p class="text-xs text-gray-500">Received: 14-Jul-2024</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button class="text-green-600 hover:text-green-800">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-print"></i>
                        </button>
                        <button class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Item 3 -->
                <div class="flex items-center gap-4 p-6 hover:bg-gray-50 transition-colors">
                    <div class="w-12 h-12 rounded bg-gray-100 flex items-center justify-center text-green-600">
                        <i class="fas fa-spray-can"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h4 class="font-medium text-gray-700">Molasses</h4>
                            <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-800">Damaged</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">Supplier: FieldMasters | Qty: 25 liters</p>
                        <div class="flex items-center gap-3 mt-2">
                            <p class="text-xs text-gray-500">GRN #GRN-2024-003</p>
                            <p class="text-xs text-gray-500">PO #PO-2024-047</p>
                            <p class="text-xs text-gray-500">Received: 12-Jul-2024</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button class="text-green-600 hover:text-green-800">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-print"></i>
                        </button>
                        <button class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="p-4 border-t flex justify-between items-center bg-white">
                <div class="text-sm text-gray-600">
                    Showing 1 to 3 of 15 entries
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1 border rounded-md hover:bg-gray-100 text-gray-600">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-3 py-1 border rounded-md bg-green-600 text-white">
                        1
                    </button>
                    <button class="px-3 py-1 border rounded-md hover:bg-gray-100 text-gray-600">
                        2
                    </button>
                    <button class="px-3 py-1 border rounded-md hover:bg-gray-100 text-gray-600">
                        3
                    </button>
                    <button class="px-3 py-1 border rounded-md hover:bg-gray-100 text-gray-600">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .fa-seedling, .fa-tractor, .fa-spray-can {
        font-size: 1.25rem;
    }
    body {
        background-color: #f9fafb; /* Slightly lighter than bg-gray-50 */
    }
    .header {
        background-color: transparent;
        box-shadow: none;
    }
</style>
@endpush