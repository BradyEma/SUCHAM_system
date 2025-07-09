<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierInventory;
use Illuminate\Http\Request;

class SupplierInventoryController extends Controller
{
   
public function index()
{
    $products = SupplierInventory::all(); // or any other logic to get products

    return view('supplier_inventory.index', compact('products'));
}


    public function create()
    {
        $suppliers = Supplier::all();
        return view('supplier_inventory.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product' => 'required|string',
            'product_id' => 'required|string|unique:supplier_inventories,product_id',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric',
            'measurement' => 'required|string',
            'status' => 'required|string|in:in_stock,low_stock',
            'actions' => 'nullable|string',
        ]);

        SupplierInventory::create($validated);

        return redirect()->route('supplier_inventory.index')->with('success', 'Inventory added.');
    }
}
