<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsReceived;
use App\Models\PurchaseOrder;

class GoodsReceivedController extends Controller
{
    public function index()
    {
        $receipts = GoodsReceived::with('purchaseOrder')->get();
        return view('goods_received.index', compact('receipts'));
    }

    public function create()
    {
        $orders = PurchaseOrder::where('status', 'sent')->get();
        return view('goods_received.create', compact('orders'));
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
