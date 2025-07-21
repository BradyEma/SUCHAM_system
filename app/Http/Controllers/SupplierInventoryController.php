<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierInventory;
use Illuminate\Http\Request;
use App\Models\Product; // ✅ Add this line

class SupplierInventoryController extends Controller
{
public function index()
{
    $products = SupplierInventory::orderBy('created_at', 'desc')->paginate(10);

    $allProducts = SupplierInventory::all();
    $totalProducts = $allProducts->count();
    $inStock = $allProducts->where('quantity', '>', 10)->count();
    $lowStock = $allProducts->where('quantity', '>', 0)->where('quantity', '<=', 10)->count();
    $outOfStock = $allProducts->where('quantity', '<=', 0)->count();

    return view('supplier_inventory.index', compact(
        'products',
        'totalProducts',
        'inStock',
        'lowStock',
        'outOfStock'
    ));
}



    public function create()
    {
        $suppliers = Supplier::all();
        return view('supplier_inventory.create', compact('suppliers'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'product_name' => 'required|string',
        'product_id' => 'required|string|unique:supplier_inventories,product_id',
        'quantity' => 'required|integer|min:0',
        'unit_price' => 'required|numeric',
        'unit_of_measurement' => 'required|string',
    ]);

    SupplierInventory::create([
        'product_name' => $validated['product_name'],
        'product_id' => $validated['product_id'],
        'quantity' => $validated['quantity'],
        'unit_price' => $validated['unit_price'],
        'unit_of_measurement' => $validated['unit_of_measurement'],
    ]);

    return redirect()->route('supplier_inventory.index')
                     ->with('success', 'Inventory added successfully.');
}
    public function show($id)
    {
        $product = SupplierInventory::findOrFail($id);
        return view('supplier_inventory.show', compact('product'));
    }

    public function edit($id)
    {
        $product = SupplierInventory::findOrFail($id);
        return view('supplier_inventory.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_name' => 'required|string',
            'product_id' => 'required|string|unique:supplier_inventories,product_id,' . $id,
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric',
            'unit_of_measurement' => 'required|string',
        ]);

        $product = SupplierInventory::findOrFail($id);
        $product->update($validated);

        return redirect()->route('supplier_inventory.index')
                         ->with('success', 'Inventory updated successfully.');
    }

    public function destroy($id)
    {
        $product = SupplierInventory::findOrFail($id);
        $product->delete();

        return redirect()->route('supplier_inventory.index')
                         ->with('success', 'Inventory deleted successfully.');
    }
}
