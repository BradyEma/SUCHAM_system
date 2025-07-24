<?php

namespace App\Http\Controllers;

use App\Models\RetailerWholesalerOrder;
use App\Models\RetailerWholesalerOrderItem;
use App\Models\RetailerInventory;
use App\Models\Product;
use App\Models\Wholesaler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RetailerWholesalerOrderController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        // Other stats
        $pendingOrders = RetailerWholesalerOrder::where('retailer_id', $user->id)
                            ->where('order_status', 'Pending')
                            ->count();

        $processedToday = RetailerWholesalerOrder::where('retailer_id', $user->id)
                            ->where('order_status', 'Processed')
                            ->whereDate('order_date', today())
                            ->count();

        $todaysRevenue = RetailerWholesalerOrder::where('retailer_id', $user->id)
                            ->where('order_status', 'Processed')
                            ->whereDate('order_date', today())
                            ->sum('total_amount');

        // Low stock count from retailer_inventory table
        $lowStockItems = RetailerInventory::where('stock', '<=', 10)->count();

        // Fetch orders for pagination
        $orders = RetailerWholesalerOrder::where('retailer_id', $user->id)
                    ->latest()
                    ->paginate(10);

        // Pass all to the view
        return view('retailer_wholesaler_orders.index', compact(
            'user',
            'pendingOrders',
            'processedToday',
            'todaysRevenue',
            'lowStockItems',
            'orders'
        ));
    }
public function store(Request $request)
{
    \Log::info('Order submission received', $request->all());
    $validated = $request->validate([
        'business_name' => 'required|string|max:255',
        'wholesaler_id' => 'required|exists:wholesalers,id',
        'items' => 'required|array|min:1',
        'items.*.name' => 'required|string',
        'items.*.price' => 'required|numeric|min:0',
        'items.*.quantity' => 'required|numeric|min:0.01',
        'items.*.unit' => 'required|string|in:kg,g,l,ml,pcs,box,pack',
        'total_amount' => 'required|numeric|min:0',
        'delivery_date' => 'required|date',
        'delivery_address' => 'required|string',
        'notes' => 'nullable|string',
    ]);

    // ✅ Create the order
   
         $order = RetailerWholesalerOrder::create([

        'retailer_id' => auth()->id(),
        'wholesaler_id' => $validated['wholesaler_id'],
        'order_status' => 'pending',
        'total_amount' => $validated['total_amount'],
        'order_date' => now(),
        'delivery_date' => $validated['delivery_date'],
        'delivery_address' => $validated['delivery_address'],
        'notes' => $validated['notes'] ?? null,
    ]);

    // ✅ Add each item to the order
    foreach ($validated['items'] as $item) {
        $order->items()->create([
            'name' => $item['name'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'unit' => $item['unit'],
        ]);
    }

    return redirect()->route('retailer_wholesaler_orders.show', $order->id)
                     ->with('success', 'Order created successfully!');
}

public function create()
{
    $wholesalers = Wholesaler::all(); // For a dropdown
    $products = Product::all(); // If products are shown dynamically
    return view('retailer_wholesaler_orders.create', compact('wholesalers', 'products'));
}


public function show($id)
{
    $order = RetailerWholesalerOrder::findOrFail($id);
    return view('retailer_wholesaler_orders.show', compact('order'));
}



    public function destroy(RetailerWholesalerOrder $retailerWholesalerOrder)
{
    $retailerWholesalerOrder->delete();
    return back()->with('success', 'Order cancelled');
}


    public function getRevenueData(Request $request)
{
    $period = $request->input('period', '7days');
    $labels = [];
    $data = [];

    if ($period == '7days') {
        $labels = collect(range(0, 6))->map(fn($i) => now()->subDays($i)->format('D'))->reverse()->values();
        $data = collect(range(0, 6))->map(fn($i) => rand(100, 500))->reverse()->values(); // replace with actual DB logic
    } elseif ($period == '30days') {
        $labels = collect(range(0, 29))->map(fn($i) => now()->subDays($i)->format('M d'))->reverse()->values();
        $data = collect(range(0, 29))->map(fn($i) => rand(100, 500))->reverse()->values();
    } else {
        $labels = collect(range(1, 12))->map(fn($m) => date('M', mktime(0, 0, 0, $m, 1)));
        $data = collect(range(1, 12))->map(fn($i) => rand(1000, 5000)); // replace with actual logic
    }

    return response()->json([
        'labels' => $labels,
        'data' => $data,
    ]);
}

public function chartsData()
{
    // Weekly Orders Count (Monday to Sunday)
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();

    $weeklyOrders = RetailerWholesalerOrder::select(
            DB::raw('DAYNAME(order_date) as day'),
            DB::raw('COUNT(*) as total')
        )
        ->whereBetween('order_date', [$startOfWeek, $endOfWeek])
        ->groupBy('day')
        ->get()
        ->pluck('total', 'day');

    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $ordersByDay = [];
    foreach ($days as $day) {
        $ordersByDay[] = $weeklyOrders[$day] ?? 0;
    }

    // Monthly Revenue for this year
    $monthlyRevenue = RetailerWholesalerOrder::select(
            DB::raw('MONTH(order_date) as month'),
            DB::raw('SUM(total_amount) as revenue')
        )
        ->whereYear('order_date', Carbon::now()->year)
        ->groupBy('month')
        ->get()
        ->pluck('revenue', 'month');

    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $revenueData = [];
    for ($i = 1; $i <= 12; $i++) {
        $revenueData[] = $monthlyRevenue[$i] ?? 0;
    }

    return response()->json([
        'orders' => [
            'labels' => $days,
            'data' => $ordersByDay
        ],
        'revenue' => [
            'labels' => $months,
            'data' => $revenueData
        ]
    ]);
}

}
