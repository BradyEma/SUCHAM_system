<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::orderBy('product')->get();

        // $inventory = Inventory::all();
        return view('admin.inventory.index', compact('inventory'));
    }
}
