<?php

namespace App\Http\Controllers;

use id;
use App\Models\Wholesaler;
use Illuminate\Http\Request;
use App\Models\WholesalerOrder;
use App\Models\Order;  // Adjust to your actual Order model namespace

class WholesalerOrderController extends Controller
{
    public function index()
    {
        // Fetch orders related to the wholesaler user (adjust the query as needed)
        $orders = WholesalerOrder::where('wholesaler_id', auth()->id())
                       ->orderBy('created_at', 'desc')
                       ->get();

        // Pass the orders collection to the view
        return view('dashboard.wholesaler-dashboard', [
            'orders' => $orders,
        ]);
    }
}
