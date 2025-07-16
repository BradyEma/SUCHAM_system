<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RetailerOrder;
use Illuminate\Support\Facades\Auth;

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
     
        $user = Auth::user();
    return view('dashboard.retailer-orders', compact('orders', 'user'));

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


}
