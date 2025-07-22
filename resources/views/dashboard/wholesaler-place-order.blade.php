<!-- resources/views/dashboard/wholesaler-place-order.blade.php -->
@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
   {{--   @include('partials.sidebar-wholesaler')--}} <!-- Wholesaler sidebar -->

    <main class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Place New Sugar Order</h1>

            <form action="{{ route('wholesaler.orders.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white p-4 rounded-lg shadow border">
                           

                            <h2 class="text-lg font-semibold text-gray-700">{{ $product->name }}</h2>
                           

                            <div class="mt-4">
                                <label for="quantity_{{ $product->id }}" class="block text-sm font-medium text-gray-600">Quantity</label>
                                <input type="number" name="quantities[{{ $product->id }}]" id="quantity_{{ $product->id }}"
                                       class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring focus:border-blue-300"
                                       min="1" placeholder="Enter quantity">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg">
                        Submit Order
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
