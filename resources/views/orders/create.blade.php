@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 flex items-center justify-center px-4">
    <div class="bg-white w-full max-w-2xl rounded-xl shadow-xl p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">📦 Create New Order</h2>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer ID</label>
                <input type="number" name="customer_id" id="customer_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="product" class="block text-sm font-medium text-gray-700">Product</label>
                <input type="text" name="product" id="product" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity (kg)</label>
                <input type="number" name="quantity" id="quantity" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="order_date" class="block text-sm font-medium text-gray-700">Order Date</label>
                <input type="date" name="order_date" id="order_date" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="pending">Pending</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                    <p style="font-weight: bold; color: black; text-transform: uppercase;"
                    onmouseover="this.style.color='blue'" 
                    onmouseout="this.style.color='black'">
                        Save Order</p>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Order</h2>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <input class="form-control mb-2" name="customer_id" placeholder="Customer ID" required>
        <input class="form-control mb-2" name="product" placeholder="Product" required>
        <input class="form-control mb-2" name="quantity" placeholder="Quantity" type="number" required>
        <input class="form-control mb-2" name="order_date" placeholder="Order Date" type="date" required>
        <select class="form-control mb-2" name="status">
            <option value="pending">Pending</option>
            <option value="shipped">Shipped</option>
            <option value="delivered">Delivered</option>
        </select>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection --}}
