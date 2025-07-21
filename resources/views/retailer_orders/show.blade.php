@extends('layouts.retailer')

@section('content')
<div class="bg-amber-50 rounded-lg shadow-lg overflow-hidden">
  <!-- Header -->
  <div class="bg-gradient-to-r from-green-700 to-green-800 p-4 text-amber-100">
    <h2 class="text-xl font-bold">Order #{{ $order->id }}</h2>
    <div class="flex justify-between items-center mt-2">
      <span>Placed on: {{ $order->created_at->format('M d, Y') }}</span>
      <span class="px-3 py-1 rounded-full 
        {{ $order->status === 'completed' ? 'bg-green-600' : '' }}
        {{ $order->status === 'pending' ? 'bg-amber-500' : '' }}
        {{ $order->status === 'cancelled' ? 'bg-red-500' : '' }}
      ">
        {{ ucfirst($order->status) }}
      </span>
    </div>
  </div>

  <!-- Order Items -->
  <div class="p-6">
    <table class="w-full">
      <thead class="bg-amber-200 text-green-800">
        <tr>
          <th class="p-2 text-left">Product</th>
          <th class="text-right">Qty</th>
          <th class="text-right">Price</th>
          <th class="text-right">Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->items as $item)
        <tr class="border-b border-amber-100">
          <td class="p-2">{{ $item->product->name }}</td>
          <td class="text-right">{{ $item->quantity }}</td>
          <td class="text-right">${{ number_format($item->price, 2) }}</td>
          <td class="text-right">${{ number_format($item->quantity * $item->price, 2) }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot class="bg-amber-100 font-bold">
        <tr>
          <td colspan="3" class="p-2 text-right">Total:</td>
          <td class="p-2 text-right">${{ number_format($order->total, 2) }}</td>
        </tr>
      </tfoot>
    </table>
  </div>

  <!-- Actions -->
  <div class="bg-amber-100 p-4 flex justify-end space-x-3">
    @if($order->status === 'pending')
      <a 
        href="{{ route('retailer.orders.edit', $order->id) }}" 
        class="bg-amber-500 hover:bg-amber-600 text-green-800 py-2 px-4 rounded"
      >
        Edit Order
      </a>
      <form method="POST" action="{{ route('retailer.orders.cancel', $order->id) }}">
        @csrf
        <button 
          type="submit" 
          class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded"
        >
          Cancel Order
        </button>
      </form>
    @endif
    <a 
      href="{{ route('retailer.orders.index') }}" 
      class="bg-green-700 hover:bg-green-800 text-amber-100 py-2 px-4 rounded"
    >
      Back to Orders
    </a>
  </div>
</div>
@endsection