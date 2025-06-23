<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class InventoryController extends Controller
{
    public function index() {
        $items = Inventory::all();
        return view('inventory.index', compact('items'));
    }

    public function create() {
        return view('inventory.create');
    }

    public function store(Request $request) {
        $request->validate([
            'item_name' => 'required',
            'quantity' => 'required|integer'
        ]);

        Inventory::create($request->all());
        return redirect()->route('inventory.index')->with('success', 'Item added!');
    }

    public function edit(Inventory $inventory) {
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory) {
        $inventory->update($request->all());
        return redirect()->route('inventory.index')->with('success', 'Item updated!');
    }

    public function destroy(Inventory $inventory) {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success', 'Item deleted!');
    }

    public function exportPDF()
{
    $items = Inventory::all();
    $pdf = Pdf::loadView('inventory.pdf', compact('items'));
    return $pdf->download('inventory_list.pdf');
}

}
