@extends('layouts.app')

@section('content')
<div class="bg-green-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Green Header Section -->
        <div class="bg-green-600 rounded-lg shadow-md mb-8 p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-white">Goods Received Details</h1>
                    <p class="text-green-100 mt-1">Manage and track all incoming goods</p>
                </div>
                <a href="{{ route('goods-received.create') }}" 
                   class="bg-white hover:bg-green-50 text-green-600 px-4 py-2 rounded-md flex items-center gap-2 transition-colors font-medium">
                    <i class="fas fa-plus"></i>
                    <span>Create GRN</span>
                </a>
            </div>
        </div>

        <!-- Recent Goods Received Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-green-200">
            <div class="flex justify-between items-center p-6 border-b border-green-100 bg-green-50">
                <h2 class="text-lg font-semibold text-green-800">Recent Goods Received</h2>
                <div class="flex gap-3">
                    <div class="relative">
                        <input type="text" placeholder="Search..." class="pl-8 pr-4 py-2 border border-green-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-white text-green-800 placeholder-green-400">
                        <i class="fas fa-search absolute left-3 top-3 text-green-500"></i>
                    </div>
                    
                </div>
            </div>
            
            @foreach ($receipts as $goods)
            <div class="flex items-center gap-4 p-6 hover:bg-green-50 transition-colors border-b border-green-100 last:border-0">
                <div class="w-12 h-12 rounded bg-green-100 flex items-center justify-center text-green-600">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <h4 class="font-medium text-green-900">{{ $goods->item_name ?? 'Unknown Item' }}</h4>
                        <span class="text-xs px-2 py-1 rounded-full 
                            {{ $goods->status == 'Damaged' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($goods->status) }}
                        </span>
                    </div>
                    <p class="text-sm text-green-700 mt-1">
                        Supplier: {{ $goods->supplier->name ?? 'N/A' }} | 
                        Qty: {{ $goods->quantity }} {{ $goods->unit ?? '' }}
                    </p>
                    <div class="flex items-center gap-3 mt-2">
                        <p class="text-xs text-green-600">GRN #{{ $goods->grn_number }}</p>
                        <p class="text-xs text-green-600">PO #{{ $goods->purchaseOrder->po_number ?? 'N/A' }}</p>
                        <p class="text-xs text-green-600">Received: {{ \Carbon\Carbon::parse($goods->created_at)->format('d-M-Y') }}</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('goods-received.show', $goods->id) }}" class="text-green-600 hover:text-green-800" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('goods-received.print', $goods->id) }}" class="text-green-500 hover:text-green-700" title="Print">
                        <i class="fas fa-print"></i>
                    </a>
                    <button class="text-green-600 hover:text-green-800" title="More options">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>
            @endforeach
            
            <div class="p-4 border-t border-green-100 flex justify-between items-center bg-green-50">
                <div class="text-sm text-green-700">
                    Showing {{ $receipts->firstItem() }} to {{ $receipts->lastItem() }} of {{ $receipts->total() }} entries
                </div>
                <div>
                    {{ $receipts->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .fa-box-open, .fa-tractor, .fa-spray-can {
        font-size: 1.25rem;
    }
    .pagination .page-item.active .page-link {
        background-color: #059669; /* green-600 */
        border-color: #059669;
        color: white;
    }
    .pagination .page-link {
        color: #059669; /* green-600 */
    }
    .pagination .page-item.disabled .page-link {
        color: #9CA3AF; /* gray-400 */
    }
</style>
@endpush