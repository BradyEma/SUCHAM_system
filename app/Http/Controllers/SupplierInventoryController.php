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
        

        return redirect()->route('supplier_inventory.index')->with('success', 'Inventory added.');
    }
}
