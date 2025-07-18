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
    return view('dashboard.procurementdashboard', [
        'requests' => ProcurementRequest::count(),
        'orders' => PurchaseOrder::count(),
        'received' => GoodsReceived::count(),
        'suppliers' => Supplier::count(),
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