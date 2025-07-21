<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Supplier;

class InventoryController extends Controller
{
   public function index(Request $request)
{
    $query = Inventory::query();

    if ($request->has('search') && $request->search !== null) {
        $query->where('product_name', 'like', '%' . $request->search . '%');
    }

    $items = $query->latest()->paginate(10);

    // Summary counts based on the filtered query (if you want summary of all or filtered, adjust accordingly)
    $totalItems = $query->count(); 
    $lowStockItems = $query->where('quantity', '<', 10)->count();
    $totalValue = Inventory::sum(DB::raw('quantity * unit_price'));

    return view('admin.inventory.index', compact('items', 'totalItems', 'lowStockItems', 'totalValue'));
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
        'product_image' => 'nullable|image|max:10120',
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
    $inventory = Inventory::findOrFail($id);
    $suppliers = Supplier::with('user')->get();
    return view('admin.inventory.edit', compact('inventory', 'suppliers'));
}


   public function update(Request $request, $id)
{
    $request->validate([
        'product_name' => 'required',
        'quantity' => 'required|integer|min:0',
        'product_image' => 'nullable|image|max:2048',
    ]);

    $inventory = Inventory::findOrFail($id);

    $inventory->fill($request->except('product_image'));

    if ($request->hasFile('product_image')) {
        $path = $request->file('product_image')->store('product_images', 'public');
        $inventory->product_image = $path;
    }

    $inventory->save();

    return redirect()->route('admin.inventory.index')->with('success', 'Inventory updated successfully!');
}


    public function destroy($id)
    {
        Inventory::destroy($id);
        return redirect()->route('admin.inventory.index')->with('success', 'Item deleted!');
    }

    

    
}

