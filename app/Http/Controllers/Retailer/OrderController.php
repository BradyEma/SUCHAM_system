<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RetailerOrder;
use Illuminate\Support\Facades\Auth;
use App\Models\RetailerInventory;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class OrderController extends Controller
{
 public function index()
{
    $retailerId = Auth::user()->retailer->id ?? null;

    $orders = RetailerOrder::with('customer')
        ->where('retailer_id', $retailerId)
        ->latest()
        ->get()
        ->groupBy('transaction_id');

    $totalOrders = RetailerOrder::where('retailer_id', $retailerId)
        ->distinct('transaction_id')
        ->count('transaction_id');

    // ✅ Count pending orders
    $pendingOrders = RetailerOrder::where('retailer_id', $retailerId)
        ->where('status', 'pending')
        ->distinct('transaction_id')
        ->count('transaction_id');

   $completedOrders = RetailerOrder::where('retailer_id', $retailerId)
    ->where('status', 'completed')
    ->distinct('transaction_id')
    ->count('transaction_id');

    $cancelledOrders = RetailerOrder::where('retailer_id', $retailerId)
    ->where('status', 'cancelled')
    ->distinct('transaction_id')
    ->count('transaction_id');
   
    $deliveryOrders = RetailerOrder::where('retailer_id', $retailerId)
    ->where('status', 'on delivery')
    ->distinct('transaction_id')
    ->count('transaction_id');

    $lowStockCount = RetailerInventory::where('retailer_id', $retailerId)
        ->whereColumn('quantity', '<', 'minimum_stock_level')
        ->count();

    $user = Auth::user();

return view('dashboard.retailer-orders', compact('orders', 'user', 'totalOrders', 'pendingOrders', 'completedOrders', 'cancelledOrders', 'deliveryOrders', 'lowStockCount'));
}



public function show($transactionId)
{
    $orderItems = \App\Models\RetailerOrder::where('transaction_id', $transactionId)->get();

    if ($orderItems->isEmpty()) {
        abort(404, 'Order not found.');
    }

    return view('dashboard.retailer-order-details', [
        'orderItems' => $orderItems,
        'transactionId' => $transactionId
    ]);
}

public function markAsOnDelivery($transactionId)
{
    $orderItems = RetailerOrder::where('transaction_id', $transactionId)->get();

    if ($orderItems->isEmpty()) {
        return redirect()->back()->with('error', 'Order not found.');
    }

    foreach ($orderItems as $item) {
        // 1. Update order status
        $item->status = 'on delivery';
        $item->save();

        // 2. Deduct quantity from inventory
        $inventory = RetailerInventory::where('retailer_id', $item->retailer_id)
            ->where('product_name', $item->product_name)
            ->first();

        if ($inventory) {
            $inventory->quantity -= $item->quantity;
            $inventory->quantity = max($inventory->quantity, 0); // prevent negative
            $inventory->save();
        }
    }

    return redirect('/retailer/orders')->with('success', 'Order signed off to delivery.');
}

public function markAsCompleted($transactionId)
{
    $orderItems = RetailerOrder::where('transaction_id', $transactionId)->get();

    if ($orderItems->isEmpty()) {
        return redirect()->back()->with('error', 'Order not found.');
    }

    foreach ($orderItems as $item) {
        $item->status = 'completed';
        $item->save();

        // ✅ Append to datasets.csv
        $this->saveOrderToDatasetCsv($item);
    }

    return redirect('/retailer/orders')->with('success', 'Order marked as Completed.');
}

public function salesChartData(Request $request)
{
    $retailerId = auth()->user()->retailer->id;
    $range = $request->get('range', '30'); // default 30 days

    $query = DB::table('retailer_orders')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total_sales'))
        ->where('retailer_id', $retailerId)
        ->where('status', 'completed');

    // Filter date range
    if ($range == '7') {
        $query->whereBetween('created_at', [now()->subDays(7), now()]);
    } elseif ($range == '30') {
        $query->whereBetween('created_at', [now()->subDays(30), now()]);
    } elseif ($range == '90') {
        $query->whereBetween('created_at', [now()->subDays(90), now()]);
    }

    $salesData = $query
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date')
        ->get();

    // Format data for chart
    $formatted = $salesData->map(function ($item) {
        return [
            'date' => $item->date,
            'total_sales' => (int) $item->total_sales,
        ];
    });

    return response()->json($formatted);
}
private function saveOrderToDatasetCsv($order)
{
    $path = storage_path('app/data/datasets.csv');

    // Step 1: Create CSV file if missing
    if (!file_exists($path)) {
        file_put_contents($path, "order_id,customer_id,customers_email,product,order_amount,order_date\n");
    }

    // Step 2: Read existing customer_ids
    $existingIds = [];
    if (($handle = fopen($path, 'r')) !== false) {
        $header = fgetcsv($handle); // skip header
        while (($data = fgetcsv($handle)) !== false) {
            $existingIds[] = $data[1]; // customer_id is the 2nd column
        }
        fclose($handle);
    }

    $originalCustomerId = $order->user_id;
    $finalCustomerId = in_array($originalCustomerId, $existingIds)
        ? $originalCustomerId
        : $originalCustomerId + 120;

    // Step 3: Format and write
    $line = sprintf(
        "%d,%d,%s,%s,%d,%s\n",
        $order->id,
        $finalCustomerId,
        $order->user->email ?? 'unknown@example.com',
        $order->product_name ?? 'sugar',
        $order->total ?? 0,
        \Carbon\Carbon::parse($order->created_at)->format('n/j/Y')
    );

    file_put_contents($path, $line, FILE_APPEND);
}


}
