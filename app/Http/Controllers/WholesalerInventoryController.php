<?php

namespace App\Http\Controllers;

use App\Models\WholesalerInventory;
use Illuminate\Http\Request;

class WholesalerInventoryController extends Controller
{
public function index()
{
    $products = WholesalerInventory::orderBy('created_at', 'desc')->paginate(10);

    return view('wholesaler_inventory.index', compact('products'));
}


    public function create()
    {
        return view('wholesaler_inventory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id|unique:wholesaler_inventories,product_id',
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'units' => 'required|in:kg,litres,bags',
            'unit_price' => 'required|numeric|min:0',
            'status' => 'required|in:in_stock,out_of_stock',
        ]);

        WholesalerInventory::create($validated);

        return redirect()->route('wholesaler_inventory.index')->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $inventory = WholesalerInventory::findOrFail($id);
        return view('wholesaler_inventory.edit', compact('inventory'));
    }

    public function update(Request $request, $id)
    {
        $inventory = WholesalerInventory::findOrFail($id);

        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id|unique:wholesaler_inventories,product_id,' . $id,
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'units' => 'required|in:kg,litres,bags',
            'unit_price' => 'required|numeric|min:0',
            'status' => 'required|in:in_stock,out_of_stock',
        ]);

        $inventory->update($validated);

        return redirect()->route('wholesaler_inventory.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $inventory = WholesalerInventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('wholesaler_inventory.index')->with('success', 'Product deleted successfully.');
    }
}
