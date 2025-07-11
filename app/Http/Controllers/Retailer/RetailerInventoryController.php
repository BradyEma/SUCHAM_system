<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Retailer;
use App\Models\RetailerInventory; 
use Illuminate\Support\Facades\Auth;


class RetailerInventoryController extends Controller
{
public function index(Request $request)
{
    $user = Auth::user();

    if (!$user->retailer) {
        return redirect()->route('retailer.profile')->with('error', 'Please complete your retailer profile.');
    }

    $retailerId = $user->retailer->id;

    $query = RetailerInventory::where('retailer_id', $retailerId);

    // ✅ Apply search filter if there's a search input
    if ($request->has('search') && $request->search !== '') {
        $query->where('product_name', 'like', '%' . $request->search . '%');
    }

    if ($request->has('status') && $request->status !== '') {
    switch ($request->status) {
        case 'low':
            $query->whereColumn('quantity', '<', 'minimum_stock_level');
            break;
        case 'out':
            $query->where('quantity', 0);
            break;
        case 'in':
            $query->whereColumn('quantity', '>=', 'minimum_stock_level')->where('quantity', '>', 0);
            break;
    }
}


    $items = $query->paginate(10);

    // ✅ Stats
    $totalProducts = RetailerInventory::where('retailer_id', $retailerId)->count();

    $lowStockCount = RetailerInventory::where('retailer_id', $retailerId)
        ->whereColumn('quantity', '<', 'minimum_stock_level')
        ->count();

    $outOfStockCount = RetailerInventory::where('retailer_id', $retailerId)
        ->where('quantity', 0)
        ->count();

    $totalAmount = RetailerInventory::where('retailer_id', $retailerId)
        ->selectRaw('SUM(quantity * unit_price) as total')
        ->value('total') ?? 0;

    return view('retailer.inventory.index', compact(
        'items',
        'totalProducts',
        'lowStockCount',
        'outOfStockCount',
        'totalAmount',
        'user'
    ));
}


    public function create()
    {
    return view('retailer.inventory.create');
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'product_name' => 'required|string|max:255',
        'sku' => 'required|string|max:100|unique:retailer_inventories,sku',
        'quantity' => 'required|integer|min:0',
        'unit_of_measurement' => 'required|string|max:50',
        'unit_price' => 'required|numeric|min:0',
        'minimum_stock_level' => 'required|integer|min:0',
        'product_description' => 'nullable|string',
        'product_image' => 'nullable|image|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('product_image')) {
        $imagePath = $request->file('product_image')->store('retailer_product_images', 'public');
        $validated['product_image'] = $imagePath;
    }

    // Get retailer ID of the logged-in user
    $retailer = Retailer::where('user_id', Auth::id())->first();
    if (!$retailer) {
        return redirect()->back()->with('error', 'Retailer profile not found.');
    }

    $validated['retailer_id'] = $retailer->id;

    RetailerInventory::create($validated);

    return redirect()->route('retailer.inventory.index')->with('success', 'Product added to inventory.');
}

public function destroy($id)
{
    $inventory = RetailerInventory::findOrFail($id);
    $inventory->delete();

    return redirect()->route('retailer.inventory.index')->with('success', 'Item deleted successfully.');
}


public function show($id)
{
    $retailerId = Auth::user()->retailer->id;

    $item = RetailerInventory::where('retailer_id', $retailerId)->findOrFail($id);

    return view('retailer.inventory.show', compact('item'));
}

public function edit($id)
{
    $retailer = auth()->user()->retailer;
    $inventory = RetailerInventory::where('retailer_id', $retailer->id)->findOrFail($id);
    return view('retailer.inventory.edit', compact('inventory'));
}

}
