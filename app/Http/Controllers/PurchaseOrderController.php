<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Supplier; // ✅ Moved here correctly
use Illuminate\Http\Request;
use App\Models\PurchaseOrderItem;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::orderBy('created_at', 'desc')->paginate(10);
      
    $approvedCount = PurchaseOrder::where('status', 'approved')->count();
    $pendingCount = PurchaseOrder::where('status', 'pending')->count();
    $rejectedCount = PurchaseOrder::where('status', 'rejected')->count();
    $totalValue = PurchaseOrder::sum('total_cost'); // adjust if you use a different column

    return view('purchase_orders.index', [
        'approvedCount' => $approvedCount,
        'pendingCount' => $pendingCount,
        'rejectedCount' => $rejectedCount,
        'totalValue' => $totalValue
    ])->with('purchaseOrders', $purchaseOrders);
    }

    public function create()
    {
        $suppliers = Supplier::all(); // Now it will work correctly
        return view('purchase_orders.create', compact('suppliers'));
    }


public function store(Request $request)
{
    $validated = $request->validate([
        'supplier_id' => 'required|exists:suppliers,id',
        'order_date' => 'required|date',
        'delivery_date' => 'nullable|date',
        'notes' => 'nullable|string',
        'items' => 'required|array|min:1',
        'items.*.name' => 'required|string|max:255',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.unit_price' => 'required|numeric|min:0',
    ]);

    // Calculate total amount
    $totalAmount = collect($validated['items'])->reduce(function ($carry, $item) {
        return $carry + ($item['quantity'] * $item['unit_price']);
    }, 0);

    // Generate PO number
    $poNumber = 'PO-' . date('Y') . '-' . str_pad(PurchaseOrder::count() + 1, 4, '0', STR_PAD_LEFT);

    // Create the purchase order
    $purchaseOrder = PurchaseOrder::create([
        'po_number' => $poNumber,
        'supplier_id' => $validated['supplier_id'],
        'order_date' => $validated['order_date'],
        'delivery_date' => $validated['delivery_date'] ?? null,
        'notes' => $validated['notes'] ?? null,
        'total_amount' => $totalAmount,
        'status' => 'pending', // default
    ]);

    // Save items
    foreach ($validated['items'] as $item) {
        $purchaseOrder->items()->create([
            'product_name' => $item['product_name'],
            'quantity' => $item['quantity'],
            'unit_price' => $item['unit_price'],
            'total_price' => $item['quantity'] * $item['unit_price'],
        ]);
    }

        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase order created successfully.');
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        return view('purchase_orders.show', compact('purchaseOrder'));
    }

    public function edit(PurchaseOrder $purchaseOrder)
    {
        return view('purchase_orders.edit', compact('purchaseOrder'));
    }

    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            'delivery_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,rejected',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $purchaseOrder->update($validated);

        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase order updated successfully.');
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase order deleted successfully.');
    }

    public function getItems($id)
{
    $po = PurchaseOrder::with('items.product')->findOrFail($id);
    return response()->json($po->items);
}

}
