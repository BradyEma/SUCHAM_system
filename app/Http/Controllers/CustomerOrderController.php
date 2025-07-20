<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RetailerOrder;  // or your actual model name for orders
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;


class CustomerOrderController extends Controller
{
    // Show list of orders for logged-in customer
  public function index()
{
    $userId = auth()->id();

    $rawOrders = \App\Models\RetailerOrder::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    $groupedOrders = $rawOrders
        ->groupBy(function ($order) {
            return strtolower(trim($order->status));
        })
        ->map(function ($statusGroup) {
            return $statusGroup->groupBy('transaction_id');
        });

    $unreadCount = 0;  // just set to zero

    return view('dashboard.customer-orders', [
        'groupedOrders' => $groupedOrders,
        'user' => auth()->user(),
        'unreadCount' => $unreadCount,
    ]);
}





    // Show detail page for a single order by transaction ID
    public function show($transactionId)
    {
        $user = Auth::user();

        // Fetch all items with this transaction ID belonging to this user
        $orderItems = RetailerOrder::where('transaction_id', $transactionId)
            ->where('user_id', $user->id)
            ->get();

        if ($orderItems->isEmpty()) {
            abort(404, 'Order not found');
        }

        return view('dashboard.customer-orders-details', [
            'orderItems' => $orderItems,
            'transactionId' => $transactionId,
        ]);
    }

   public function cancel(Request $request, $transactionId)
{
    $request->validate([
        'password' => 'required|string',
    ]);

    $user = Auth::user();

    // Check if password is correct
    if (!Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Wrong password. Cancel aborted.');
    }

    // Update ALL orders with the same transaction_id
    RetailerOrder::where('transaction_id', $transactionId)
        ->where('user_id', $user->id) // Optional: ensures customer owns the order
        ->update(['status' => 'cancelled']);

    return redirect()->back()->with('success', 'Order cancelled successfully.');
}
}
