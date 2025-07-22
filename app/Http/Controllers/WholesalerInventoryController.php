<?php

namespace App\Http\Controllers;

use App\Models\WholesalerInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class WholesalerInventoryController extends Controller
{
    public function export()
    {
        $inventory = WholesalerInventory::all();

        $csvData = "Product Name,Product ID,Stock,Unit Price,Measurements\n";
        foreach ($inventory as $item) {
            $csvData .= "{$item->product_name},{$item->product_id},{$item->quantity},{$item->unit_price},{$item->units}\n";
        }

        $filename = 'wholesaler_inventory_' . now()->format('Ymd_His') . '.csv';

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    public function index()
    {
        // Paginated list for table
        $products = WholesalerInventory::orderBy('created_at', 'desc')->paginate(10);

        // Full list for stock calculations
        $allProducts = WholesalerInventory::all();
        $totalProducts = $allProducts->count();
        $inStock = $allProducts->where('quantity', '>', 10)->count();
        $lowStock = $allProducts->where('quantity', '>', 0)->where('quantity', '<=', 10)->count();
        $outOfStock = $allProducts->where('quantity', '<=', 0)->count();

        return view('wholesaler_inventory.index', compact(
            'products',
            'totalProducts',
            'inStock',
            'lowStock',
            'outOfStock'
        ));
    }

    public function create()
    {
        return view('wholesaler_inventory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|string|max:255|unique:wholesaler_inventories,product_id',
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'units' => 'required|in:kg,litres,bags,g,L,ml,pcs,boxes',
            'unit_price' => 'required|numeric|min:0',
            'status' => 'required|in:in_stock,out_of_stock',
        ]);

        WholesalerInventory::create($validated);

        return redirect()->route('wholesaler_inventory.index')->with('success', 'Product added successfully.');
    }

    public function show($id)
    {
        $product = WholesalerInventory::findOrFail($id);
        return view('wholesaler_inventory.show', compact('product'));
    }

    public function edit($id)
    {
        $product = WholesalerInventory::findOrFail($id);
        return view('wholesaler_inventory.edit', compact('product'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'product_id' => 'required|string|max:255',
        'product_name' => 'required|string|max:255',
        'quantity' => 'required|numeric|min:0',
        'units' => 'required|string',
        'unit_price' => 'required|numeric|min:0',
        'status' => 'required|string',
    ]);

    $product = WholesalerInventory::findOrFail($id);

    $product->update([
        'product_id' => $request->product_id,
        'product_name' => $request->product_name,
        'quantity' => $request->quantity,
        'units' => $request->units,
        'unit_price' => $request->unit_price,
        'status' => $request->status,
    ]);

    return redirect()->route('wholesaler_inventory.index')->with('success', 'Product updated successfully.');
}


    public function destroy($id)
    {
        $product = WholesalerInventory::findOrFail($id);
        $product->delete();

        return redirect()->route('wholesaler_inventory.index')->with('success', 'Product deleted successfully.');
    }
}
