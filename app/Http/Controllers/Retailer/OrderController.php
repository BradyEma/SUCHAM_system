<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RetailerOrder;
use Illuminate\Support\Facades\Auth;
use App\Models\RetailerInventory;



class OrderController extends Controller
{
 public function index()
{
    $retailerId = Auth::user()->retailer->id ?? null;

    $orders = RetailerOrder::with('customer')
        ->where('retailer_id', $retailerId)
        ->latest()
        ->get()
        ->groupBy('transaction_id');

    $totalOrders = RetailerOrder::where('retailer_id', $retailerId)
        ->distinct('transaction_id')
        ->count('transaction_id');

    // ✅ Count pending orders
    $pendingOrders = RetailerOrder::where('retailer_id', $retailerId)
        ->where('status', 'pending')
        ->distinct('transaction_id')
        ->count('transaction_id');

   $completedOrders = RetailerOrder::where('retailer_id', $retailerId)
    ->where('status', 'completed')
    ->distinct('transaction_id')
    ->count('transaction_id');

    $cancelledOrders = RetailerOrder::where('retailer_id', $retailerId)
    ->where('status', 'cancelled')
    ->distinct('transaction_id')
    ->count('transaction_id');
   
    $deliveryOrders = RetailerOrder::where('retailer_id', $retailerId)
    ->where('status', 'on delivery')
    ->distinct('transaction_id')
    ->count('transaction_id');

    $user = Auth::user();

return view('dashboard.retailer-orders', compact('orders', 'user', 'totalOrders', 'pendingOrders', 'completedOrders', 'cancelledOrders', 'deliveryOrders'));
}



public function show($transactionId)
{
    $orderItems = \App\Models\RetailerOrder::where('transaction_id', $transactionId)->get();

    if ($orderItems->isEmpty()) {
        abort(404, 'Order not found.');
    }

    return view('dashboard.retailer-order-details', [
        'orderItems' => $orderItems,
        'transactionId' => $transactionId
    ]);
}

public function markAsOnDelivery($transactionId)
{
    $orderItems = RetailerOrder::where('transaction_id', $transactionId)->get();

    if ($orderItems->isEmpty()) {
        return redirect()->back()->with('error', 'Order not found.');
    }

    foreach ($orderItems as $item) {
        // 1. Update order status
        $item->status = 'on delivery';
        $item->save();

        // 2. Deduct quantity from inventory
        $inventory = RetailerInventory::where('retailer_id', $item->retailer_id)
            ->where('product_name', $item->product_name)
            ->first();

        if ($inventory) {
            $inventory->quantity -= $item->quantity;
            $inventory->quantity = max($inventory->quantity, 0); // prevent negative
            $inventory->save();
        }
    }

    return redirect('/retailer/orders')->with('success', 'Order signed off to delivery.');
}

public function markAsCompleted($transactionId)
{
    $orderItems = RetailerOrder::where('transaction_id', $transactionId)->get();

    if ($orderItems->isEmpty()) {
        return redirect()->back()->with('error', 'Order not found.');
    }

    foreach ($orderItems as $item) {
        $item->status = 'completed';
        $item->save();
    }

   return redirect('/retailer/orders')->with('success', 'Order marked as Completed.');

}


}
