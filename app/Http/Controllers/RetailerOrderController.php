<?php

namespace App\Http\Controllers;

use App\Models\RetailerOrder;
use App\Models\RetailerOrderItem;
use App\Models\RetailerInventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetailerOrderController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        // Other stats
        $pendingOrders = RetailerOrder::where('retailer_id', $user->id)
                            ->where('order_status', 'Pending')
                            ->count();

        $processedToday = RetailerOrder::where('retailer_id', $user->id)
                            ->where('order_status', 'Processed')
                            ->whereDate('order_date', today())
                            ->count();

        $todaysRevenue = RetailerOrder::where('retailer_id', $user->id)
                            ->where('order_status', 'Processed')
                            ->whereDate('order_date', today())
                            ->sum('total_amount');

        // Low stock count from retailer_inventory table
        $lowStockItems = RetailerInventory::where('stock', '<=', 10)->count();

        // Fetch orders for pagination
        $orders = RetailerOrder::where('retailer_id', $user->id)
                    ->latest()
                    ->paginate(10);

        // Pass all to the view
        return view('retailer_orders.index', compact(
            'user',
            'pendingOrders',
            'processedToday',
            'todaysRevenue',
            'lowStockItems',
            'orders'
        ));
    }

    public function create()
    {
        $availableProducts = Product::all(); // Or from wholesaler
        return view('retailer_orders.create', compact('availableProducts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|integer|min:1',
        ]);

        $total = 0;
        foreach ($request->product_id as $index => $productId) {
            $product = Product::find($productId);
            $subtotal = $product->price * $request->quantity[$index];
            $total += $subtotal;
        }

        $order = RetailerOrder::create([
            'retailer_id' => Auth::id(),
            'wholesaler_id' => 1, // TODO: replace with real wholesaler logic
            'order_status' => 'Pending',
            'order_date' => now(),
            'total_amount' => $total,
        ]);

        foreach ($request->product_id as $index => $productId) {
            $product = Product::find($productId);
            RetailerOrderItem::create([
                'retailer_order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $request->quantity[$index],
                'price_per_unit' => $product->price,
                'subtotal' => $product->price * $request->quantity[$index],
            ]);
        }

        return redirect()->route('retailer_orders.index')->with('success', 'Order placed!');
    }

    public function show(RetailerOrder $retailerOrder)
    {
        return view('retailer_orders.show', compact('retailerOrder'));
    }

    public function destroy(RetailerOrder $retailerOrder)
    {
        $retailerOrder->delete();
        return back()->with('success', 'Order cancelled');
    }
}
