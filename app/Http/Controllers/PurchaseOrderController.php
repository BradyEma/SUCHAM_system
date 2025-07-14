<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        // Fetch purchase orders without vendor relationship
        $purchaseOrders = PurchaseOrder::orderBy('created_at', 'desc')
            ->paginate(10); // 10 items per page
        
        // Pass the variable to the view
        return view('purchase_orders.index', compact('purchaseOrders'));
    }
    
    /**
     * Show the form for creating a new purchase order.
     */
    public function create()
    {
        return view('purchase_orders.create');
    }
    
    /**
     * Store a newly created purchase order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,rejected',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        
        // Generate PO number (you can customize this logic)
        $poNumber = 'PO-' . date('Y') . '-' . str_pad(PurchaseOrder::count() + 1, 4, '0', STR_PAD_LEFT);
        
        $purchaseOrder = PurchaseOrder::create([
            'po_number' => $poNumber,
            'supplier_name' => $validated['supplier_name'],
            'order_date' => $validated['order_date'],
            'total_amount' => $validated['total_amount'],
            'status' => $validated['status'],
            'description' => $validated['description'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);
        
        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase order created successfully.');
    }
    
    /**
     * Display the specified purchase order.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        return view('purchase_orders.show', compact('purchaseOrder'));
    }
    
    /**
     * Show the form for editing the specified purchase order.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        return view('purchase_orders.edit', compact('purchaseOrder'));
    }
    
    /**
     * Update the specified purchase order in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,rejected',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        
        $purchaseOrder->update($validated);
        
        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase order updated successfully.');
    }
    
    /**
     * Remove the specified purchase order from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        
        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase order deleted successfully.');
    }
}