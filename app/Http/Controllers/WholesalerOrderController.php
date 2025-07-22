<?php

namespace App\Http\Controllers;

use App\Models\Logistics;
use id;
use App\Models\Wholesaler;
use Illuminate\Http\Request;
use App\Models\WholesalerOrder;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WholesalerOrderController extends Controller
{
    public function index()
    {
        // Fetch orders related to the wholesaler user (adjust the query as needed)
        $orders = WholesalerOrder::where('wholesaler_id', auth()->id())
                       ->orderBy('created_at', 'desc')
                       ->get();

        // Pass the orders collection to the view
        return view('dashboard.wholesaler-orders', [
            'orders' => $orders,
        ]);
    }

    public function store(Request $request)
{
    $wholesalerId = auth()->id();
    $transactionId = strtoupper(uniqid('TXN'));

    foreach ($request->quantities as $productId => $quantity) {
        if ($quantity > 0) {
            $product = Product::find($productId);
            $order = WholesalerOrder::create([
                'wholesaler_id' => $wholesalerId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'total' => $quantity * $product->price,
                'transaction_id' => $transactionId,
                'status' => 'pending',
            ]);

            // You can dispatch a job or event to notify logistics/admin here

            Logistics::create([
                'order_id' => $order->id,
                 'name' => 'Delivery for Order #' . $order->id,
                'status' => 'pending',
                'assigned_to' => null,
                 'created_by' => auth()->id(), 
            ]);
        }
    }

    return redirect()->route('wholesaler.orders')->with('success', 'Order placed successfully and sent to logistics.');
}

public function create()
{
    $products = Product::all();
    return view('dashboard.wholesaler-place-order', compact('products'));
}
    public function show($id)
    {
        $order = WholesalerOrder::findOrFail($id);
        return view('dashboard.wholesaler-order-details', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = WholesalerOrder::findOrFail($id);
        $order->update($request->all());
        return redirect()->route('wholesaler.orders')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = WholesalerOrder::findOrFail($id);
        $order->delete();
        return redirect()->route('wholesaler.orders')->with('success', 'Order deleted successfully.');
    }
}
