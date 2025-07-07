<?php
namespace App\Http\Controllers;

use App\Models\RetailerInventory;
use Illuminate\Http\Request;

class RetailerInventoryController extends Controller
{
    public function index()
    {
        $products = RetailerInventory::orderBy('created_at', 'desc')->paginate(10);

        return view('retailer_inventory.index', compact('products'));
    }

    public function create()
    {
        return view('retailer_inventory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string',
            'product_id' => 'required|unique:retailer_inventories',
            'stock' => 'required|integer',
            'unit_price' => 'required|numeric',
            'measurements' => 'required|string',
        ]);

        $validated['status'] = $validated['stock'] <= 10 ? 'low_stock' : 'in_stock';

        RetailerInventory::create($validated);
        return redirect()->route('retailer_inventory.index')->with('success', 'Product added successfully');
    }

    public function edit(RetailerInventory $retailer_inventory)
    {
        return view('retailer_inventory.edit', compact('retailer_inventory'));
    }

    public function update(Request $request, RetailerInventory $retailer_inventory)
    {
        $validated = $request->validate([
            'product_name' => 'required|string',
            'product_id' => 'required|unique:retailer_inventories,product_id,' . $retailer_inventory->id,
            'stock' => 'required|integer',
            'unit_price' => 'required|numeric',
            'measurements' => 'required|string',
        ]);

        $validated['status'] = $validated['stock'] <= 10 ? 'low_stock' : 'in_stock';

        $retailer_inventory->update($validated);
        return redirect()->route('retailer_inventory.index')->with('success', 'Product updated successfully');
    }

    public function destroy(RetailerInventory $retailer_inventory)
    {
        $retailer_inventory->delete();
        return redirect()->route('retailer_inventory.index')->with('success', 'Product deleted');
    }
}
