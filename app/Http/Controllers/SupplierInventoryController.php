<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierInventory;
use Illuminate\Http\Request;

class SupplierInventoryController extends Controller
{
    public function index()
    {
        $inventories = SupplierInventory::with('supplier')->get();
        return view('supplier_inventory.index', compact('inventories'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('supplier_inventory.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
        
         'product_name' => 'required|string',
         'product_id' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string',
            'price' => 'required|numeric|min:200'
        ]);

        SupplierInventory::create($request->all());
        return redirect()->route('supplier_inventory.index')->with('success', 'Inventory added.');
    }
}
