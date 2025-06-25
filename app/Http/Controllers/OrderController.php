<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'product'     => 'required|string',
            'quantity'    => 'required|integer',
            'order_date'  => 'required|date',
            'status'      => 'required|string',
        ]);

        Order::create($request->all());
        return redirect()->route('orders.index')->with('success', 'Order saved successfully!');
    }
}
