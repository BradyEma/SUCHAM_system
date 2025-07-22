<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsReceived;
use App\Models\PurchaseOrder;

class GoodsReceivedController extends Controller
{public function index()
{
    // Fetch all goods received records along with their related supplier and purchase order
    $receipts = GoodsReceived::with(['supplier', 'purchaseOrder'])->paginate(10);

    // Return the view with the data
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
        GoodsReceived::create($request->all());

        $order = PurchaseOrder::find($request->purchase_order_id);
        $order->update(['status' => 'received']);

        return redirect()->route('goods-received.index')->with('success', 'Goods marked as received');
    }

    public function destroy($id)
    {
        GoodsReceived::findOrFail($id)->delete();
        return back()->with('success', 'Deleted');
    }
}
