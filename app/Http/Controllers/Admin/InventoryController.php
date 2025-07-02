<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Supplier;

class InventoryController extends Controller
{
   public function index()
{
    // Use paginate instead of all()
    $items = Inventory::paginate(10); // change 10 to how many items per page you want
    $totalItems = Inventory::count(); // count from DB directly

    $lowStockItems = Inventory::where('quantity', '<', 10)->count();

    $totalValue = Inventory::sum(\DB::raw('quantity * unit_price')); // avoid loading all items in memory

    return view('admin.inventory.index', [
        'items' => $items,
        'totalItems' => $totalItems,
        'lowStockItems' => $lowStockItems,
        'totalValue' => $totalValue,
    ]);
}
   public function show($id)
{
    $item = Inventory::findOrFail($id);
    return view('admin.inventory.show', compact('item'));
}

   public function create()
{
    $suppliers = Supplier::where('status', 'active')
    ->whereHas('user', function ($query) {
        $query->where('role', 'supplier');
    })
    ->with('user')
    ->get();



   return view('admin.inventory.create', compact('suppliers'));

}

    public function store(Request $request)
{
    $validated = $request->validate([
        'product_name' => 'required',
        'quantity' => 'required|integer|min:0',
        
        'unit_price' => 'nullable|numeric|min:0',
        'sku' => 'nullable|string',
        'minimum_stock_level' => 'nullable|integer|min:0',
        'supplier_email' => 'nullable|email',
        'product_description' => 'nullable|string',
        'unit_of_measurement' => 'nullable|string',
        'product_image' => 'nullable|image|max:5120',
    ]);

    // Handle the image upload
    if ($request->hasFile('product_image')) {
        $path = $request->file('product_image')->store('product_images', 'public');
        $validated['product_image'] = $path;
    }

    // Create inventory item
    Inventory::create($validated);

    return redirect()->route('admin.inventory.index')->with('success', 'Item added!');
}


    public function edit($id)
    {
        $item = Inventory::findOrFail($id);
        return view('admin.inventory.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Inventory::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('admin.inventory.index')->with('success', 'Item updated!');
    }

    public function destroy($id)
    {
        Inventory::destroy($id);
        return redirect()->route('admin.inventory.index')->with('success', 'Item deleted!');
    }

    
}

