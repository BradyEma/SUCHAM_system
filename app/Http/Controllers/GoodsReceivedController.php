<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsReceived;
use App\Models\PurchaseOrder;

class GoodsReceivedController extends Controller
{
    public function index()
    {
        // Fetch all goods received records along with their related supplier and purchase order
        $receipts = GoodsReceived::with(['supplier', 'purchaseOrder'])->paginate(10);
        return view('goods_received.index', compact('receipts'));
    }

    public function create()
    {
        // Only get 'sent' orders and include their suppliers
        $purchaseOrders = PurchaseOrder::where('status', 'sent')->with('supplier')->get();
        return view('goods_received.create', compact('purchaseOrders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'received_date' => 'required|date',
            'delivered_at' => 'nullable|date',
            'items' => 'required|array',
            'items.*.purchase_order_item_id' => 'required|exists:purchase_order_items,id',
            'items.*.quantity_received' => 'required|numeric|min:0',
        ]);

        foreach ($validated['items'] as $item) {
            GoodsReceived::create([
                'purchase_order_item_id' => $item['purchase_order_item_id'],
                'quantity_received' => $item['quantity_received'],
                'received_date' => $validated['received_date'],
                'delivered_at' => $request->delivered_at,
                'purchase_order_reference' => $request->purchase_order_id, // or real reference string
            ]);
        }

        return redirect()->route('goods-received.index')->with('success', 'Goods received saved successfully.');
    }

    public function destroy($id)
    {
        GoodsReceived::findOrFail($id)->delete();
        return back()->with('success', 'Deleted');
    }
}
