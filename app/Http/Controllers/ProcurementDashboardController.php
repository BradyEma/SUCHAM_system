<?php

namespace App\Http\Controllers;

use App\Models\ProcurementRequest;
use App\Models\PurchaseOrder;
use App\Models\GoodsReceived;
use App\Models\Supplier;

class ProcurementDashboardController extends Controller
{
  
public function index()
{
     $supplier = Supplier::find(1);  // Define $supplier

    $deliveryCount = $supplier ? $supplier->deliveries()->count() : 0;

    $pendingPRs = ProcurementRequest::where('status', 'pending')->count();
    $activePOs = PurchaseOrder::where('status', 'active')->count();
    $lateDeliveries = GoodsReceived::where('delivered_at', '<', now()->subDays(2))->count(); 
    $newSuppliers = Supplier::whereDate('created_at', '>=', now()->subDays(30))->count();

    $orders = PurchaseOrder::latest()->take(10)->get(); // fetch latest 10 orders


        // Get recent goods received, e.g. latest 5 records
         $recentGoodsReceived = GoodsReceived::with('supplier') // eager load supplier relation if exists
        ->orderBy('delivered_at', 'desc') // or created_at if you don't have received_at
        ->take(5)
        ->get();

    return view('dashboard.procurementdashboard', [
        'pendingPRs' => $pendingPRs,
        'activePOs' => $activePOs,
        'lateDeliveries' => $lateDeliveries,
        'newSuppliers' => $newSuppliers,
        'orders' => $orders,  
        'recentGoodsReceived' => $recentGoodsReceived,
         'deliveryCount' => $deliveryCount, 


    ]);
}

    
    public function metrics()
    {
        return response()->json([
            'requests' => ProcurementRequest::count(),
            'orders' => PurchaseOrder::count(),
            'received' => GoodsReceived::count(),
            'suppliers' => Supplier::count(),
        ]);
    }
}