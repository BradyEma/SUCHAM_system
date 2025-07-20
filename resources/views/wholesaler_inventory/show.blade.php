@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-white">
    <h1 class="text-3xl font-bold mb-6">Product Details</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-4">
            <h2 class="text-xl font-semibold">Product Name:</h2>
            <p>{{ $product->product_name }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold">Product ID:</h2>
            <p>{{ $product->product_id }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold">Quantity:</h2>
            <p>{{ $product->quantity }} {{ $product->units }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold">Unit Price:</h2>
            <p>UGX {{ number_format($product->unit_price, 2) }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold">Status:</h2>
            <p>{{ ucfirst(str_replace('_', ' ', $product->status)) }}</p>
        </div>

        <a href="{{ route('wholesaler_inventory.index') }}" class="inline-block mt-4 text-green-600 hover:underline">
            ← Back to Inventory
        </a>
    </div>
</div>
@endsection